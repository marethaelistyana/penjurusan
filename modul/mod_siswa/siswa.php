<?php
$aksi="modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil siswa
  default:
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Siswa</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Data Siswa</h2>
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
			if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='staf'){
			echo"
				  <input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=siswa&act=tambahsiswa';\">
							<p>";
							}
							echo"
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                        <th>No </th>
                          <th>No Pendaftaran</th>
					             	  <th>Nama Siswa</th>
						              <th>Tahun Angkatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa ORDER BY nomor_pendaftaran ASC");
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nomor_pendaftaran]</td>
                          <td>$r[nama_siswa]</td>
						  <td>$r[tahun_angkatan]</td>
                          <td>";
						if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='staf'){
						echo"<a href='?module=siswa&act=editsiswa&id=$r[nomor_pendaftaran]' class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a> 
	                        <a href='$aksi?module=siswa&act=hapus&id=$r[nomor_pendaftaran]' class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>";
							}
							echo"
							<a href='?module=siswa&act=detailsiswa&id=$r[nomor_pendaftaran]' class='btn btn-success btn-sm' title='Detail'><i class='fa fa-folder'></i></a>
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
	// Form Tambah siswa
  case "tambahsiswa":
  echo"
  <div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Siswa</h3>
              </div>
            </div>
            <div class='clearfix'></div>
            <div class='row'>
        <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Tambah Siswa</h2>
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
                    <form id='form1' method=POST action='$aksi?module=siswa&act=input' data-parsley-validate class='form-horizontal form-label-left'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nomor Pendaftaran</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='string' name='nomor_pendaftaran' placeholder='Masukkan Nomor Pendaftaran' maxlength='10' required>
                        </div>
                      </div>
            <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Siswa</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_siswa' placeholder='Masukkan Nama Siswa' required>
                        </div>
                      </div>
            <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Tahun Angkatan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='tahun_angkatan' placeholder='Masukkan Tahun Angakatan' required>
                        </div>
                      </div>
            
            <table class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
              <th>Nama Kriteria</th>
              <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>";
          $tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY id_kriteria DESC");
          $no=1;
          while ($r=mysqli_fetch_array($tampil)){
            echo "
                        <tr>
                          <td>$no</td>
                          <td><input type='hidden' name='id_kriteria".$no."' value='$r[id_kriteria]'>$r[nama_kriteria]</td>
              <td><input class='form-control' name='a".$no."' type='number' min='0' step='0.001' value='$n[nilai]' placeholder='Isikan Nilai' required></td>
                        </tr>";

            $no++;
            }
                        echo"
                      </tbody>
                    </table>
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
  // Form Edit siswa  
  case "editsiswa":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_siswa WHERE nomor_pendaftaran='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Siswa</h3>
              </div>   
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Form Edit Siswa</h2>
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
                    <form id='form1' method=POST action='$aksi?module=siswa&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[nomor_pendaftaran]'> 
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nomor Pendaftaran</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='string' name='nomor_pendaftaran' value='$r[nomor_pendaftaran]' required readonly>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Siswa</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_siswa' value='$r[nama_siswa]' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Tahun Angkatan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='tahun_angkatan' value='$r[tahun_angkatan]' placeholder='Masukkan Tahun Angakatan' required>
                        </div>
                      </div>
					  
					  <table class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Nama Kriteria</th>
						  <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY id_kriteria DESC");
					$no=1;
					while ($p=mysqli_fetch_array($tampil)){
					$n = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$r[nomor_pendaftaran]' AND id_kriteria='$p[id_kriteria]'"));
						echo "
                        <tr>
                          <td>$no</td>
                           <td><input type='hidden' name='id_kriteria".$no."' value='$p[id_kriteria]'>$p[nama_kriteria]</td>
						   <td><input class='form-control' name='a".$no."' type='number' min='0' step='0.01' value='$n[nilai]' placeholder='Isikan Nilai' required></td>
						   
                          
                        </tr>";
						$no++;
						}
                        echo"
                      </tbody>
                    </table>
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

// Form Detail siswa  
  case "detailsiswa":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_siswa WHERE nomor_pendaftaran='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
	echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Siswa</h3>
              </div>   
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Detail Siswa</h2>
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
                    <form id='form1' method=POST action='$aksi?module=siswa&act=update' data-parsley-validate class='form-horizontal form-label-left'>
					<input type=hidden name=id value='$r[nomor_pendaftaran]'> 
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nomor Pendaftaran</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nomor_pendaftaran' value='$r[nomor_pendaftaran]' readonly>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Siswa</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_siswa' value='$r[nama_siswa]' readonly>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Tahun Angkatan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='tahun_angkatan' value='$r[tahun_angkatan]' placeholder='Masukkan Tahun Angakatan' readonly>
                        </div>
                      </div>
					  
					  <table class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Nama Kriteria</th>
						  <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_kriteria ORDER BY id_kriteria DESC");
					$no=1;
					while ($p=mysqli_fetch_array($tampil)){
					$n = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$r[nomor_pendaftaran]' AND id_kriteria='$p[id_kriteria]'"));
						echo "
                        <tr>
                          <td>$no</td>
                           <td>$p[nama_kriteria]</td>
						   <td>$n[nilai]</td>
                          
                        </tr>";
						$no++;
						}
                        echo"
                      </tbody>
                    </table>
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
						  <input type=button class='btn btn-danger' value='Kembali' onclick=\"window.location.href='?module=siswa';\">
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
