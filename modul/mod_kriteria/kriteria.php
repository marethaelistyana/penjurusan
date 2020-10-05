<?php
$aksi="modul/mod_kriteria/aksi_kriteria.php";
switch($_GET[act]){
  // Tampil kriteria
  default:
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Kriteria</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Data Kriteria</h2>
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
				  <input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=kriteria&act=tambahkriteria';\">
							<p>";
							}
							echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Nama Kriteria</th>
						  <th>Jurusan</th>
						  <th>Bobot</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria LEFT JOIN tabel_jurusan ON tabel_kriteria.id_jurusan=tabel_jurusan.id_jurusan ORDER BY tabel_kriteria.id_jurusan ASC");
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_kriteria]</td>
						  <td>$r[nama_jurusan]</td>
						  <td>$r[bobot]</td>
                          <td>";
						if ($_SESSION['leveluser']=='admin'){
						echo"<a href=?module=kriteria&act=editkriteria&id=$r[id_kriteria] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a> 
	                        <a href=$aksi?module=kriteria&act=hapus&id=$r[id_kriteria] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>";
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
              <th>Nama Kriteria</th>
              <th>Jurusan</th>
              <th>Bobot</th>
                        </tr>
                      </thead>
                      <tbody>";
          $tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria LEFT JOIN tabel_jurusan ON tabel_kriteria.id_jurusan=tabel_jurusan.id_jurusan ORDER BY tabel_kriteria.id_jurusan ASC");
          $no=1;
          while ($r=mysqli_fetch_array($tampil)){
            echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_kriteria]</td>
              <td>$r[nama_jurusan]</td>
              <td>$r[bobot]</td>
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
	// Form Tambah kriteria
  case "tambahkriteria":
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Kriteria</h3>
              </div>
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Kriteria</h2>
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
                    <form id='form1' method=POST action='$aksi?module=kriteria&act=input' data-parsley-validate class='form-horizontal form-label-left'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Kriteria</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_kriteria' required>
                        </div>
                      </div>
					 <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Jurusan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select class='form-control col-md-7 col-xs-12' name='jurusan' required>
							<option value='' selected>- Pilih Jurusan -</option>";
								$tampil=mysqli_query($konek,"SELECT * FROM tabel_jurusan ORDER BY nama_jurusan ASC");
								while($r=mysqli_fetch_array($tampil)){
								echo "<option value=$r[id_jurusan]>$r[nama_jurusan]</option>";
								}
						echo "</select>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Bobot</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' step='0.001' name='bobot' required>
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
  
  // Form Edit kriteria  
  case "editkriteria":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Kriteria</h3>
              </div>   
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Edit Kriteria</h2>
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
                    <form id='form1' method=POST action='$aksi?module=kriteria&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[id_kriteria]'> 
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Kriteria</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_kriteria' value='$r[nama_kriteria]' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Jurusan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select class='form-control col-md-7 col-xs-12' name='jurusan' required>";
							$tampil=mysqli_query($konek,"SELECT * FROM tabel_jurusan ORDER BY nama_jurusan ASC");
								if ($r[id_jurusan]==0){
								echo "<option value=0 selected>- Pilih Jurusan -</option>";
								}   

							while($w=mysqli_fetch_array($tampil)){
								if ($r[id_jurusan]==$w[id_jurusan]){
								echo "<option value=$w[id_jurusan] selected>$w[nama_jurusan]</option>";
								}
								else{
								echo "<option value=$w[id_jurusan]>$w[nama_jurusan]</option>";
								}
								}
							echo "</select>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Bobot</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' step='0.001' name='bobot' value='$r[bobot]' required>
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
