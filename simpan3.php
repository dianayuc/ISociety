<?php
include 'config.php';

// Mengambil data dari form
$name = $_POST['name'];
$jenis = $_POST['jenis'];
$message = $_POST['message'];

// Informasi file yang diunggah
$fileName = $_FILES['photo']['name'];
$fileTmp = $_FILES['photo']['tmp_name'];
$fileSize = $_FILES['photo']['size'];
$fileError = $_FILES['photo']['error'];

// Memeriksa koneksi database
$conn = mysqli_connect($server, $user, $pass, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan dan menjalankan query SQL
$query = "INSERT INTO service (name, jenis, message, photo) VALUES ('$name', '$jenis', '$message', '$fileName')";

if ($conn->query($query) === TRUE) {
    // Pindahkan file yang diunggah ke folder tujuan
    $targetPath = 'uploads/' . $fileName;
    move_uploaded_file($fileTmp, $targetPath);

    // Redirect ke halaman service.html dengan menambahkan parameter untuk alert
    header("location:service.html?status=success");
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$conn->close();
?>
