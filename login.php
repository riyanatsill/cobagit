<?php
require ('config.php');
session_start();

$error = '';
$validate = '';

if (isset($_SESSION['username'])) header('Location: home.php');
if (isset($_POST['submit'])){
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con, $password);
    if (!empty(trim($username)) && !empty(trim($password))){
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($con,$query);
        $rows = mysqli_num_rows($result);
        if ($rows != 0){
            $hash = mysqli_fetch_assoc($result)['password'];
            if (password_verify($password, $hash) && $_SESSION['code'] == $_POST['kodecaptcha']){
                $_SESSION['username'] = $username;
                header('Location: home.php');
            }
        } else{
            $error = 'Username atau Password Salah!';
        }
    } else{
        $error = 'Data tidak boleh kosong';
    }
}
?>
<!doctype html>
<html lang="`en`">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/tambahan.css" />
    <link rel="icon" type="image" sizes="32x32" href="images/favicon-32x32.png"/>
</head>
<body>
<header>
    <a class="title">JAMALGAMING</a>
    <nav>
        <ul>
<!--            <p><a href="register.php">Register</a></p>-->
        </ul>
    </nav>
</header>

<div class="col-12" id="data2">
    <div class="row background-data">
        <h2>Isi Data Anda</h2>
        <form action="login.php" method="POST">
            <?php if($error != ''){?>
                <div><?= $error;?></div>
            <?php } ?>
            <div class="col-12">
                <p>Username</p>
                <input type="text" class="input-submit" name="username" required="true" placeholder="Isi Username"/>
            </div>
            <div class="col-12">
                <p>Password</p>
                <input type="password" class="input-submit" name="password" required="true" placeholder="Isi Password"/>
                <?php if ($validate !='') { ?>
                    <p><?= $validate; ?></p>
                <?php } ?>
            </div>
            <div>
                <img src="captcha.php" alt="gambar" />
            </div>
            <p>Isi captcha</p>
            <div>
                <input class="input-submit" name="kodecaptcha" value="" maxlength="5"/>
            </div>
            <div class="col-12">
                <div class="row">
                    <Button type="submit" name="submit" class="input-submit3">Sign-In</Button>
                </div>
                <p>Belum punya akun? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>

</div>
</body>
</html>
