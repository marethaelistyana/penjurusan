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
// Hapus siswa
if ($module=='siswa' AND $act=='hapus'){
  mysqli_query($konek,"DELETE FROM tabel_siswa WHERE nomor_pendaftaran='$_GET[id]'");
  mysqli_query($konek,"DELETE FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='siswa' AND $act=='input'){

  
  mysqli_query($konek,"INSERT INTO tabel_siswa(nomor_pendaftaran,
                                               nama_siswa,
											                         tahun_angkatan) 
	                       VALUES('$_POST[nomor_pendaftaran]',
                                '$_POST[nama_siswa]',
                                '$_POST[tahun_angkatan]')");
	$jumls = mysqli_num_rows(mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY id_kriteria ASC"));
for ($ia=1; $ia<=$jumls; $ia++){
          $a  = $_POST['a'.$ia];
          $kriteria = $_POST['id_kriteria'.$ia];
  mysqli_query($konek,"INSERT INTO tabel_detail(nomor_pendaftaran,
									id_kriteria,
									nilai) 
							VALUES('$_POST[nomor_pendaftaran]',
								   '$kriteria',
								   '$a')");
	}								   
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=siswa')</script>";
		
}

// Update siswa
elseif ($module=='siswa' AND $act=='update'){
mysqli_query($konek,"DELETE FROM tabel_detail WHERE nomor_pendaftaran='$_POST[id]'");
  mysqli_query($konek,"UPDATE tabel_siswa SET nama_siswa    = '$_POST[nama_siswa]',
												tahun_angkatan = '$_POST[tahun_angkatan]'
                                       WHERE nomor_pendaftaran = '$_POST[id]'");
  $jumls = mysqli_num_rows(mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY id_kriteria ASC"));
for ($ia=1; $ia<=$jumls; $ia++){
          $a  = $_POST['a'.$ia];
          $kriteria = $_POST['id_kriteria'.$ia];
  mysqli_query($konek,"INSERT INTO tabel_detail(nomor_pendaftaran,
									id_kriteria,
									nilai) 
							VALUES('$_POST[nomor_pendaftaran]',
								   '$kriteria',
								   '$a')");
	}	
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=siswa')</script>";
}
}
?>
