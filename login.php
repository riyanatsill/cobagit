<?php
require ('function.php');
session_start();

$error = '';
$validate = '';

if (isset($_SESSION['username'])) header('Location: index.php');
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
            if (password_verify($password, $hash)&& $_SESSION['code'] == $_POST['kodecaptcha']){
                $_SESSION['username'] = $username;
                header('Location: index.php');
            }
        } else{
            $error = 'Register user gagal';
        }
    } else{
        $error = 'Data tidak boleh kosong';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="assets/styles/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<header>
 	<div class="jumbotron3">
		
     </div>
   </header>
	 <br>
	 <br>
	 <div class="card3" style="margin-top: 5%; text-align: center;">
	 	<h1 style="color: purple; margin-bottom: 0;">Zizi's Pet Hotel</h1>
        <p style="margin-top: 0;">Welcome!</p>
	 	<figure style="text-align: center;">
       		
   		</figure>
   		<br>
   		<br>
	<form action="login.php" method="post"style="text-align: center;">
        
        <div class="form-group">
            <label> Username* </label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label> Password* </label>
            <input type="password" class="form-control" name="password">

            <?php if ($validate !='') { ?>
                <p><?= $validate; ?></p>
                <?php } ?>
            
        </div>
        <div class="form-group">
        <tr>
<td>Captcha</td>
<!-- tentukan letak script generate gambar -->
<td><img src="captcha.php" alt="gambar" /> </td>
</tr>
<td>Isikan captcha </td>
<td><input name="kodecaptcha" value="" maxlength="5"/></td>
</div>
<tr>  
    <button style="width: 30%;" type="submit" name="submit" class="btn">Login Admin</button>
	<p>Belum punya akun? <a href="register.php">Register</a></p>
</form>
<br>
<br>

</div>

</body>
</html>