<?php include "partial/head.php"; ?>
</head>
<body>
<?php
$tapel=isset($_GET['tapel']) ? $_GET['tapel'] : $tpl_aktif;
$smt=isset($_GET['smt']) ? $_GET['smt'] : $smt_aktif;
if($level==96){ //guru pai
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 1;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}elseif($level==95){ //guru penjas
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 8;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}elseif($level==94){ //guru bahasa inggris
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 10;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : '1A';
	$ab=substr($romb, 0, 1);
}else{
	$mpid = isset($_GET['mp']) ? $_GET['mp'] : 2;
	$romb = isset($_GET['kelas']) ? $_GET['kelas'] : $kelas;
	$ab=substr($romb, 0, 1);
};
$mpm=mysqli_fetch_array(mysqli_query($koneksi, "select * from mapel where id_mapel='$mpid'"));
?>
	<div class="wrapper overlay-sidebar">
		<?php include "partial/main-header.php"; ?>

		<!-- Sidebar -->
		<?php include "partial/sidebar.php"; ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Generate Sikap Sosial Kelas <?=$romb;?></h4>
					</div>
					
					<div class="card">
						<div class="card-body">
							<div id="mod-loader-raport" style="display: none; text-align: center;">
								<img src="ajaxloading.gif"><br/>Sedang Proses Generate Nilai Raport......
							</div>
							<div id="diagram" class="table-responsive">
								<table id="Raportku" class="display table">
									<thead>
									   <tr>
											<th width="25%">Nama</th>
											<th>Deskripsi</th>
											<th width="5%"></th>
										</tr>
									</thead>
									<tbody>	
																	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
			<?php include "partial/footer.php"; ?>
		</div>
		
		<div class="modal fade" id="mod-raport">
          <div class="modal-dialog">
            <div class="modal-content">
                        <div class="modal-body">
							<div id="mod-loader-raport" style="text-align: center;">
								<img src="ajaxloading.gif"><br/>Jangan Tutup Jendela Ini!! <br/>Sedang Proses Generate Nilai Raport......
							</div>
                        </div>
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		
		<div class="modal fade" id="editRaport">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Raport</h4>
              </div>
                        <form class="form-horizontal" action="modul/raport/updateSikap.php" autocomplete="off" method="POST" id="updateSikapForm">
							<div class="fetched-data"></div>
						</form>
						
			</div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
		<!-- Custom template | don't include it in your project! -->
		<!-- End Custom template -->
	</div>
	<?php include "partial/foot.php"; ?>
	<script type="text/javascript" language="javascript" class="init">
	var Raportku;
	$(document).ready(function() {
		Raportku = $("#Raportku").DataTable({
			"searching": false,
			"paging":false,
			"ajax": "modul/raport/RaportSosial.php?kelas=<?=$romb;?>&tapel=<?=$tapel;?>&smt=<?=$smt;?>",
			"order": []
		});
		$(document).on('click', '#getRaport', function(e){
		
			e.preventDefault();
			
			var ukelas = $(this).data('kelas');
			var utapel = $(this).data('tapel');			// it will get id of clicked row
			var usmt = $(this).data('smt');
			var updid = $(this).data('pdid');
			$('#mod-loader-raport').show();
			$('#diagram').hide();
			
			$.ajax({
				url: 'modul/raport/Generate-KI2.php',
				type: 'POST',
				data: 'kelas='+ukelas+'&tapel='+utapel+'&smt='+usmt+'&pdid='+updid,
				dataType: 'html'
			})
			.done(function(data){
				//console.log(data);	
				$('#mod-loader-raport').hide();
				$('#diagram').show();
				Raportku.ajax.reload(null, false);
				$.notify({
											icon: 'flaticon-alarm-1',
											title: 'Sukses',
											message: 'Generate Raport Sosial Berhasil!!',
										},{
											type: 'info',
											placement: {
											from: "bottom",
											align: "right"
										},
											time: 10,
										});			
			})
			.fail(function(){
				$('#mod-loader-raport').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#mod-loader-raport').show();
				$('#diagram').hide();
			});
			
		});
		//edit Raport
		$('#editRaport').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/raport/edit-sikap.php',
                data :  'rowid='+ rowid,
				beforeSend: function()
						{	
							$(".fetched-data").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 //Update Raport 
		 $("#updateSikapForm").unbind('submit').bind('submit', function() {
						// remove error messages
						$(".text-danger").remove();

						var form = $(this);

							$.ajax({
								url: form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
									if(response.success == true) {
										$.notify({
											icon: 'flaticon-alarm-1',
											title: 'Sukses',
											message: response.messages,
										},{
											type: 'info',
											placement: {
											from: "bottom",
											align: "right"
										},
											time: 10,
										});

										// reload the datatables
										Raportku.ajax.reload(null, false);
										// this function is built in function of datatables;

										// remove the error 
										$("#editRaport").modal('hide');
									} else {
										$.notify({
											icon: 'flaticon-alarm-1',
											title: 'Error',
											message: response.messages,
										},{
											type: 'info',
											placement: {
											from: "bottom",
											align: "right"
										},
											time: 10,
										});
									}
								} // /success
							}); // /ajax

						return false;
					});
	});
</script>
</body>
</html>