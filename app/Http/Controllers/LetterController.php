<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;
use App\Http\Resources\LetterResource;
use App\Models\Institution;
use App\Models\Letter;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LSNepomuceno\LaravelA1PdfSign\Sign\ManageCert;
use LSNepomuceno\LaravelA1PdfSign\Sign\SignaturePdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Throwable;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        try {
            $letters = new Letter();
            $letters = $request->has('yearId') ? $letters->whereYearid($request->yearId) : $letters;
            $letters = $request->has('institutionId') ? $letters->whereInstitutionid($request->institutionId) : $letters;
            $letters = $letters->orderBy('created_at', 'desc');
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => LetterResource::collection($letters->get()),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function store(StoreLetterRequest $request)
    {
        try {
            return ($letter = Letter::create($request->only(['yearId', 'institutionId', 'type', 'signature', 'data'])))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Dibuat',
                    'statusCode' => 201,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Dibuat');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], 442);
        }
    }

    public function show(Letter $letter)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new LetterResource($letter)
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function update(UpdateLetterRequest $request, Letter $letter)
    {
        try {
            return ($letter->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Diubah',
                    'statusCode' => 200,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Diubah');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function destroy(Letter $letter)
    {
        try {
            return ($letter->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Surat Berhasil Dihapus',
                    'statusCode' => 200,
                    'result' => new LetterResource($letter)
                ]) : throw new Exception('Data Surat Gagal Dihapus');
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], $e->getCode());
        }
    }

    public function print(Letter $letter)
    {
        try {
            $institution = Institution::find($letter->institutionId);
            $headmaster = $institution->users()->where('role', '6')->first()->teacher;
            $data = [
                'qrcode' => base64_encode(QrCode::size(100)
                    ->generate(config('app.frontend_url') . '/surat-menyurat/verifikasi/' . $letter->token)),
                'institution' => $institution,
                'letter' => $letter,
                'data' => json_decode($letter->data, false),
                'headmaster' => $headmaster,
            ];
            if ($letter->type == '1.04') {
                $pdf = Pdf::loadView('template.letter.invitation', $data);
            } else {
                $pdf = PDF::loadView('template.letter.invitation', $data);
            }
            $output = $pdf->output();
            $fileName = $letter->type .'-'. time() . '.pdf';
            Storage::disk('pdfs')->put('unsign/' . $fileName, $output);
            if ($letter->signature == '1') {
                $pfxPassword = 'Masadepan100%';
                $filePath = Storage::disk('pdfs')->path('unsign/' . $fileName);
                $certificatePath = Storage::path("/signature/$headmaster->pegId.crt");
                $privateKeyPath = Storage::path("/signature/$headmaster->pegId.key");
                $certificate = file_get_contents($certificatePath);
                $privateKey = file_get_contents($privateKeyPath);
                $outputPfxFile = Storage::path('signature/' . $headmaster->pegId . '.pfx');
                $pfxExportSuccess = openssl_pkcs12_export(
                    $certificate,
                    $pfxContent, // This will hold the PFX data as a string
                    $privateKey,
                    $pfxPassword,
                    [] // Optional array of options
                );

                if ($pfxExportSuccess) {
                    file_put_contents($outputPfxFile, $pfxContent);
                }
                try {
                    $cert = new ManageCert;
                    $cert->fromPfx($outputPfxFile, 'Masadepan100%');
                } catch (Throwable $th) {
                    throw new Exception($th->getMessage());
                }
                try {
                    $pdf = new SignaturePdf($filePath, $cert, SignaturePdf::MODE_RESOURCE);
                    $resource = $pdf->signature();
                    Storage::disk('pdfs')->put('signed/' . $fileName, $resource);
                    $fileUrl = Storage::disk('pdfs')->url('signed/' . $fileName);
                } catch (Throwable $th) {
                    throw new Exception($th->getMessage());
                }
            } else {
                $fileUrl = Storage::disk('pdfs')->url('unsign/' . $fileName);
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => $fileUrl
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ], 500);
        }
    }
}
