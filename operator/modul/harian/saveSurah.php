<?php
include_once("../../../assets/db.php");
$idp=$_REQUEST['id'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$mpid=$_REQUEST['mp'];
$ab=$_REQUEST['kelas'];
$nilai=strtoupper($_REQUEST['value']);
if($nilai=='A' or $nilai=='B' or $nilai=='C' or $nilai=='D' or $nilai=='E'){
        $cek="select * from surah_pilihan where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND surah='$mpid'";
        $hasil=mysqli_query($koneksi,$cek);
        $ada = mysqli_num_rows($hasil);
        $utt=mysqli_fetch_array($hasil);
        if ($ada>0){
        	$idn=$utt['idNH'];
        	if(empty($nilai)){
        		$sql="DELETE FROM surah_pilihan WHERE idNH='$idn'";
        	}else{ 
        		$sql = "UPDATE surah_pilihan SET nilai='$nilai' WHERE idNH='$idn'";
        	};
        }else{
        	$sql = "INSERT INTO surah_pilihan VALUES('','$idp','$ab','$smt','$tapel','$mpid','$nilai')";
        };
        mysqli_query($koneksi, $sql) or die("database error:". mysqli_error($koneksi));
        echo "saved";
    
}else{
	echo "gagal";
};
?>