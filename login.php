<?php 
//connecting database
include 'config.php';
error_reporting(0);
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: berhasil_login.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
 
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: berhasil_login.php");
    } else {
        $_SESSION['error'] = "Email atau password Anda salah. Silahkan coba lagi!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    
    <title>Login</title>

    <!-- Favicons -->
  <link href="img/logo2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
        .container {
            width: 400px;
            min-height: 200px;
            background: #FFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,.3);
            padding: 40px 30px;
        }
            .container {
    width: 400px;
    min-height: 200px;
    background: #FFF;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 40px 30px;
}
 
.container .login-text {
    color: #111;
    font-weight: 500;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 20px;
    display: block;
    text-transform: capitalize;
}
 
.container .login-email .input-group {
    width: 100%;
    height: 50px;
    margin-bottom: 25px;
}
 
.container .login-email .input-group input {
    width: 100%;
    height: 100%;
    border: 2px solid #FFC94A;
    padding: 15px 20px;
    font-size: 1rem;
    border-radius: 30px;
    background: transparent;
    outline: none;
    transition: .3s;
}
 
.container .login-email .input-group input:focus, .container .login-email .input-group input:valid {
    border-color: #FFC94A;
}
 
.container .login-email .input-group .btn {
    display: block;
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    border: none;
    background: #FFC94A;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #FFF;
    cursor: pointer;
    transition: .3s;
}
 
.container .login-email .input-group .btn:hover {
    transform: translateY(-5px);
    background: #FFC94A;
}
 
.login-register-text {
    color: #111;
    font-weight: 600;
}
 
.login-register-text a {
    text-decoration: none;
    color: #FFC94A;
}
 
.container-logout {
    width: 500px;
    min-height: 200px;
    background: #FFF;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,.3);
    padding: 40px 30px;
}
 
.container-logout .login-email .input-group .btn {
    display: block;
    width: 100%;
    padding: 15px 20px;
    text-align: center;
    border: none;
    background: #FFC94A;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #FFF;
    cursor: pointer;
    transition: .3s;
    margin-top: 20px;
}
 
.container-logout .login-email .input-group .btn:hover {
    transform: translateY(-5px);
    background: #FFC94A;
}
 
@media (max-width: 430px) {
    .container {
        width: 300px;
    }
}
    </style>
</head>

<body>
    

<!--Form login-->
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>

            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>

            <div style='text-align: right;'>
                <p><a style='text-decoration: underline; color: #FFC94A; font-weight: 600;' href="lupa_password.html">Lupa Password</a></p><br>          
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
        </form>
    </div>
    <script>
    <?php if(isset($_SESSION['error'])): ?>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $_SESSION['error']; ?>',
                confirmButtonColor:'#FFC94A'
            });
        });
        <?php unset($_SESSION['error']);?>;
    <?php endif; ?> 
    </script>    
</body>
</html>