<?php
require_once 'config.php';
require_once 'send_email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST;
    $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
    
    if (sendRegistrationEmail($data)) {
        $response = ["success" => true, "message" => "Sukses mendaftar! Tunggu informasi selanjutnya."];
    } else {
        $response = ["success" => false, "message" => "Terjadi kesalahan saat mendaftar. Silakan coba lagi."];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Robotic Community</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Registrasi Robotic Community</h1>
    </header>
    
    <div class="container">
        <form id="registrationForm">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" required>
            </div>
            
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" required>
            </div>
            
            <div class="form-group">
                <label for="nohp">No. HP</label>
                <input type="text" id="nohp" name="nohp" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="alasan">Alasan Masuk Ekstrakurikuler</label>
                <textarea id="alasan" name="alasan" rows="4" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Robot yang Ingin Dibuat</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="robot[]" value="lingkungan"> Lingkungan</label>
                    <label><input type="checkbox" name="robot[]" value="kesehatan"> Kesehatan</label>
                    <label><input type="checkbox" name="robot[]" value="edukasi"> Edukasi</label>
                    <label><input type="checkbox" name="robot[]" value="rumah_tangga"> Rumah Tangga</label>
                    <label><input type="checkbox" name="robot[]" value="lainnya"> Lainnya</label>
                </div>
            </div>
            
            <button type="submit">Daftar</button>
        </form>
    </div>
    
    <div id="notification"></div>

    <script src="js/script.js"></script>
</body>
</html>
