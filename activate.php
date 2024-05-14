<?php
include 'config.php';
session_start();

if (isset($_GET['code'])) {
    $activation_code = mysqli_real_escape_string($conn, $_GET['code']);

    // Koneksi ke basis data dan aktivasi akun
    $stmt = $conn->prepare("UPDATE users SET is_active = 1 WHERE activation_code = ?");
    $stmt->bind_param("s", $activation_code);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $message = "Akun Anda berhasil diaktifkan. Anda dapat <a href='login.php'>login</a>.";
            $message_type = "success";
        } else {
            $message = "Kode aktivasi tidak valid atau akun sudah diaktifkan.";
            $message_type = "error";
        }
    } else {
        $message = "Kesalahan saat menjalankan query: " . $stmt->error;
        $message_type = "error";
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "Kode aktivasi tidak tersedia.";
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Aktivasi Akun</title>
    <link href="img/logo2.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Your CSS styles here */
        .container {
            width: 400px;
            min-height: 200px;
            background: #FFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,.3);
            padding: 40px 30px;
            text-align: center;
        }
        /* Additional styles */
    </style>
</head>
<body>
    <div class="container">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Aktivasi Akun</p>
        <div class="input-group">
            <p class="login-register-text"><?php echo $message; ?></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '<?php echo $message_type; ?>',
                title: '<?php echo $message_type === "success" ? "Berhasil" : "Oops..."; ?>',
                html: '<?php echo $message; ?>',
                confirmButtonColor:'#FFC94A'
            });
        });
    </script>
</body>
</html>
