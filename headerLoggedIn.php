<?php 
	session_start();
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);
    $id= $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Store</title>
	<link rel="icon" href="./img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css?t=<?php echo round(microtime(true)*1000);?>">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href=""><img src="./img/logo.png" height="40dp" width="40dp"></a></h1>
			<ul>
				<li><a href="#main">Download</a></li>
				<li><a href="#new">New</a></li>
				<li><a href="#category">Category</a></li>
                <li><a href="#all">All Items</a></li>
				<li><a href="profilUser.php?id=<?php echo $id ?>">Profile</a></li>
                <li><a href="keluar.php">Logout</a></li>
				<li><a href="shopping-cart.php"><i class="fas fa-shopping-cart" ></i></a></li>
			</ul>
		</div>
	</header>
	<!-- search -->
	
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Search Product">
				<input type="submit" name="cari" value="Search">
			</form>
		</div>
	</div>