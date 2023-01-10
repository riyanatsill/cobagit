<!doctype html>
<html lang="`en`">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/tambahan.css" />
    <link rel="icon" type="image" sizes="32x32" href="images/favicon-32x32.png"/>
</head>
<body>
<?php
require ('config.php');
session_start();

$error = '';
$validate = '';
if(isset($_SESSION['user'])) header('Location: home.php');
if(isset($_POST['submit'])){
    $nama = stripslashes($_POST['nama']);
    $nama = mysqli_real_escape_string($con, $nama);
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $repass = stripslashes($_POST['repassword']);
    $repass = mysqli_real_escape_string($con, $repass);

    if (!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
        if ($password == $repass){
            if (cek_nama($nama,$con) == 0){
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO user (nama,username,email,password) VALUES ('$nama','$username','$email','$pass')";
                $result = mysqli_query($con, $query);
                if ($result){
                    $_SESSION['username'] = $username;
                    header('Location: home.php');
                } else{
                    $error = 'Register User Gagal !';
                }
            } else{
                $error = 'Username Sudah Terdaftar !';
            }
        } else{
            $validate = 'Password tidak sama !';
        }
    } else{
        $error = 'Data tidak boleh kosong !';
    }
}
function cek_nama($username,$con){
    $name = mysqli_real_escape_string($con,$username);
    $query = "SELECT * FROM user WHERE username = '$name'";
    if ($result = mysqli_query($con,$query)) return mysqli_num_rows($result);
}
?>
<header>
    <a class="title">JAMALGAMING</a>
    <nav>
        <ul>
<!--            <p><a href="login.php">Login</a></p>-->
        </ul>
    </nav>
</header>

<div class="col-12" id="data2">
    <div class="row background-data">
        <h2>Isi Data Anda</h2>
        <form action="register.php" method="POST">
            <?php if($error != ''){?>
            <div><?= $error;?></div>
            <?php } ?>
            <div class="col-12 ">
                <p>Nama</p>
                <input type="text" class="input-submit" id="nama" name="nama" required="true" placeholder="Isi Nama"/>
            </div>
            <div class="col-12">
                <p>Alamat Email</p>
                <input type="text" class="input-submit" id="email" name="email" required="true" placeholder="Isi email"/>
            </div>
            <div class="col-12">
                <p>Username</p>
                <input type="text" class="input-submit" id="username" name="username" required="true" placeholder="Isi Username"/>
            </div>
            <div class="col-12">
                <p>Password</p>
                <input type="password" class="input-submit" id="password" name="password" required="true" placeholder="Isi Password"/>
                <?php if ($validate !='') { ?>
                <p><?= $validate; ?></p>
                <?php } ?>
            </div>
            <div class="col-12">
                <p>Re-Password</p>
                <input type="password" class="input-submit" id="repassword" name="repassword" required="true" placeholder="Isi Password"/>
                <?php if ($validate !='') { ?>
                    <p><?= $validate; ?></p>
                <?php } ?>
            </div>
            <div class="col-12">
                <div class="row">
                    <Button type="submit" name="submit" class="input-submit2">Register</Button>
                </div>
            </div>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>

</div>
</body>
</html>

