<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="loginUser.php"</script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<title>Shopping Cart</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<link rel="icon" href="./img/logo.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css?t=<?php echo round(microtime(true)*1000);?>">
		<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	</head>
	<body>
	<header>
		<div class="container">
			<h1><a href="index.php"><img src="./img/logo.png" height="40dp" width="40dp"></a></h1>
			<ul>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>
	<div class="section">
		<div class="container">
			<h3>Shopping Cart</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th>Nama Produk</th>
							<th>Gambar</th>
							<th>Jumlah</th>
							<th>Harga</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$cart = mysqli_query($conn, "SELECT product_name, product_image, quantity, product_price FROM cart LEFT JOIN tb_product USING (product_id)");
							$final = 0;
							if(mysqli_num_rows($cart) > 0){
							while($row = mysqli_fetch_array($cart)){
								$subtotal = $row['product_price']*$row['quantity'];
								$final = $final + $subtotal;
						?>
						<tr>
							<td><?php echo $row['product_name'] ?></td>
							<td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"> <img src="produk/<?php echo $row['product_image'] ?>" width="50px"> </a></td>
							<td><?php echo $row['quantity'] ?></td>
							<td>Rp. <?php echo number_format($row['product_price']) ?></td>
							<td>Rp. <?php echo number_format($subtotal) ?></td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="7">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<h2>Total Rp. <?php echo number_format($final) ?></h2>
				<form action="" method="POST">
					<input type="submit" name="clear" value="Clear Cart" class="btn">
					<input type="submit" name="checkout" value="Checkout" class="btn">
				</form>
				<?php
					if(isset($_POST['clear']))
					{
						if(mysqli_num_rows($cart) < 1)
						{
							echo '<script>alert("Shopping Cart Kosong!")</script>';
						}
						else
						{
							mysqli_query($conn, "TRUNCATE TABLE cart");
							echo '<script>alert("Shopping Cart Cleared")</script>';
							echo '<script>window.location="shopping-cart.php"</script>';
						}
					}
					if(isset($_POST['checkout']))
					{
						if(mysqli_num_rows($cart) < 1)
						{
							echo '<script>alert("Shopping Cart Kosong!")</script>';
						}
						else
						{
							echo '<script>alert("Pesanan Anda Telah Diproses!")</script>';
							mysqli_query($conn, "TRUNCATE TABLE cart");
							echo '<script>window.location="index.php"</script>';
						}
					}
				?>
			</div>
		</div>
	</div>
	</body>
</html>