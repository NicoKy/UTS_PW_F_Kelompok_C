<?php 
	session_start();
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bukawarung</title>
	<link rel="icon" href="./img/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/style.css?t=<?php echo round(microtime(true)*1000);?>">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php"><img src="./img/logo.png" height="40dp" width="40dp"></a></h1>
			<ul>
				<li><a href="produk.php">All Items</a></li>
				<li><a href="shopping-cart.php"><i class="fas fa-shopping-cart" ></i></a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Search Product" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Search">
			</form>
		</div>
	</div>

	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="produk/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p->product_description ?>
					</p>
					<form action="" method="POST">
						<input type="number" placeholder="Jumlah" style="text-align: center;" name="jumlah" id="jumlah">
						<p>
							<input type="submit" name="submit" value="Add To Cart" class="btn">
						</p>
					</form>
					<?php
					if(isset($_POST['submit']))
					{
						if($_SESSION['status_login'] != true)
						{
							echo '<script>window.location="loginUser.PHP"</script>';
						}
						$id = $_GET['id'];
						$quantity = $_POST['jumlah'];
						$cek = mysqli_query($conn, "SELECT quantity FROM cart WHERE product_id = '$id'");
						if(mysqli_num_rows($cek) > 0)
						{
							$c = mysqli_fetch_object($cek);
							$total = $quantity + $c->quantity;
							$update = mysqli_query($conn, "UPDATE cart SET quantity = '$total'");
							
							if($update){
								echo '<script>alert("Added To Cart")</script>';
								echo '<script>window.location="detail-produk.php?id='.$id.'"</script>';
							}else{
								echo 'gagal '.mysqli_error($conn);
							}
						}
						else
						{
							$insert = mysqli_query($conn, "INSERT INTO cart(product_id, quantity) VALUES ('".$id."', '".$quantity."') ");
				
							if($insert){
								echo '<script>alert("Added To Cart")</script>';
								echo '<script>window.location="detail-produk.php?id='.$id.'"</script>';
							}else{
								echo 'gagal '.mysqli_error($conn);
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			
			<small>UTS</small>
		</div>
	</div>
</body>
</html>