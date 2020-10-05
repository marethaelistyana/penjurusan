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
				  <form action='' method='GET'>
                    <input type='hidden' name='module' value='hasil'>
                    <label for='exampleInputPassword1'>Lihat Berdasarkan Tahun Angkatan </label>";
					if ($_GET[tahun] == ''){
					echo"
					<select name='tahun' style='padding:4px'>
							<option value='' selected>- Semua Tahun Angkatan -</option>";
								$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa GROUP BY tahun_angkatan ASC");
								while($r=mysqli_fetch_array($tampil)){
								echo "<option value=$r[tahun_angkatan]>$r[tahun_angkatan]";
								}
						echo "</select>";
					}
					if ($_GET[tahun] != ''){
					echo"
					<select name='tahun' style='padding:4px'>";
								$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa GROUP BY tahun_angkatan ASC");
								if ($r[tahun_angkatan]==''){
								echo "<option value=''>- Semua Tahun Angkatan -</option>";
								}   

							while($w=mysqli_fetch_array($tampil)){
								if ($_GET[tahun]==$w[tahun_angkatan]){
								echo "<option value=$w[tahun_angkatan] selected>$w[tahun_angkatan]</option>";
								}
								else{
								echo "<option value=$w[tahun_angkatan]>$w[tahun_angkatan]</option>";
								}
								}
						echo "</select>";
					}
	if ($_GET[tahun] == ''){
				
	$siswa = array(); //array("HP 1", "HP 2", "HP 3");
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa ORDER BY nomor_pendaftaran ASC");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$nomorpendaftaran[$i] = $datasiswa['nomor_pendaftaran'];
		$siswa[$i] = $datasiswa['nama_siswa'];
		$namatahun[$i] = $datasiswa['tahun_angkatan'];
		$siswaid[$i] = $datasiswa['nomor_pendaftaran'];
		$i++;
	}				
	$jurusan = array(); //array("HP 1", "HP 2", "HP 3");
	
	$queryjurusan = mysqli_query($konek, "SELECT * FROM tabel_jurusan ORDER BY id_jurusan ASC");
	$i=0;
	while ($datajurusan = mysqli_fetch_array($queryjurusan))
	{
		$jurusan[$i] = $datajurusan['nama_jurusan'];
		$jurusanid[$i] = $datajurusan['id_jurusan'];
		$i++;
	}
	$siswakriteria = array(array()); 
	
	$queryjurusan = mysqli_query($konek, "SELECT * FROM tabel_jurusan ORDER BY id_jurusan ASC");
	$i=0;
	while ($datajurusan = mysqli_fetch_array($queryjurusan))
	{
		$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa ORDER BY nomor_pendaftaran ASC");
		$j=0;
		while ($datasiswa = mysqli_fetch_array($querysiswa))
		{
			$queryjurusansiswa = mysqli_query($konek, "SELECT * FROM tabel_hasil WHERE nomor_pendaftaran = '$datasiswa[nomor_pendaftaran]' AND id_jurusan = '$datajurusan[id_jurusan]'");
			$datajurusansiswa = mysqli_fetch_array($queryjurusansiswa);
			
			$jurusansiswa[$i][$j] = $datajurusansiswa['net_flow'];
			$j++;
		}
		$i++;
	}
	}
	
	
	if ($_GET[tahun] != ''){
				
	$siswa = array(); //array("HP 1", "HP 2", "HP 3");
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa WHERE tahun_angkatan='$_GET[tahun]' ORDER BY nomor_pendaftaran ASC");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$nomorpendaftaran[$i] = $datasiswa['nomor_pendaftaran'];
		$siswa[$i] = $datasiswa['nama_siswa'];
		$namatahun[$i] = $datasiswa['tahun_angkatan'];
		$siswaid[$i] = $datasiswa['nomor_pendaftaran'];
		$i++;
	}				
	$jurusan = array(); //array("HP 1", "HP 2", "HP 3");
	
	$queryjurusan = mysqli_query($konek, "SELECT * FROM tabel_jurusan ORDER BY id_jurusan ASC");
	$i=0;
	while ($datajurusan = mysqli_fetch_array($queryjurusan))
	{
		$jurusan[$i] = $datajurusan['nama_jurusan'];
		$jurusanid[$i] = $datajurusan['id_jurusan'];
		$i++;
	}
	$siswakriteria = array(array()); 
	
	$queryjurusan = mysqli_query($konek, "SELECT * FROM tabel_jurusan ORDER BY id_jurusan ASC");
	$i=0;
	while ($datajurusan = mysqli_fetch_array($queryjurusan))
	{
		$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa WHERE tahun_angkatan='$_GET[tahun]' ORDER BY nomor_pendaftaran ASC");
		$j=0;
		while ($datasiswa = mysqli_fetch_array($querysiswa))
		{
			$queryjurusansiswa = mysqli_query($konek, "SELECT * FROM tabel_hasil WHERE nomor_pendaftaran = '$datasiswa[nomor_pendaftaran]' AND id_jurusan = '$datajurusan[id_jurusan]'");
			$datajurusansiswa = mysqli_fetch_array($queryjurusansiswa);
			
			$jurusansiswa[$i][$j] = $datajurusansiswa['net_flow'];
			$j++;
		}
		$i++;
	}
	}
	
					echo"
					<input type='submit' style='margin-top:-4px' class='btn btn-info btn-sm' value='Lihat'>
             </form>
                    <table id='datatable-keytable' class='table table-striped table-bordered'>
                      <thead>
                        <tr>
                          <th rowspan=2>No</th>
                          <th rowspan=2>No Pendaftaran</th>
						  <th rowspan=2>Nama Siswa</th>
						  <th rowspan=2>Tahun Angkatan</th>
						  <th colspan=".count($jurusan).">Net Flow</th>
                        </tr>";
						echo "<tr>";
	for ($i=0;$i<count($jurusan);$i++) {
		echo "<th bgcolor=\"#FFFFFF\" >".$jurusan[$i]."</th>";
	}
	echo "</tr>
                      </thead>
                      <tbody>";
					
					
					$no=1;
					for ($i=0;$i<count($siswa);$i++) {
						echo "
                        <tr>
						   <td>$no</td>";
						   echo "<td bgcolor=\"#FFFFFF\" >".$nomorpendaftaran[$i]."</td>";
						 echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";	
						 echo"
						  <td>".$namatahun[$i]."</td>";
						  for ($j=0;$j<count($jurusan);$j++) {
						echo "<td bgcolor=\"#FFFFFF\" >".$jurusansiswa[$j][$i]."</td>";
							}
						echo"
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
		  
		  echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>HASIL PENJURUSAN</h3>
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
                          <th>No Pendaftaran</th>
						  <th>Nama Siswa</th>
						  <th>Tahun Angkatan</th>
						  <th>Jurusan</th>
						  <th>Skor</th>
                        </tr>
                      </thead>
                      <tbody>";
					  if ($_GET[tahun] == ''){
					  $tampil=mysqli_query($konek,"SELECT MAX(tabel_hasil.net_flow) AS nilai, tabel_hasil.id_jurusan, tabel_siswa.nomor_pendaftaran,tabel_siswa.nama_siswa,tabel_siswa.tahun_angkatan,tabel_jurusan.nama_jurusan
																						FROM tabel_siswa,tabel_hasil,tabel_jurusan 
																						WHERE tabel_siswa.nomor_pendaftaran=tabel_hasil.nomor_pendaftaran	
																						GROUP BY tabel_hasil.nomor_pendaftaran
																						ORDER BY tabel_hasil.nomor_pendaftaran ASC");
					  }																
					if ($_GET[tahun] != ''){
					$tampil=mysqli_query($konek,"SELECT MAX(tabel_hasil.net_flow) AS nilai, tabel_hasil.id_jurusan, tabel_siswa.nomor_pendaftaran,tabel_siswa.nama_siswa,tabel_siswa.tahun_angkatan,tabel_jurusan.nama_jurusan
																						FROM tabel_siswa,tabel_hasil,tabel_jurusan 
																						WHERE tabel_siswa.nomor_pendaftaran=tabel_hasil.nomor_pendaftaran	
																						AND tabel_siswa.tahun_angkatan='$_GET[tahun]'
																						GROUP BY tabel_hasil.nomor_pendaftaran
																						ORDER BY tabel_hasil.nomor_pendaftaran ASC");
					}
					$no=1;
					while ($r=mysqli_fetch_array($tampil)){
					$n = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM tabel_hasil,tabel_jurusan where tabel_hasil.id_jurusan=tabel_jurusan.id_jurusan
																					AND tabel_hasil.net_flow='$r[nilai]'"));
						echo "
                        <tr>
                          <td>$no</td>
                          <td>$r[nomor_pendaftaran]</td>
                          <td>$r[nama_siswa]</td>
						  <td>$r[tahun_angkatan]</td>
						  <td>$n[nama_jurusan]</td>
						  <td>$r[nilai]</td>
                        </tr>";
						$no++;
						}
                        echo"
                      </tbody>
                    </table>
                  </div>
				  <a href=modul/mod_hasil/cetakhasil.php?tahun=$_GET[tahun] target='_blank' class='btn btn-primary pull-right'><i class='fa fa-print'></i> Cetak</a><br>
                </div>
              </div>

            
            </div>
          </div>";
	
     break;
   
}
?>
