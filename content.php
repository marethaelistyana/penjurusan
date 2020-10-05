<?php
   include "config/koneksi.php";
   include "config/library.php";
   include "config/fungsi_indotgl.php";
   include "config/class_paging.php";
// Bagian Home
if ($_GET['module']=='home'){
$tgl_skrg = date("Y-m-d");
echo" <h3>Dashboard</h3>
		  <br>
			  <p>Selamat datang di Halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		  
		  <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
		  
		  ";
}
// Bagian kriteria
elseif ($_GET['module']=='kriteria'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='kepsek'){
    include "modul/mod_kriteria/kriteria.php";
  }
}
// Bagian jurusan
elseif ($_GET['module']=='jurusan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='kepsek'){
    include "modul/mod_jurusan/jurusan.php";
  }
}
// Bagian pembobotan
elseif ($_GET['module']=='pembobotan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pembobotan/pembobotan.php";
  }
}
// Bagian staf
elseif ($_GET['module']=='staf'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='staf'){
    include "modul/mod_staf/staf.php";
  }
}
// Bagian kepsek
elseif ($_GET['module']=='kepsek'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='kepsek'){
    include "modul/mod_kepsek/kepsek.php";
  }
}
// Bagian User
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }
}

// Bagian siswa
elseif ($_GET['module']=='siswa'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='staf' OR $_SESSION['leveluser']=='kepsek'){
    include "modul/mod_siswa/siswa.php";
  }
}
// Bagian analisis
elseif ($_GET['module']=='analisis'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_analisis/analisis.php";
  }
}
// Bagian Tag
elseif ($_GET['module']=='hasil'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='staf' OR $_SESSION['leveluser']=='kepsek'){
    include "modul/mod_hasil/hasil.php";
  }
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>