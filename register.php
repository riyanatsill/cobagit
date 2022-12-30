<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require ('function.php');
$user = query ("SELECT * FROM user ORDER BY id ASC");
session_start();

$error = '';
$validate = '';
if(isset($_SESSION['user'])) header('Location: index.php');
if(isset($_POST['submit'])){
    $nama = stripslashes($_POST['nama']);
    $nama = mysqli_real_escape_string($conn, $nama);
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $repass = stripslashes($_POST['repassword']);
    $repass = mysqli_real_escape_string($conn, $repass);

    if (!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
        if ($password == $repass){
            if (cek_nama($nama,$conn) == 0){
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO user (nama,username,email,password) VALUES ('$nama','$username','$email','$pass')";
                $result = mysqli_query($conn, $query);
                if ($result){
                    $_SESSION['username'] = $username;
                    header('Location: index.php');
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
function cek_nama($username,$conn){
    $name = mysqli_real_escape_string($conn,$username);
    $query = "SELECT * FROM user WHERE username = '$name'";
    if ($result = mysqli_query($conn,$query)) return mysqli_num_rows($result);
}
?>
</body>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="register.css">
    <title>Produk Baru</title>
</head>

<header>
        <div class="wrapper">
            <div class="row">
                <div class="col-0">
        </div>
        <div class="col-6">
            
        <ul>
            <font face="Sans-serif" color="black" size="4">
                
        </div>
        <div class="col-6">
        <form action="register.php" method="get">
            <div class="input-group">
            <div class="form-outline">
                
            </div>
        </form>
        </div>
    </div>
    </div>
</header>
<div class="register.css">
    <div class="wrapper">
        <div style="color:red;">
       
    <br>
    </div>
    <form action = "register.php" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label> Nama* </label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
            <label> Username* </label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label> Email* </label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label> Password* </label>
            <input type="password" class="form-control" name="password">

            <?php if ($validate !='') { ?>
                <p><?= $validate; ?></p>
                <?php } ?>
        </div>
        <div class="form-group">
            <label> Repassword* </label>
            <input type="password" class="form-control" name="repassword">
            
            <?php if ($validate !='') { ?>
                <p><?= $validate; ?></p>
                <?php } ?>
        </div>
        <Button type="submit" name="submit" class="btn btn-info">Register</Button>
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
    <br><br><br>
    </div>
   
</html>