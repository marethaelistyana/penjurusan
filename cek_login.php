<?php
include "config/koneksi.php";


$username = $_POST['username'];
$pass     = md5($_POST['password']);


$login=mysqli_query($konek,"SELECT * FROM tabel_login WHERE username='$username' AND password='$pass' ");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);


// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[user_id]     = $r[id];
  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  header('location:media.php?module=home');
}

else{

  echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";

}

?>
