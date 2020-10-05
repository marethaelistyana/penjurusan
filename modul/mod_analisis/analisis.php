
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_analisis/aksi_analisis.php";
switch($_GET[act]){
default:
echo"
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Form Perhitungan</h3>
              </div>
            </div>
            <div class='clearfix'></div>
            <div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Pilih Tahun Angkatan</h2>
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
                    <form id='form1' method=POST action='$aksi?module=analisis&act=proses' data-parsley-validate class='form-horizontal form-label-left'>
                      <div class='form-group'>
                        <label for='middle-name' class='control-label col-md-3 col-sm-3 col-xs-12'>Pilih Angkatan Tahun</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select class='form-control select21' name='tahun' style='padding:4px' required>
							<option value='' selected>- Pilih Tahun Angkatan -</option>";
								$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa GROUP BY tahun_angkatan ASC");
								while($r=mysqli_fetch_array($tampil)){
								echo "<option value=$r[tahun_angkatan]>$r[tahun_angkatan]";
								}
						echo "</select>
                        </div>
                      </div>
					  
                      <div class='ln_solid'></div>
                      <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                          <button type='submit' class='btn btn-success'>Lihat</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>";
break;
  // Tampil User
  case "tampiljurusan":
    echo "
	<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>PERHITUNGAN</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
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
                          <td><a href=?module=analisis&act=perhitungan&id=$r[id_jurusan]&tahun=$_GET[tahun] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i> Hitung</a> 
							</td>
                        </tr>";
						$no++;
						}
                        echo"
                      </tbody>
                    </table>
					<button onclick=self.history.back() class='btn btn-danger'>Kembali</button>	
                  </div>
                </div>
              </div>

            
            </div>
          </div>";
	
     break;
  // Tampil User
  case "perhitungan":
  $datasiswa=mysqli_query($konek,"SELECT * FROM tabel_siswa WHERE tahun_angkatan='$_GET[tahun]' ORDER BY nomor_pendaftaran ASC");
  while ($sis=mysqli_fetch_array($datasiswa)){
  $nomer=$sis[nomor_pendaftaran];
  mysqli_query($konek,"DELETE FROM tabel_hasil WHERE id_jurusan='$_GET[id]' AND nomor_pendaftaran='$nomer'");
  }
$edit=mysqli_query($konek,"SELECT * FROM tabel_jurusan WHERE id_jurusan='$_GET[id]'");
    $r=mysqli_fetch_array($edit); 
