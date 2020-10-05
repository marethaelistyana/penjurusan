<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus pembobotan
if ($module=='pembobotan' AND $act=='hapus'){
  mysqli_query($konek,"DELETE FROM tabel_pembobotan WHERE id_pembobotan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input pembobotan
elseif ($module=='pembobotan' AND $act=='input'){
$sql = mysqli_query($konek,"SELECT * FROM tabel_pembobotan WHERE id_jurusan='$_POST[jurusan]' AND id_kriteria='$_POST[kriteria]'");
$ketemu=mysqli_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! Data yang Anda masukkan sudah ada, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysqli_query($konek,"INSERT INTO tabel_pembobotan(id_kriteria,
													id_jurusan,
													bobot) 
										     VALUES('$_POST[kriteria]',
													'$_POST[jurusan]',
													'$_POST[bobot]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update pembobotan
elseif ($module=='pembobotan' AND $act=='update'){
  mysqli_query($konek,"UPDATE tabel_pembobotan SET id_kriteria = '$_POST[kriteria]',
												   id_jurusan = '$_POST[jurusan]',
												   bobot = '$_POST[bobot]'
										     WHERE id_pembobotan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
