<?php
include("../assets/db.php");
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
echo "<option value='0'>Pilih Mapel</option>";
$sql2 = "select * from mapel";$qu3 = mysqli_query($koneksi,$sql2) or die("database error:". mysqli_error($koneksi));while($po=mysqli_fetch_array($qu3)){	$idmp=$po['id_mapel'];	if($ab<4 and ($idmp==5 or $idmp==6)){									}else{			if($ab>3 and $idmp==8){												}else{?><option value="<?=$po['id_mapel'];?>"><?=$po['nama_mapel'];?></option><?php};};};?>