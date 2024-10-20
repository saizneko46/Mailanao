<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendRegistrationEmail($data) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = SMTP_PORT;

        //Recipients
        $mail->setFrom(SENDER_EMAIL, SENDER_NAME);
        $mail->addAddress(ADMIN_EMAIL);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Pendaftaran Baru - Robotic Community';
        
        $robotChoices = implode(', ', $data['robot']);
        
        $mail->Body    = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
                h1 { color: #00a8ff; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Pendaftaran Baru - Robotic Community</h1>
                <p>Berikut adalah detail pendaftaran baru:</p>
                <table>
                    <tr><th>Nama</th><td>{$data['nama']}</td></tr>
                    <tr><th>Kelas</th><td>{$data['kelas']}</td></tr>
                    <tr><th>Jurusan</th><td>{$data['jurusan']}</td></tr>
                    <tr><th>No. HP</th><td>{$data['nohp']}</td></tr>
                    <tr><th>Email</th><td>{$data['email']}</td></tr>
                    <tr><th>Alasan</th><td>{$data['alasan']}</td></tr>
                    <tr><th>Robot yang Ingin Dibuat</th><td>{$robotChoices}</td></tr>
                    <tr><th>IP Address</th><td>{$data['ip_address']}</td></tr>
                </table>
            </div>
        </body>
        </html>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
