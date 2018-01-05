<html>
<head><title>PT.Knalpot Jaya - Penjualan</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
    height: 100%;
    color: #777;
    line-height: 1.8;
}
</style>

	<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printContent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printContent;
		window.print();
		document.body.innerHTML = restorepage;
	}

	</script>
</head>
<body>

<div class="w3-main" id="main">

<!--navbar-->
	<?php include"navbar.php"; ?>
	
	<div class="w3-content w3-container w3-padding-16 ">
	<?php
		//tanggal-bulan-tahun
		date_default_timezone_set("Asia/Jakarta");
		$tgl=date('D - j - m - Y');
		$jam=date('H:i:s');
		echo "Date : ".$tgl."<br>";
		echo "Time : ".$jam."<br>";
	?>	
	
	<!--form input barang-->	
<div class="w3-content w3-padding">		

	<h3 class="w3-text-red"><b>Pencarian Kategori</b></h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div class="w3-row-padding" style="margin:0 -16px 8px -16px">

 <div class="w3-half">
	<div class="w3-col s12 m7">  
	<label class="w3-text-red">Kategori</label>
	<select class='w3-select w3-border' name='tahun'>
		<option value='pilih bulan'>Pilih Tahun</option>
		<option value='2016'>2016</option>
		<option value='2017'>2017</option>
		<option value='2018'>2018</option>
		<option value='2019'>2019</option>
		<option value='2020'>2020</option>
		<option value='2021'>2021</option>
		<option value='2022'>2022</option>
		<option value='2023'>2023</option>
	</select>

  </div>
  </div>

</div>
<button type="submit" name="submit" class="w3-btn w3-red w3-center w3-section">Search</button>
 <a onclick="printContent('div1')" class="w3-btn w3-red w3-center w3-section">Print</a><br>
  </form>
  
  
	<!--table pelanggan-->
  <div id="div1">	
  <h3 class="w3-text-red"><b>Laporan Data Pendapatan</b></h3>
	<div class="w3-responsive">
	<table class="w3-table-all">
	<tr>
		<th>No</th>
		<th>Tahun</th>
		<th>Total Pendapatan</th>
		<!--<th>Opsi</th>-->
	</tr>
	<tr>
		<?php
		
			//koneksi		
			$conn=mysqli_connect("localhost","root","","knalpotjaya");
			if(!$conn){
			die("connection failed :".mysqli_connect_error());
			}
		
			if(isset($_POST['submit'])){
			$tahun=$_POST['tahun'];	
			
			//mengambil data pendapatan
			$query=mysqli_query($conn,"SELECT YEAR(tgl_pembelian)as tahun,SUM(harga_satuan*jml_beli)+ 300.000 AS totalpendapatan 
			FROM detil_pembelian
			WHERE YEAR(tgl_pembelian)='$_POST[tahun]'");
			
			if(mysqli_num_rows($query)==0){
				echo '<tr><td colspan="6">tidak ada data </td></tr>';
			}else{
			
			$no=1;
			while($data=mysqli_fetch_array($query)){
			$rupiah=number_format($data['totalpendapatan'],3);
			echo "
				<tr>
				<td>$no</td>
				<td>$data[tahun]</td>
				<td>$rupiah</td>
				<!--<td><a class='w3-text-red' href='editbarang.php?id="./*$data['kd_barang'].*/"'>Edit</a>
				/ 
				<a class='w3-text-red' href='deletebarang.php?id="./*$data['kd_barang'].*/"' 
				onclick='return confirm(\"yakin ingin hapus ?\")'>Hapus</a></td>-->
				
				</tr>";
				$no++;
				
			}
			}
			}
		?>
	</tr>	
	</table>
	</div>
	</div>
	
</div>
</div>
</div>

<?php include"footer.html"?>	