echo"
<div class=''>
            <div class='page-title'>
              <div class='title_left'>
                <h3>Analisis Perhitungan</h3>
              </div> 
            </div>
            <div class='clearfix'></div>
            <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                    <h2>Jurusan $r[nama_jurusan]</h2>
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
				  <div class='box-body table-responsive no-padding'>";
	$siswa = array(); //array("HP 1", "HP 2", "HP 3");
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa WHERE tahun_angkatan='$_GET[tahun]' ORDER BY nomor_pendaftaran");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$siswa[$i] = $datasiswa['nama_siswa'];
		$siswaid[$i] = $datasiswa['nomor_pendaftaran'];
		$i++;
	}
	
	$kriteria = array(); //array("Harga", "Kamera", "Memori", "Berat", "Keunikan");
	$tipe = array(); //array("cost", "benefit", "benefit", "cost", "benefit");
	$bobot = array(); //array(0.45, 0.25, 0.15, 0.1, 0.05);
	
	$querykriteria = mysqli_query($konek, "SELECT * FROM tabel_kriteria WHERE tabel_kriteria.id_jurusan='$_GET[id]' ORDER BY tabel_kriteria.id_kriteria");
	$i=0;
	while ($datakriteria = mysqli_fetch_array($querykriteria))
	{
		$kriteria[$i] = $datakriteria['nama_kriteria'];
		$tipe[$i] = $datakriteria['jenis'];
		$bobot[$i] = $datakriteria['bobot'];
		
		$i++;
	}
	
	$siswakriteria = array(array()); //array(
							// array(80, 70, 80, 70, 90),											
							// array(80, 80, 70, 70, 90),												                            
							// array(90, 70, 80, 70, 80)
						  // ); 
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa WHERE tahun_angkatan='$_GET[tahun]' ORDER BY nomor_pendaftaran");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$querykriteria = mysqli_query($konek, "SELECT * FROM tabel_kriteria WHERE tabel_kriteria.id_jurusan='$_GET[id]' ORDER BY tabel_kriteria.id_kriteria");
		$j=0;
		while ($datakriteria = mysqli_fetch_array($querykriteria))
		{
			$querysiswakriteria = mysqli_query($konek, "SELECT * FROM tabel_detail WHERE nomor_pendaftaran = '$datasiswa[nomor_pendaftaran]' AND id_kriteria = '$datakriteria[id_kriteria]'");
			$datasiswakriteria = mysqli_fetch_array($querysiswakriteria);
			
			$siswakriteria[$i][$j] = $datasiswakriteria['nilai'];
			$j++;
		}
		$i++;
	}
	
	$leaving_flow = array();
	$entering_flow = array();
	$net_flow = array();
	
	$siswa_rangking = array();
	$net_flow_rangking = array();
				
	echo "<h5>Matriks Nilai</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Kriteria</td>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Tipe</td>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Bobot</td>";
	echo "<td bgcolor=\"#FFFFFF\" colspan=\"".count($siswa)."\">Siswa</td>";
	echo "</tr>";
	echo "<tr>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
	}
	echo "</tr>";
	
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" >".$kriteria[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".$tipe[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".$bobot[$i]."</td>";
		for ($j=0;$j<count($siswa);$j++) {
			echo "<td bgcolor=\"#FFFFFF\" >".$siswakriteria[$j][$i]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	
	$normalisasi = array(array());
	
	echo "<br/>";
	echo "<h5>Matriks Normalisasi</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Kriteria</td>";
	echo "<td bgcolor=\"#FFFFFF\" colspan=\"".count($siswa)."\">Siswa</td>";
	echo "</tr>";
	echo "<tr>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
	}
	echo "</tr>";
	
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" >".$kriteria[$i]."</td>";
		
		$maksimal_per_kriteria = 0;
		$minimal_per_kriteria = 0;
		
		for ($j=0;$j<count($siswa);$j++) {
			if (($j==0) || ($maksimal_per_kriteria < $siswakriteria[$j][$i])) {
				$maksimal_per_kriteria = $siswakriteria[$j][$i];
			}
			if (($j==0) || ($minimal_per_kriteria > $siswakriteria[$j][$i])) {
				$minimal_per_kriteria = $siswakriteria[$j][$i];
			}
		}
		
		for ($j=0;$j<count($siswa);$j++) {
			$normalisasi[$j][$i] = 0;
			
			if ($tipe[$i] == "Cost") {
				if (($maksimal_per_kriteria-$minimal_per_kriteria) != 0) {
					$normalisasi[$j][$i] = ($maksimal_per_kriteria-$siswakriteria[$j][$i])/($maksimal_per_kriteria-$minimal_per_kriteria);
				}
			} else {
				if (($maksimal_per_kriteria-$minimal_per_kriteria) != 0) {
					$normalisasi[$j][$i] = ($siswakriteria[$j][$i]-$minimal_per_kriteria)/($maksimal_per_kriteria-$minimal_per_kriteria);
				}
			}
			echo "<td bgcolor=\"#FFFFFF\" >".$normalisasi[$j][$i]."</td>";
		}
			
		echo "</tr>";
	}
	
	echo "</table>";
	
	$matriks_wpj = array(array(array()));
	
	echo "<br/>";
	echo "<h5>Nilai Fungsi Preferensi (Pj)</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa 2</td>";
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<td bgcolor=\"#FFFFFF\">".$kriteria[$i]."</td>";
	}
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		for ($j=0;$j<count($siswa);$j++) {
			if ($i != $j) {
				echo "<tr>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$j]."</td>";
				for ($k=0;$k<count($kriteria);$k++) {
					if ($normalisasi[$i][$k] <= $normalisasi[$j][$k]) {
						$matriks_wpj[$i][$j][$k] = 0;
					} else {
						$matriks_wpj[$i][$j][$k] = $normalisasi[$i][$k] - $normalisasi[$j][$k];
					}
					echo "<td bgcolor=\"#FFFFFF\" >".$matriks_wpj[$i][$j][$k]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	
	$matriks_wp = array(array(array()));
	
	echo "<br/>";
	echo "<h5>Matriks WP (Weak Preference)</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 2</td>";
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<td bgcolor=\"#FFFFFF\">".$kriteria[$i]."</td>";
	}
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		for ($j=0;$j<count($siswa);$j++) {
			if ($i != $j) {
				echo "<tr>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$j]."</td>";
				for ($k=0;$k<count($kriteria);$k++) {
					$matriks_wp[$i][$j][$k] = ($matriks_wpj[$i][$j][$k] * $bobot[$k]) / 1;
					echo "<td bgcolor=\"#FFFFFF\" >".$matriks_wp[$i][$j][$k]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	
	$matriks_spj = array(array(array()));
	
	echo "<br/>";
	echo "<h5>Matriks Nilai SPj</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 2</td>";
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<td bgcolor=\"#FFFFFF\">".$kriteria[$i]."</td>";
	}
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		for ($j=0;$j<count($siswa);$j++) {
			if ($i != $j) {
				echo "<tr>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$j]."</td>";
				for ($k=0;$k<count($kriteria);$k++) {
					$matriks_spj[$i][$j][$k]=(max(0,($normalisasi[$i][$k] - $normalisasi[$j][$k]))-0)/1;
					echo "<td bgcolor=\"#FFFFFF\" >".$matriks_spj[$i][$j][$k]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	
	$matriks_sp = array(array(array()));
	
	echo "<br/>";
	echo "<h5>Matriks Nilai SP (Strict Preference)</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 2</td>";
	for ($i=0;$i<count($kriteria);$i++) {
		echo "<td bgcolor=\"#FFFFFF\">".$kriteria[$i]."</td>";
	}
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		for ($j=0;$j<count($siswa);$j++) {
			if ($i != $j) {
				echo "<tr>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$j]."</td>";
				for ($k=0;$k<count($kriteria);$k++) {
					$matriks_sp[$i][$j][$k] = ($matriks_spj[$i][$j][$k] * $bobot[$k]) / 1;
					echo "<td bgcolor=\"#FFFFFF\" >".$matriks_sp[$i][$j][$k]."</td>";
				}
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	
	$wp = array(array());
	$sp = array(array());
	$tp = array(array());
	
	echo "<br/>";
	echo "<h5>Nilai TP (Total Preference)</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa 2</td>";
	echo "<td bgcolor=\"#FFFFFF\" >SP</td>";
	echo "<td bgcolor=\"#FFFFFF\" >WP</td>";
	echo "<td bgcolor=\"#FFFFFF\" >TP</td>";
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		for ($j=0;$j<count($siswa);$j++) {
			if ($i != $j) {
				echo "<tr>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$j]."</td>";
				$wp[$i][$j]=0;
				$sp[$i][$j]=0;
				$tp[$i][$j]=0;
				for ($k=0;$k<count($kriteria);$k++) {
					$wp[$i][$j] = $wp[$i][$j]+$matriks_wp[$i][$j][$k];
					$sp[$i][$j] = $sp[$i][$j]+$matriks_sp[$i][$j][$k];
				}
				$tp[$i][$j] = min(1, $wp[$i][$j]+$sp[$i][$j]);
				echo "<td bgcolor=\"#FFFFFF\" >".$wp[$i][$j]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$sp[$i][$j]."</td>";
				echo "<td bgcolor=\"#FFFFFF\" >".$tp[$i][$j]."</td>";
				echo "</tr>";
			}
		}
	}
	echo "</table>";
	
	echo "<br/>";
	echo "<h5>Matriks Akhir</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa</td>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
		$leaving_flow[$i] = 0;
		$entering_flow[$i] = 0;
		$net_flow[$i] = 0;
	}
	echo "<td bgcolor=\"#FFFFFF\" >Jumlah</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Leaving</td>";
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
		for ($j=0;$j<count($siswa);$j++) {
			if ($i==$j) {
				echo "<td bgcolor=\"#FFFFFF\" >0</td>";
			} else {
				echo "<td bgcolor=\"#FFFFFF\" >".$tp[$i][$j]."</td>";
				$leaving_flow[$i] = $leaving_flow[$i] + $tp[$i][$j];
				$entering_flow[$j] = $entering_flow[$j] + $tp[$i][$j];
			}
		}
		echo "<td bgcolor=\"#FFFFFF\" >".$leaving_flow[$i]."</td>";
		$leaving_flow[$i] = $leaving_flow[$i] / (count($siswa) - 1);
		echo "<td bgcolor=\"#FFFFFF\" >".$leaving_flow[$i]."</td>";
		echo "</tr>";
	}
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Jumlah</td>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<td bgcolor=\"#FFFFFF\" >".$entering_flow[$i]."</td>";
	}
	echo "<td bgcolor=\"#FFFFFF\" >&nbsp;</td>";
	echo "<td bgcolor=\"#FFFFFF\" >&nbsp;</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Entering</td>";
	for ($i=0;$i<count($siswa);$i++) {
		$entering_flow[$i] = $entering_flow[$i] / (count($siswa) - 1);
		echo "<td bgcolor=\"#FFFFFF\" >".$entering_flow[$i]."</td>";
	}
	echo "<td bgcolor=\"#FFFFFF\" >&nbsp;</td>";
	echo "<td bgcolor=\"#FFFFFF\" >&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	
	echo "<br/>";	
	echo "<h5>Leaving Flow, Entering Flow dan Net Flow</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Leaving Flow</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Entering Flow</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Net Flow</td>";
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".$leaving_flow[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".$entering_flow[$i]."</td>";
		$net_flow[$i] = $leaving_flow[$i] - $entering_flow[$i];
		echo "<td bgcolor=\"#FFFFFF\" >".$net_flow[$i]."</td>";
		echo "</tr>";
		$tampil=mysqli_query($konek,"SELECT * FROM tabel_siswa WHERE nama_siswa='{$siswa[$i]}' AND tahun_angkatan='$_GET[tahun]'");
		while ($pp=mysqli_fetch_array($tampil)){
		$idsiswa=$pp[nomor_pendaftaran];
		mysqli_query($konek,"INSERT INTO tabel_hasil(nomor_pendaftaran,
                                               entering_flow,
											   leaving_flow,
											   net_flow,
											   id_jurusan) 
	                       VALUES('$idsiswa',
                                '{$entering_flow[$i]}',
								'{$leaving_flow[$i]}',
								'{$net_flow[$i]}',
                                '$_GET[id]')");
								}
	}
	
	echo "</table>";
	
	for ($i=0;$i<count($siswa);$i++) {
		$net_flow_rangking[$i] = $net_flow[$i];
		$siswa_rangking[$i] = $siswa[$i];
	}

	for ($i=0;$i<count($siswa);$i++) {
		for ($j=$i;$j<count($siswa);$j++) {
			if ($net_flow_rangking[$i] < $net_flow_rangking[$j]) {
				$tmp_net_flow = $net_flow_rangking[$i];
				$tmp_siswa = $siswa_rangking[$i];
				$net_flow_rangking[$i] = $net_flow_rangking[$j];
				$siswa_rangking[$i] = $siswa_rangking[$j];
				$net_flow_rangking[$j] = $tmp_net_flow;
				$siswa_rangking[$j] = $tmp_siswa;
			}
		}
	}
	echo "<br/>";
	echo "<h5>Hasil Ranking Akhir</h5>";
	echo "<table border='1' width='100%'>";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >Siswa</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Net Flow</td>";
	echo "<td bgcolor=\"#FFFFFF\" >Rangking</td>";
	echo "</tr>";
	for ($i=0;$i<count($siswa);$i++) {
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\" >".$siswa_rangking[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".$net_flow_rangking[$i]."</td>";
		echo "<td bgcolor=\"#FFFFFF\" >".($i+1)."</td>";
		echo "</tr>";
		}
	echo "</table>";

    ?>
</div>
<br />

<h4>Hasil Akhir Analisa Menggunakan SPK Extended Promethee (EXPROM)</h4>
<table border='1' width='100%'>
	<tr>
    	<td bgcolor="#FFFFFF">Ranking</td>
    	<td bgcolor="#FFFFFF">Siswa</td>
    	<td bgcolor="#FFFFFF">Nilai</td>
    </tr>
<?php
	for ($i=0;$i<count($net_flow_rangking);$i++)
	{	
?>
    <tr>
    	<td bgcolor="#FFFFFF"><?php echo ($i+1); ?></td>
    	<td bgcolor="#FFFFFF"><?php echo $siswa_rangking[$i]; ?></td>
    	<td bgcolor="#FFFFFF"><?php echo $net_flow_rangking[$i]; ?></td>
    </tr>
<?php
	}
?>
</table>

<?php
echo"<br>
<button onclick=self.history.back() class='btn btn-danger'>Kembali</button>	
 </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
break;
}
}
?>