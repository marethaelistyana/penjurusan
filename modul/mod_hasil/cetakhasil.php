<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";

$tanggal = date("Y-m-d");
$tanggal3=tgl_indo($tanggal);

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Laporan Hasil Perhitungan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css" media="print">
body{
	font-size: 12px;
}
@page
{
	size: landscape;
	margin: 2cm;
	font-size: 10px;
}
</style>
</head>

<body onload="print()">

<!-- Part 1: Wrap all page content here -->
<div id="wrap">

<header class="container jumbotron subhead" id="overview">
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
      <center>
        <h3>SMA Stella Duce 2 Yogyakarta</h3>
    </center>
      </div>
    </div>
  </div>
</header>
<!-- Begin page content -->
<div class="container bg">
  <div class="row-fluid">
    <div class="span12">
      <div>
<center><h5>Laporan Hasil Perhitungan</h5></center>

  <table class="table" border="1" width="100%">
    <thead>
      <tr>
        <th>No</th>
		<th>Nama Siswa</th>
						  <th>Tahun Angkatan</th>
						  <th>Jurusan</th>
						  <th>Skor</th>
      </tr>
    </thead>
    <tbody>
    <?php
	if ($_GET[tahun] == ''){
	$tampil=mysqli_query($konek,"SELECT MAX(tabel_hasil.net_flow) AS nilai, tabel_hasil.id_jurusan, tabel_siswa.nomor_pendaftaran,tabel_siswa.nama_siswa,tabel_siswa.tahun_angkatan,tabel_jurusan.nama_jurusan
																						FROM tabel_siswa,tabel_hasil,tabel_jurusan 
																						WHERE tabel_siswa.nomor_pendaftaran=tabel_hasil.nomor_pendaftaran
																						
																						GROUP BY tabel_hasil.nomor_pendaftaran
																						ORDER BY tabel_hasil.net_flow DESC");
	}
	if ($_GET[tahun] != ''){
$tampil=mysqli_query($konek,"SELECT MAX(tabel_hasil.net_flow) AS nilai, tabel_hasil.id_jurusan, tabel_siswa.nomor_pendaftaran,tabel_siswa.nama_siswa,tabel_siswa.tahun_angkatan,tabel_jurusan.nama_jurusan
																						FROM tabel_siswa,tabel_hasil,tabel_jurusan 
																						WHERE tabel_siswa.nomor_pendaftaran=tabel_hasil.nomor_pendaftaran
																						AND tabel_siswa.tahun_angkatan='$_GET[tahun]'
																						GROUP BY tabel_hasil.nomor_pendaftaran
																						ORDER BY tabel_hasil.net_flow DESC");
}	
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
					$n = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM tabel_hasil,tabel_jurusan where tabel_hasil.id_jurusan=tabel_jurusan.id_jurusan
																					AND tabel_hasil.net_flow='$r[nilai]'"));
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_siswa]</td>
						  <td>$r[tahun_angkatan]</td>
						  <td>$n[nama_jurusan]</td>
						  <td>$r[nilai]</td>
                        </tr>";
		  $no++;
    }
    ?>
    </tbody>
  </table>
  <div style="clear:both"></div>
  <table width="100%">
  <tbody>
	<tr>
		<td colspan="8" style="height:20px"></td>
	</tr>
	<tr>
		<td width="70%"></td>
		<td align="center">
		Yogyakarta, <?php echo" $tanggal3";?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td align="center">
		Admin
		</td>
	</tr>
	<tr>
		<td colspan=2 style="height:65px"></td>
	</tr>
	<tr>
		<td></td>
		<th>
		(<?php echo"$_SESSION[namalengkap]";?> )
		</th>
	</tr>
	</tbody>
  </table>
      </div>
    </div>
  </div>
  <div id="push"></div>
</div>
</body>
</html>
