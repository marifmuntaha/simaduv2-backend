<?php

use App\Models\Letter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use LSNepomuceno\LaravelA1PdfSign\Sign\ManageCert;
use LSNepomuceno\LaravelA1PdfSign\Sign\SignaturePdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/print', function () {
    $data = [
        'qrcode' => base64_encode(QrCode::size(100)
            ->generate('http://localhost:5173/surat-menyurat/verify/68768jguytguytgu')),
        'institution' => \App\Models\Institution::find(4),
        'letter' => \App\Models\Letter::find(2),
        'data' => json_decode(Letter::find(2)->data),
        'headmaster' => \App\Models\Teacher::find(22),
    ];

//    return view('template.letter.mutation', $data);

    $pdf = Pdf::loadView('template.letter.mutation', $data);
    $output = $pdf->output();
    $fileName = 'order_' . time() . '.pdf';
    Storage::disk('pdfs')->put('unsign/' . $fileName, $output);
});
