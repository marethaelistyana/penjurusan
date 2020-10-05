<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus jurusan
if ($module=='jurusan' AND $act=='hapus'){
  mysqli_query($konek,"DELETE FROM tabel_jurusan WHERE id_jurusan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input jurusan
elseif ($module=='jurusan' AND $act=='input'){
  mysqli_query($konek,"INSERT INTO tabel_jurusan(nama_jurusan) VALUES('$_POST[nama_jurusan]')");
  header('location:../../media.php?module='.$module);
}

// Update jurusan
elseif ($module=='jurusan' AND $act=='update'){
  mysqli_query($konek,"UPDATE tabel_jurusan SET nama_jurusan = '$_POST[nama_jurusan]' WHERE id_jurusan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
