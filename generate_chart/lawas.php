<?php
include "../body_up/body_up.php";
?>

<?php /**/ ?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
					<!-- AREA CHART -->
					<div class="box box-primary" style="min-height: 500px;">
						<div class="box-header with-border">
							<form class="myForm" method="POST" action="proses.php">
								<div class="col-xs-3">
									<select name="jurusan" class="form-control jurusan" id="jurusan">
										<option selected="selected">Jurusan</option>
										<?php
											$tahun = $_SESSION['tahun_ajaran'];
											$tampil = "SELECT id,nama from jurusan where jurusan.tahun_ajaran='$tahun'";
											$ajaran = mysql_query($tampil);
											while($data = mysql_fetch_array($ajaran)){
												echo "<option value=$data[nama]>$data[nama]</option>";
											}
										?>
									</select>
								</div>

						        <div class="col-xs-3">
						            <select name="kelas" class="form-control kelas" id="kelas">
						                <option selected="selected">Semester</option>
						            </select>
						        </div>	
						        
						        <div class="col-xs-3">
						            <select name="pelajaran" class="form-control pelajaran" id="pelajaran">
						                <option selected="selected">Pelajaran</option>
						            </select>
						        </div>						        							

							</form>


						</div>
					</div>


					<!-- =================== -->
					</div>


				</div>
			</section>
		</div>
    </section>  
  </div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	$(document).ready(function(){
		$(".jurusan").change(function(){
			var id=$(this).val();
			var dataString = 'id='+ id;		

			$.ajax({
				type: "POST",
				url: "../kelas.php",
				data: dataString,
				cache: false,
				success: function(html){
					$(".kelas").html(html);
				} 
			});
				
		});

		$(".kelas").change(function(){
			var id=$(this).val();
			var dataString = 'id='+ id;

			$.ajax({
				type: "POST",
				url: "../pelajaran.php",
				data: dataString,
				cache: false,
				success: function(html){
					$(".pelajaran").html(html);
				} 
			});
		});

		$('.myForm').submit(function() {
			$.ajax({
	            type: 'POST',
	            url: $(this).attr('action'),
				data: $(this).serialize(),
	            dataType: 'json',
	            success: function (data) {
	                //$('.result').html(data)
	                json = data,
	                //alert(json),
	                Morris.Bar({
	                  element: charts,
	                  data: json,
	                  barColors: ['#367fa9','#f56954','#e08e0b','#00a65a'],
	                  xkey: 'label',
	                  ykeys: ['max','min','avg','kkm'],
	                  labels: ['Nilai Tertingi ','Nilai Terendah ','Rata-rata ','KKM '],
	                  hideHover: 'auto',
	                  resize: true
	                });
	            }


			});
		});
	});

</script>


<?php
include "../body_down/body_down.php";
?>