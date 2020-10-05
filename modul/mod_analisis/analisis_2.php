
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000099">
  <tr>
    <td height="50" bgcolor="#FFFFFF"><span class="style1">SPK Metode Extended Promethee (EXPROM)</span></td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><span class="style2"><a href="index.php">Home</a> | <a href="extended-promethee-php-mysql.php">Analisa SPK Extended Promethee</a> | <a href="login.php">Login</a></span></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><br />
      <strong>Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode Extended Promethee (EXPROM)</strong><br />
      <br />
<div id="perhitungan" style="display:none;">
<?php 
	$siswa = array(); //array("HP 1", "HP 2", "HP 3");
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa ORDER BY nomor_pendaftaran");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$siswa[$i] = $datasiswa['nama_siswa'];
		$i++;
	}
	
	$kriteria = array(); //array("Harga", "Kamera", "Memori", "Berat", "Keunikan");
	$tipe = array(); //array("cost", "benefit", "benefit", "cost", "benefit");
	$bobot = array(); //array(0.45, 0.25, 0.15, 0.1, 0.05);
	
	$querykriteria = mysqli_query($konek, "SELECT * FROM tabel_kriteria,tabel_pembobotan WHERE tabel_kriteria.id_kriteria=tabel_pembobotan.id_kriteria AND tabel_pembobotan.id_jurusan='1' ORDER BY tabel_pembobotan.id_kriteria");
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
	
	$querysiswa = mysqli_query($konek, "SELECT * FROM tabel_siswa ORDER BY nomor_pendaftaran");
	$i=0;
	while ($datasiswa = mysqli_fetch_array($querysiswa))
	{
		$querykriteria = mysqli_query($konek, "SELECT * FROM tabel_kriteria,tabel_pembobotan WHERE tabel_kriteria.id_kriteria=tabel_pembobotan.id_kriteria AND tabel_pembobotan.id_jurusan='1' ORDER BY tabel_pembobotan.id_kriteria");
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Kriteria</td>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Tipe</td>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Bobot</td>";
	echo "<td bgcolor=\"#FFFFFF\" colspan=\"".count($siswa)."\">siswa</td>";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" rowspan=\"2\">Kriteria</td>";
	echo "<td bgcolor=\"#FFFFFF\" colspan=\"".count($siswa)."\">siswa</td>";
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
	echo "<h5>Matriks Preferensi WPj</h5>";
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
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
	echo "<h5>Matriks Nilai WP (Weak Preference)</h5>";
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 1</td>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa 2</td>";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa</td>";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa</td>";
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
	echo "<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#000099\">";
	echo "<tr>";
	echo "<td bgcolor=\"#FFFFFF\" >siswa</td>";
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
<input type="button" value="Perhitungan" onclick="document.getElementById('perhitungan').style.display='block';"/>
<br />
<br />
<h4>Hasil Akhir Analisa Menggunakan SPK Extended Promethee (EXPROM)</h4>
<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">
	<tr>
    	<td bgcolor="#FFFFFF">Ranking</td>
    	<td bgcolor="#FFFFFF">siswa</td>
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
<br />
<br />
siswa Produk Terbaik = <?php echo $siswa_rangking[0]; ?> dengan Nilai Terbesar = <?php echo $net_flow_rangking[0]; ?>
<br />
<br />
</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="47%" height="35" align="left"><strong>&copy; 2018 ContohProgram.com</strong></td>
        <td width="53%" height="35" align="right"><strong><a href="http://contohprogram.com" target="_blank">Kontak</a> | <a href="http://contohprogram.com/extended-promethee-php-mysql-source-code.php" target="_blank">About</a></strong></td>
      </tr>
    </table></td>
  </tr>
</table>