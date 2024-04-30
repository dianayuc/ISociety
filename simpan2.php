<?php
include 'config.php';
// Mengambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$conn = mysqli_connect($server, $user, $pass, $database);

// Memeriksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan dan menjalankan query SQL
$query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name','$email', '$subject', '$message')";

if ($conn->query($query) === TRUE) {
    // Data berhasil disimpan, tampilkan notifikasi
    echo "<script>alert('Data berhasil disimpan. Terima kasih!');</script>";
    header("Location: contact.html");
    exit();
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>