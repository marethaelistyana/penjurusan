<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
// Hapus admin
if ($module=='admin' AND $act=='hapus'){
  mysqli_query($konek,"DELETE FROM tabel_login WHERE id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='admin' AND $act=='input'){
$sql = mysqli_query($konek,"SELECT * FROM tabel_login WHERE username='$_POST[username]'");
$ketemu=mysqli_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! Username yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  $pass=md5($_POST[password]);
  mysqli_query($konek,"INSERT INTO tabel_login(username,
                                 password,
                                 nama_lengkap,
                                 level) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                'admin')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=admin')</script>";
		}
}

// Update user
elseif ($module=='admin' AND $act=='update'){
  if (empty($_POST[password])) {
    mysqli_query($konek,"UPDATE tabel_login SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  username         = '$_POST[username]'
                           WHERE  id     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysqli_query($konek,"UPDATE tabel_login SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 username         = '$_POST[username]'
                           WHERE id      = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=admin')</script>";
}
}
?>
