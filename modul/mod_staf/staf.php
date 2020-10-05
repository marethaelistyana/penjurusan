<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_staf/aksi_staf.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Staf PSB</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Data Staf PSB</h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
                      </li>
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>";
				  if ($_SESSION['leveluser']=='admin'){
				  echo"
				  <input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=staf&act=tambahstaf';\">
							<p>";
				}
				echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Username</th>
						  <th>Nama</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>";
					if ($_SESSION['leveluser']=='admin'){
					$tampil = mysqli_query($konek,"SELECT * FROM tabel_login WHERE level='staf' ORDER BY id ASC");
					}
					else {
					$tampil = mysqli_query($konek,"SELECT * FROM tabel_login WHERE id='$_SESSION[user_id]'");
					}
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[username]</td>
						  <td>$r[nama_lengkap]</td>
                          <td><a href=?module=staf&act=editstaf&id=$r[id] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>";
							if ($_SESSION['leveluser']=='admin'){
							echo"
	                      <a href=$aksi?module=staf&act=hapus&id=$r[id] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>";
						  }
						  echo"</td>
                        </tr>";
						$no++;
						}
                        echo"
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>";
 
    break;
  
  case "tambahstaf":
   echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Staf PSB</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Staf PSB</h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>  
                      </li>
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <br />
                    <form id='form1' method=POST action='$aksi?module=staf&act=input' data-parsley-validate class='form-horizontal form-label-left'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Username</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='username' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Password</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input  class='form-control col-md-7 col-xs-12' type='password' name='password' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input  class='form-control col-md-7 col-xs-12' type='text' name='nama_lengkap' required>
                        </div>
                      </div>
					  
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                          <button type='submit' class='btn btn-success'>Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>";
	break;

  case "editstaf":
	$edit=mysqli_query($konek,"SELECT * FROM tabel_login WHERE id='$_GET[id]'");
    $r=mysqli_fetch_array($edit);	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Staf PSB</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Edit Staf PSB</h2>
                    <ul class='nav navbar-right panel_toolbox'>
                      <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                      </li>
                      <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
                        
                      </li>
                      <li><a class='close-link'><i class='fa fa-close'></i></a>
                      </li>
                    </ul>
                    <div class='clearfix'></div>
                  </div>
                  <div class='x_content'>
                    <br />
                    <form id='form2' method=POST action='$aksi?module=staf&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[id]'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Username</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='username' value='$r[username]' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Password</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='password' name='password'>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_lengkap' value='$r[nama_lengkap]' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'></label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
				          <p class='help-block'>*) Apabila password tidak diubah, dikosongkan saja.</p>
                        </div>
                      </div>
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                          <button type='submit' class='btn btn-success'>Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>";
       
    break;  
}
}
?>
