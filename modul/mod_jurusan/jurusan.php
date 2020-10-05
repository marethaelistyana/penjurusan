<?php
$aksi="modul/mod_jurusan/aksi_jurusan.php";
switch($_GET[act]){
  // Tampil jurusan
  default:
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Jurusan</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Data Jurusan</h2>
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
			if ($_SESSION['leveluser']=='admin'){
			echo"
				  <input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=jurusan&act=tambahjurusan';\">
							<p>";
							}
							echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Nama Jurusan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_jurusan ORDER BY id_jurusan DESC");
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_jurusan]</td>
                          <td>";
						if ($_SESSION['leveluser']=='admin'){
						echo"<a href=?module=jurusan&act=editjurusan&id=$r[id_jurusan] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a> 
	                        <a href=$aksi?module=jurusan&act=hapus&id=$r[id_jurusan] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>";
							}
							echo"
							</td>
                        </tr>";
						$no++;
						}
          }
          if ($_SESSION['leveluser']=='kepsek'){            
              echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
              <th>Nama Jurusan</th>
                        </tr>
                      </thead>
                      <tbody>";
          $tampil=mysqli_query($konek,"SELECT * FROM tabel_jurusan ORDER BY id_jurusan DESC");
          $no=1;
          while ($r=mysqli_fetch_array($tampil)){
            echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_jurusan]</td>
                        </tr>";
            $no++;
            }
          }
                        echo"
                      </tbody>
                      </tbody>
                    </table>
                    </table>
                  </div>
                </div>
              </div>

            
            </div>
          </div>";
	
     break;
	// Form Tambah jurusan
  case "tambahjurusan":
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Jurusan</h3>
              </div>
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Jurusan</h2>
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
                    <form id='form1' method=POST action='$aksi?module=jurusan&act=input' data-parsley-validate class='form-horizontal form-label-left'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Jurusan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_jurusan' required>
                        </div>
                      </div>
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                          <button type='submit' class='btn btn-success'>Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>";
	
     break;
  
  // Form Edit jurusan  
  case "editjurusan":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_jurusan WHERE id_jurusan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Jurusan</h3>
              </div>   
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Edit Jurusan</h2>
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
                    <form id='form1' method=POST action='$aksi?module=jurusan&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[id_jurusan]'> 
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Jurusan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_jurusan' value='$r[nama_jurusan]' required>
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
?>
