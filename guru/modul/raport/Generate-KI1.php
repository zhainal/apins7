<?php 
require_once '../../../assets/db.php';
$kelas=$_REQUEST['kelas'];
$tapel=$_REQUEST['tapel'];
$smt=$_REQUEST['smt'];
$idp=$_REQUEST['pdid'];
$ab=substr($kelas, 0, 1);
$nm=mysqli_fetch_array(mysqli_query($koneksi, "select * from siswa where peserta_didik_id='$idp'"));
$SB12=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='1' and nilai='SB'"));
$PB12=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='1' and nilai='PB'"));
$SB22=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='2' and nilai='SB'"));
$PB22=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='2' and nilai='PB'"));
$SB32=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='3' and nilai='SB'"));
$PB32=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='3' and nilai='PB'"));
$SB42=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='4' and nilai='SB'"));
$PB42=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM nsp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='4' and nilai='PB'"));
if($SB12==$PB12){
									$pred1=2;
								}elseif($SB12<$PB12){
									$pred1=1;
								}else{
									$pred1=3;
								};
								if($SB22==$PB22){
									$pred2=2;
								}elseif($SB22<$PB22){
									$pred2=1;
								}else{
									$pred2=3;
								};
								if($SB32==$PB32){
									$pred3=2;
								}elseif($SB32<$PB32){
									$pred3=1;
								}else{
									$pred3=3;
								};
								if($SB42==$PB42){
									$pred4=2;
								}elseif($SB42<$PB42){
									$pred4=1;
								}else{
									$pred4=3;
								};
								
								//input nilai spirit temp
								$nspi1=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='1'"));
								$nspi2=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='2'"));
								$nspi3=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='3'"));
								$nspi4=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='4'"));
								if($nspi1>0){
									$cek1=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='1'"));									if($cek1>0){									$idnh=mysqli_fetch_array(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='1'"));
									$idn=$idnh['id_nh'];									mysqli_query($koneksi, "update nsp_temp set nph='$pred1' where id_nh='$idn'");									}else{										$idn=0;									};
									
								}else{
									mysqli_query($koneksi, "insert into nsp_temp values('','$idp','$kelas','$smt','$tapel','1','$pred1')");
								};
								if($nspi2>0){
									$cek2=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='2'"));									if($cek2>0){									$idnh=mysqli_fetch_array(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='2'"));
									$idn=$idnh['id_nh'];
									mysqli_query($koneksi, "update nsp_temp set nph='$pred2' where id_nh='$idn'");									};
								}else{
									mysqli_query($koneksi, "insert into nsp_temp values('','$idp','$kelas','$smt','$tapel','2','$pred2')");
								};
								if($nspi3>0){
									$cek3=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='3'"));									if($cek3>0){									$idnh=mysqli_fetch_array(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='3'"));
									$idn=$idnh['id_nh'];
									mysqli_query($koneksi, "update nsp_temp set nph='$pred3' where id_nh='$idn'");									}
								}else{
									mysqli_query($koneksi, "insert into nsp_temp values('','$idp','$kelas','$smt','$tapel','3','$pred3')");
								};
								if($nspi4>0){
									$cek4=mysqli_num_rows(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='4'"));									if($cek4>0){									$idnh=mysqli_fetch_array(mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and jns='4'"));
									$idn=$idnh['id_nh'];
									mysqli_query($koneksi, "update nsp_temp set nph='$pred4' where id_nh='$idn'");									}
								}else{
									mysqli_query($koneksi, "insert into nsp_temp values('','$idp','$kelas','$smt','$tapel','4','$pred4')");
								};
								$vy1="";$dk1="";$dk="";
								$vy2="";$dk2="";
								$vy3="";$dk3="";
								$vy4="";$dk4="";
								$vy5="";$dk5="";
								$vy6="";$dk6="";$nu=array();
								//Logika Berpikir disini.......
								$nsi=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel'");
								$ru=mysqli_num_rows($nsi);
								$nsi1=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='3'");
								$ru1=mysqli_num_rows($nsi1);
								$nsi2=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='2'");
								$ru2=mysqli_num_rows($nsi2);
								$nsi3=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='1'");
								$ru3=mysqli_num_rows($nsi3);
								if($ru1>0){
									$ni1=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='3'");
									if($ru1==1){
										$et=mysqli_fetch_array($ni1);
										$tk=$et['jns'];
										$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
										$vy1=$vy1.$fh['komp'];
									}elseif($ru1==2){
										
										$s=0;
										while($et=mysqli_fetch_array($ni1)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy1=$nu[1]." dan ".$nu[2];
									}elseif($ru1==3){
										
										$s=0;
										while($et=mysqli_fetch_array($ni1)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy1=$nu[1].", ".$nu[2]." dan ".$nu[3];
									}else{
										
										$s=0;
										while($et=mysqli_fetch_array($ni1)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy1=$nu[1].", ".$nu[2].", ".$nu[3]." dan ".$nu[4];
									};
									$dk1="Sangat Baik dalam ".$vy1;
								};
								
								if($ru2>0){
									$ni2=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='2'");
									if($ru2==1){
										$et=mysqli_fetch_array($ni2);
										$tk=$et['jns'];
										$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
										$vy2=$vy2.$fh['komp'];
									}elseif($ru2==2){
										
										$s=0;
										while($et=mysqli_fetch_array($ni2)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy2=$nu[1]." dan ".$nu[2];
									}elseif($ru2==3){
										
										$s=0;
										while($et=mysqli_fetch_array($ni2)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy2=$nu[1].", ".$nu[2]." dan ".$nu[3];
									}else{
										
										$p=0;
										while($et=mysqli_fetch_array($ni2)){
											$p++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$p]=$fh['komp'];
										};
										$vy2=$nu[1].", ".$nu[2].", ".$nu[3]." dan ".$nu[4];
									};
									$dk2="Baik dalam ".$vy2;
								};
								
								if($ru3>0){
									$ni3=mysqli_query($koneksi, "select * from nsp_temp WHERE id_pd='$idp' and smt='$smt' and tapel='$tapel' and nph='1'");
									if($ru3==1){
										$et=mysqli_fetch_array($ni3);
										$tk=$et['jns'];
										$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
										$vy3=$vy3.$fh['komp'];
									}elseif($ru3==2){
										
										$s=0;
										while($et=mysqli_fetch_array($ni3)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy3=$nu[1]." dan ".$nu[2];
									}elseif($ru3==3){
										
										$s=0;
										while($et=mysqli_fetch_array($ni3)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy3=$nu[1].", ".$nu[2]." dan ".$nu[3];
									}else{
										
										$s=0;
										while($et=mysqli_fetch_array($ni3)){
											$s++;
											$tk=$et['jns'];
											$fh=mysqli_fetch_array(mysqli_query($koneksi, "select * from kd_spirit where ids='$tk'"));
											$nu[$s]=$fh['komp'];
										};
										$vy3=$nu[1].", ".$nu[2].", ".$nu[3]." dan ".$nu[4];
									};
									$dk3="Dengan Bimbingan serta Pendampingan yang lebih akan mampu meningkatkan ".$vy3;
								};
								
								if($ru==0){
									$dk="Alhamdulillah, Ananda ".$nm['nama']." Baik dalam Ketaatan Beribadah, Berdoa sebelum dan sesudah melakukan kegiatan, Sikap Toleransi dalam beribadah, dan Berprilaku Syukur.";
								}else{
									$dk="Alhamdulillah, Ananda ".$nm['nama']." ".$dk1." ".$dk2." ".$dk3;
								};
								$desk=mysqli_real_escape_string($koneksi,$dk);
								$ada=mysqli_num_rows(mysqli_query($koneksi, "select * from deskripsi_k13 where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' and jns='k1'"));
								$srapor=mysqli_fetch_array(mysqli_query($koneksi, "select * from deskripsi_k13 where id_pd='$idp' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' and jns='k1'"));
		if($ada>0){
			$idn=$srapor['id_raport'];
			mysqli_query($koneksi, "UPDATE deskripsi_k13 SET deskripsi='$desk' WHERE id_raport='$idn'");
		}else{
			mysqli_query($koneksi, "INSERT INTO deskripsi_k13 VALUES('','$idp','$ab','$smt','$tapel','k1','$desk')");
		};			mysqli_query($koneksi, "DELETE FROM nsp_temp WHERE id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel'");
?>