<?php
$aksi="modul/mod_pembobotan/aksi_pembobotan.php";
switch($_GET[act]){
  // Tampil pembobotan
  default:
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Pembobotan</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Data Pembobotan</h2>
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
				  <input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=pembobotan&act=tambahpembobotan';\">
							<p>";
							}
							echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Jurusan</th>
						  <th>Kriteria</th>
						  <th>Bobot</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_pembobotan JOIN tabel_kriteria ON tabel_pembobotan.id_kriteria=tabel_kriteria.id_kriteria
																				JOIN tabel_jurusan ON tabel_pembobotan.id_jurusan=tabel_jurusan.id_jurusan
																				ORDER BY id_pembobotan DESC");
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_jurusan]</td>
						  <td>$r[nama_kriteria]</td>
						  <td>$r[bobot]</td>
                          <td>";
						if ($_SESSION['leveluser']=='admin'){
						echo"<a href=?module=pembobotan&act=editpembobotan&id=$r[id_pembobotan] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a> 
	                        <a href=$aksi?module=pembobotan&act=hapus&id=$r[id_pembobotan] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>";
							}
							echo"
							</td>
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
	// Form Tambah pembobotan
  case "tambahpembobotan":
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Pembobotan</h3>
              </div>
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Pembobotan</h2>
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
                    <form id='form1' method=POST action='$aksi?module=pembobotan&act=input' data-parsley-validate class='form-horizontal form-label-left'>
                      
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
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Kriteria</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select class='form-control col-md-7 col-xs-12' name='kriteria' required>
							<option value='' selected>- Pilih Kriteria -</option>";
								$tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY nama_kriteria ASC");
								while($r=mysqli_fetch_array($tampil)){
								echo "<option value=$r[id_kriteria]>$r[nama_kriteria]</option>";
								}
						echo "</select>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Bobot</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' step='0.01' name='bobot' required>
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
  
  // Form Edit pembobotan  
  case "editpembobotan":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_pembobotan WHERE id_pembobotan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Pembobotan</h3>
              </div>   
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Edit Pembobotan</h2>
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
                    <form id='form1' method=POST action='$aksi?module=pembobotan&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[id_pembobotan]'> 
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
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Kriteria</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select class='form-control col-md-7 col-xs-12' name='kriteria' required>";
							$tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY nama_kriteria ASC");
								if ($r[id_kriteria]==0){
								echo "<option value=0 selected>- Pilih Kriteria -</option>";
								}   

							while($w=mysqli_fetch_array($tampil)){
								if ($r[id_kriteria]==$w[id_kriteria]){
								echo "<option value=$w[id_kriteria] selected>$w[nama_kriteria]</option>";
								}
								else{
								echo "<option value=$w[id_kriteria]>$w[nama_kriteria]</option>";
								}
								}
							echo "</select>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Bobot</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' step='0.01' name='bobot' value='$r[bobot]' required>
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
