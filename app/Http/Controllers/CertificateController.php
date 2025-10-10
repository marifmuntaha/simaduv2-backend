<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LSNepomuceno\LaravelA1PdfSign\Sign\ManageCert;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $file = Storage::path("signature/{$user->username}.pfx");
            $cert = new ManageCert;
            $cert->setPreservePfx() // If you need to preserve the PFX certificate file
            ->fromPfx($file, 'Masadepan100%');
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => [
                    ['data' => $cert->getCert()->data]
                ]
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (!Storage::exists('signature')) {
                Storage::makeDirectory('signature');
                return true;
            } else {
                $privateKeyPath = Storage::path("signature/$request->username.key");
                $command = "openssl genrsa -out $privateKeyPath 2048"; // 2048 is the key strength
                exec($command, $output, $return_var);
                if ($return_var === 0) {
                    $institution = Institution::find($request->institutionId);
                    $csrPath = Storage::path("signature/$request->username.csr");
                    $country = 'ID';
                    $state = 'Jawa Tengah';
                    $locality = 'Jepara';
                    $organization = $institution->ladder->alias . '. ' . $institution->name;
                    $organizationalUnit = 'Head Master';
                    $commonName = $request->name;
                    $emailAddress = $institution->email;

                    $command = "openssl req -new -key $privateKeyPath -out $csrPath -subj '/C=$country/ST=$state/L=$locality/O=$organization/OU=$organizationalUnit/CN=$commonName/emailAddress=$emailAddress'";
                    exec($command, $output, $return_var);

                    if ($return_var === 0) {
                        $certificatePath = Storage::path("signature/$request->username.crt");
                        $days = 365; // Validity period in days

                        $command = "openssl x509 -req -days $days -in $csrPath -signkey $privateKeyPath -out $certificatePath";
                        exec($command, $output, $return_var);

                        if ($return_var === 0) {
                            $pfxPassword = 'Masadepan100%';
                            $outputPfxFile = Storage::path("signature/$request->username.pfx");

                            $certificate = file_get_contents($certificatePath);
                            $privateKey = file_get_contents($privateKeyPath);

                            $pfxExportSuccess = openssl_pkcs12_export(
                                $certificate,
                                $pfxContent, // This will hold the PFX data as a string
                                $privateKey,
                                $pfxPassword,
                                [] // Optional array of options
                            );

                            if ($pfxExportSuccess) {
                                file_put_contents($outputPfxFile, $pfxContent);
                                return response([
                                    'status' => 'success',
                                    'statusMessage' => 'Sertifikat berhasil dibuat.',
                                    'statusCode' => 200
                                ], 200);
                            } else {
                                throw new Exception("Error creating PFX file: " . openssl_error_string() . "\n");
                            }
                        } else {
                            throw new Exception("Error generating self-signed certificate.\n");
                        }
                    } else {
                        throw new Exception("Error generating CSR.\n");
                    }
                } else {
                    throw new Exception("Error generating KEY.\n");
                }
            }


        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }
}
