<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="icon" href="./img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css?t=<?php echo round(microtime(true)*1000);?>">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
		<header>
			<div class="container">
				<h1><a href="index.php"><img src="./img/logo.png" height="50dp" width="50dp"></a></h1>
			</div>
		</header>
	<div class="box-login">
		<h2>Login as Admin</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="login" value="Login" class="btn">
		</form>
		<a href="register.php">Click to Register</a>
		<br>
		<a href="loginUser.php">Login as User</a>
		<?php 
			if(isset($_POST['login'])){
				session_start();
				include 'db.php';

				$user = mysqli_real_escape_string($conn, $_POST['user']);
				$pass = mysqli_real_escape_string($conn, $_POST['pass']);

				$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;
					echo '<script>window.location="dashboard.php"</script>';
				}else{
					echo '<script>alert("Username atau password Anda salah!")</script>';
				}

			}
		?>
	</div>
</body>
</html>