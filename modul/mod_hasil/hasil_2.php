<?php
$aksi="modul/mod_siswa/aksi_siswa.php";
switch($_GET[act]){
  // Tampil siswa
  default:
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>HASIL PERHITUNGAN</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2></h2>
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
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th>No</th>
						  <th>Nama Siswa</th>
						  <th>Tahun Angkatan</th>
						  <th>Jurusan</th>
						  <th>Skor</th>
                        </tr>
                      </thead>
                      <tbody>";
					$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa,tabel_hasil,tabel_jurusan WHERE tabel_siswa.nomor_pendaftaran=tabel_hasil.nomor_pendaftaran
																						AND tabel_hasil.id_jurusan=tabel_jurusan.id_jurusan
																						ORDER BY tabel_hasil.nomor_pendaftaran DESC");
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nama_siswa]</td>
						  <td>$r[tahun_angkatan]</td>
						  <td>$r[nama_jurusan]</td>
						  <td>$r[skor]</td>
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
  $inisial = date('Ym');
  $sql=mysqli_query($konek,"select * from tabel_siswa order by nomor_pendaftaran DESC");
	$data=mysqli_fetch_array($sql);
	$kodeawal=$data[nomor_pendaftaran];
	$noUrut= $kodeawal+1;
    $kode =  sprintf("%03s", $noUrut);
    $nomorbaru = $kode.$nomor;
   $kriteria1=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='1'");
   $k1=mysqli_fetch_array($kriteria1);
   $kriteria2=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='2'");
   $k2=mysqli_fetch_array($kriteria2);
   $kriteria3=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='3'");
   $k3=mysqli_fetch_array($kriteria3);
   $kriteria4=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='4'");
   $k4=mysqli_fetch_array($kriteria4);
   $kriteria5=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='5'");
   $k5=mysqli_fetch_array($kriteria5);
   $kriteria6=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='6'");
   $k6=mysqli_fetch_array($kriteria6);
   $kriteria7=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='7'");
   $k7=mysqli_fetch_array($kriteria7);
   $kriteria8=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='8'");
   $k8=mysqli_fetch_array($kriteria8);
   $kriteria9=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='9'");
   $k9=mysqli_fetch_array($kriteria9);
   $kriteria10=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='10'");
   $k10=mysqli_fetch_array($kriteria10);
   $kriteria11=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='11'");
   $k11=mysqli_fetch_array($kriteria11);
   $kriteria12=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='12'");
   $k12=mysqli_fetch_array($kriteria12);
   $kriteria13=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='13'");
   $k13=mysqli_fetch_array($kriteria13);
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
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nomor_pendaftaran' value='$nomorbaru' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Nama Siswa</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nama_siswa' placeholder='Masukkan Nama Lengkap' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Tahun Angkatan</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='text' name='tahun_angkatan' placeholder='Masukkan Tahun Angakatan' required>
                        </div>
                      </div>
					  
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k3[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai3' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k4[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai4' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k5[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai5' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k6[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai6' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k10[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai10' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k11[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai11' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k7[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai7' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k8[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai8' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k9[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai9' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k12[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai12' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k13[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai13' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k1[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai1' step='0.01' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k2[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai2' step='0.01' placeholder='Masukkan Nilai' required>
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
  
  // Form Edit siswa  
  case "editsiswa":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_siswa WHERE nomor_pendaftaran='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	$kriteria1=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='1'");
   $k1=mysqli_fetch_array($kriteria1);
   $kriteria2=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='2'");
   $k2=mysqli_fetch_array($kriteria2);
   $kriteria3=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='3'");
   $k3=mysqli_fetch_array($kriteria3);
   $kriteria4=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='4'");
   $k4=mysqli_fetch_array($kriteria4);
   $kriteria5=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='5'");
   $k5=mysqli_fetch_array($kriteria5);
   $kriteria6=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='6'");
   $k6=mysqli_fetch_array($kriteria6); 
   $kriteria7=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='7'");
   $k7=mysqli_fetch_array($kriteria7);
   $kriteria8=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='8'");
   $k8=mysqli_fetch_array($kriteria8);
   $kriteria9=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='9'");
   $k9=mysqli_fetch_array($kriteria9);
   $kriteria10=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='10'");
   $k10=mysqli_fetch_array($kriteria10);
   $kriteria11=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='11'");
   $k11=mysqli_fetch_array($kriteria11);
   $kriteria12=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='12'");
   $k12=mysqli_fetch_array($kriteria12);
   $kriteria13=mysqli_query($konek,"SELECT * FROM tabel_kriteria WHERE id_kriteria='13'");
   $k13=mysqli_fetch_array($kriteria13);
	$data1=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='1'");
    $n1=mysqli_fetch_array($data1);
	$data2=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='2'");
    $n2=mysqli_fetch_array($data2);
	$data3=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='3'");
    $n3=mysqli_fetch_array($data3);
	$data4=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='4'");
    $n4=mysqli_fetch_array($data4);
	$data5=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='5'");
    $n5=mysqli_fetch_array($data5);
	$data6=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='6'");
    $n6=mysqli_fetch_array($data6);
	$data7=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='7'");
    $n7=mysqli_fetch_array($data7);
	$data8=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='8'");
    $n8=mysqli_fetch_array($data8);
	$data9=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='9'");
    $n9=mysqli_fetch_array($data9);
	$data10=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='10'");
    $n10=mysqli_fetch_array($data10);
	$data11=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='11'");
    $n11=mysqli_fetch_array($data11);
	$data12=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='12'");
    $n12=mysqli_fetch_array($data12);
	$data13=mysqli_query($konek,"SELECT * FROM tabel_detail WHERE nomor_pendaftaran='$_GET[id]' 
														   AND id_kriteria='13'");
    $n13=mysqli_fetch_array($data13);
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
                          <input class='form-control col-md-7 col-xs-12' type='text' name='nomor_pendaftaran' value='$r[nomor_pendaftaran]' readonly>
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
					  
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k3[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai3' step='0.01' value='$n3[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k4[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai4' step='0.01' value='$n4[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k5[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai5' step='0.01' value='$n5[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k6[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai6' step='0.01' value='$n6[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k10[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai10' step='0.01' value='$n10[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k11[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai11' step='0.01' value='$n11[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k7[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai7' step='0.01' value='$n7[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k8[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai8' step='0.01' value='$n8[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k9[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai9' step='0.01' value='$n9[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k12[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai12' step='0.01' value='$n12[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k13[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai13' step='0.01' value='$n13[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k1[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai1' step='0.01' value='$n1[nilai]' placeholder='Masukkan Nilai' required>
                        </div>
                      </div>
					  <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>$k2[nama_kriteria]</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input class='form-control col-md-7 col-xs-12' type='number' name='nilai2' step='0.01' value='$n2[nilai]' placeholder='Masukkan Nilai' required>
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
