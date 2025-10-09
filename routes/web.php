<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/print', function () {
    $data = 'http://localhost:5173/surat-menyurat/verify/68768jguytguytgu';
    $qrcode = base64_encode(QrCode::size(100)
        ->generate($data));
    return Pdf::loadView('template.letter.invitation', compact('qrcode'))->stream('invitation.pdf');
});

Route::get('/generate/signature', function () {
    $privateKeyPath = '/var/www/html/storage/app/private/signature/private.key';
    $command = "openssl genrsa -out $privateKeyPath 2048"; // 2048 is the key strength
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo "Private key generated successfully: $privateKeyPath\n";
        $csrPath = '/var/www/html/storage/app/private/signature/server.csr';
        $country = 'ID';
        $state = 'Jawa Tengah';
        $locality = 'Jepara';
        $organization = 'MTs. Darul Hikmah Menganti';
        $organizationalUnit = 'Head Master';
        $commonName = 'ma.darul-hikmah.sch.id';
        $emailAddress = 'ma@darul-hikmah.sch.id';

        $command = "openssl req -new -key $privateKeyPath -out $csrPath -subj '/C=$country/ST=$state/L=$locality/O=$organization/OU=$organizationalUnit/CN=$commonName/emailAddress=$emailAddress'";
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            echo "CSR generated successfully: $csrPath\n";
            $certificatePath = '/var/www/html/storage/app/private/signature/server.crt';
            $days = 365; // Validity period in days

            $command = "openssl x509 -req -days $days -in $csrPath -signkey $privateKeyPath -out $certificatePath";
            exec($command, $output, $return_var);

            if ($return_var === 0) {
                echo "Self-signed certificate generated successfully: $certificatePath\n";
//                $certificateFile = 'path/to/your_certificate.crt';
//                $privateKeyFile = 'path/to/your_private.key';
                $caBundleFile = 'path/to/your_ca_bundle.ca-bundle';
                $pfxPassword = 'Masadepan100%';
                $outputPfxFile = '/var/www/html/storage/app/private/signature/output.pfx';

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
                    // Save the PFX content to a file
                    file_put_contents($outputPfxFile, $pfxContent);
                    echo "PFX file created successfully at: " . $outputPfxFile . "\n";
                } else {
                    echo "Error creating PFX file: " . openssl_error_string() . "\n";
                }
            } else {
                echo "Error generating self-signed certificate.\n";
                print_r($output);
            }
        } else {
            echo "Error generating CSR.\n";
            print_r($output);
        }
    } else {
        echo "Error generating private key.\n";
        print_r($output);
    }
});
