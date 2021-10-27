<?php
    include 'db.php';

    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['id']."' ");
        echo '<script>window.location="data-kategori.php"</script>';
    }
?>