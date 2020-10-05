<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kriteria
if ($module=='kriteria' AND $act=='hapus'){
  mysqli_query($konek,"DELETE FROM tabel_kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kriteria
elseif ($module=='kriteria' AND $act=='input'){
  mysqli_query($konek,"INSERT INTO tabel_kriteria(nama_kriteria,
												  id_jurusan,
												  bobot) 
										 VALUES('$_POST[nama_kriteria]','$_POST[jenis]',
												'$_POST[jurusan]',
												'$_POST[bobot]')");
  header('location:../../media.php?module='.$module);
}

// Update kriteria
elseif ($module=='kriteria' AND $act=='update'){
  mysqli_query($konek,"UPDATE tabel_kriteria SET nama_kriteria = '$_POST[nama_kriteria]',
												id_jurusan = '$_POST[jurusan]',
												bobot = '$_POST[bobot]' 
										WHERE id_kriteria = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
