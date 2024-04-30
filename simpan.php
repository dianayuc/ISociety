<?php
include 'config.php';

// Mengambil data dari form dan membersihkannya
$name = mysqli_real_escape_string($conn, $_POST['name']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Memeriksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan dan menjalankan query SQL
$query = "INSERT INTO menfess (name, subject, message) VALUES ('$name', '$subject', '$message')";

if ($conn->query($query) === TRUE) {
    header("Location: service.html");
    exit();
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$conn->close();
?>
