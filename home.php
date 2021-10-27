<section id="main" >
		<div class="main-img">
	<img src="img/e.jpg">
</div>
<div class="name">
            <p>Whassaapp boii</p>
            <h1>Shopping With Us</h1>
            <p class="details">Biggest E-commerce in The Universe</p>
             <a href="#" class="cv-btn">Download Our Mobile App</a>
        </div>
        
</section>
	
<section id="new">
	<?php 
					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 1");
					if(mysqli_num_rows($produk) > 0){
						while($p = mysqli_fetch_array($produk)){
				?>

					<div class="new-text">
						<h1>Brand New</h1>
						<h2 class="nama"><?php echo substr($p['product_name'], 0, 30) ?></h2>
						<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
						<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
						<button>View Product</button>
						</a>
					</div>
					<div class="new-model">				
					<img src="produk/<?php echo $p['product_image'] ?>">
					</div>
				
				<?php }}else{ ?>
					<p>Tidak ada Produk Terbaru</p>
				<?php } ?>
    </section>
	<!-- category -->
    <section id="category">

    <h1 class="p-heading">Category</h1>
	
    <div class="p-b-container">
	<?php 
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if(mysqli_num_rows($kategori) > 0){
						while($k = mysqli_fetch_array($kategori)){
				?>
			
        <div class="p-box">
		<a href="produk.php?kat=<?php echo $k['category_id'] ?>">
            <div class="text-overlay">
							<h1><?php echo $k['category_name'] ?></p>
						</div>
					</a>
					<img src="kategori/<?php echo $k['category_image'] ?>">   
            </div>
			</a>
			<?php }}else{ ?>
					<p>Kategori tidak ada</p>
				<?php } ?>
			
        </div>
			</section>

            <!-- new product -->
<section id="all">
	<h1 class="p-heading">All Items</h1>
	<div class="section">
		<div class="container">
			
			<div class="box">
				<?php 
					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
					if(mysqli_num_rows($produk) > 0){
						while($p = mysqli_fetch_array($produk)){
				?>	
					<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="produk/<?php echo $p['product_image'] ?>" height="250dp" width="250dp">
							<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
							<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>
	</section>