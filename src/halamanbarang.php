<html>
<head>
	<title>Halaman Barang</title>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<script src="js/validasibeli.js"></script>
	<?php
		include "config.php";
		session_start();
		if(!isset($_SESSION['id']))
			header("location:index.php");
		$q="'".$_GET["q"]."'";
		$result1 = mysql_query("SELECT * FROM barang WHERE kategori=$q");
		if ($result1!=null) {
			$row1 = mysql_fetch_array($result1);
			$username = "'".$_SESSION['id']."'";
			$result2 = mysql_query("SELECT * FROM shopping_bag WHERE username=$username and status='Belum Selesai'");
			if (mysql_num_rows($result2)>0) {
				$row2 = mysql_fetch_array($result2);
				$id_shopping_bag = $row2['id_shopping_bag'];
				$result3 = mysql_query("SELECT * FROM detail_shopping_bag WHERE id_shopping_bag=$id_shopping_bag and id_barang=$q");
				if (mysql_num_rows($result3)>0) {
					$row3 = mysql_fetch_array($result3);
				}
			}
		}
	?>
</head>

<body>
	<div id="container">
		<?php include "header.php"?>
		<div id="tab_tengah"> 
			<?php while ($row1 = mysql_fetch_array($result1)) { ?>
				<h3><?php echo strtoupper($_GET["q"]);?></h3>
				<div id="gambar" >
					<?php echo '<img src="'.$row1['url_gambar'].'">'; ?>
				</div>
				<div id="detail_barang">
					<div class="tampil_data">
						Nama Barang :
					</div>
					<div class="tampil_data">
						<a href='detailbarang.php?q=<?php echo $row1['id_barang'];?>'> <?php echo $row1['nama'];?></a>
					</div>
					<div class="tampil_data">
						<?php echo $row1['kategori'];?>
					</div>
					<div class="tampil_data">
						Harga Satuan :
					</div>
					<div class="tampil_data">
						<?php echo $row1['harga'];?>
					</div>
					<form name="pesan_form" method="post" onsubmit="return checkStokBarang(document.pesan_form.jumlah_beli.value,<?php echo $row1['stok'];?>)" action=<?php echo '"pesanbarang.php?q='.$q.'"';?> enctype="multipart/form-data">
					<div class="form_field">
						<div class="field_kiri">
							Jumlah dibeli : 
						</div>
						<div class="field_kanan">
							<input name="jumlah_beli" type="text"  maxlength="256" value=<?php if (mysql_num_rows($result2)>0){ if(mysql_num_rows($result3)>0) { echo $row3['jumlah'];}}?>> 
						</div>						
					</div>
					<div class="form_field">
						<div class="field_kiri">
							Keterangan : 
						</div>
						<div class="field_kanan">
							<input name="keterangan" type="text"  maxlength="256" value=<?php if (mysql_num_rows($result2)>0){ if(mysql_num_rows($result3)>0) { echo $row3['keterangan'];}}?>> 
						</div>						
					</div>
					<div class="form_field">
						<div class="field_kiri">
							<input type="submit" name="submit" value="Pesan">	
						</div>
						<div class="field_kanan">
						</div>						
					</div>
				</form>
				</div>	
			<?php } ?>
		</div>
	</div>
</body>
</html>
