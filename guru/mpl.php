<?php
include("../assets/db.php");
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$level=$_GET['level'];
echo "<option value='0'>Pilih Mapel</option>";
if($level==96){
	echo "<option value='1'>Pendidikan Agama Islam</option>";
};
if($level==95){
	echo "<option value='8'>Pend. Jasmani Olahraga dan Kesehatan</option>";
};
if($level==94){
	echo "<option value='10'>Bahasa Inggris</option>";
};
?>