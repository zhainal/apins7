<?php
include("../../../assets/db.php");
$idr=$_POST['rowid'];
$cek="SELECT * FROM siswa WHERE id='$idr'";
$hasil=mysqli_query($koneksi,$cek);
$bio=mysqli_fetch_array($hasil);
$ids=$bio['peserta_didik_id'];
?>