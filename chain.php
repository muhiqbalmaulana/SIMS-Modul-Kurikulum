<script type="text/javascript">
$(document).ready(function()
{
 $(".jurusan").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;

  $.ajax
  ({
   type: "POST",
   url: "kelas.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
    $(".kelas").html(html);
   } 
  });

 });
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
 $(".kelas").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;

  $.ajax
  ({
   type: "POST",
   url: "pelajaran.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
    $(".pelajaran").html(html);
   } 
  });
 });
});
</script>
<!--<script type="text/javascript">
$(document).ready(function()
{
    $('.myForm').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('.result').html(data);
            }
        })
        
        return false;
    });
})
</script>-->
<div class="box box-primary">
    <div class="box-header with-border" >
        <form class="myForm" method="POST" action="">
        <div class="col-xs-3">
            <select name="jurusan" class="form-control jurusan" id="jurusan">
                <option selected="selected">Jurusan</option>
                <?php
                 include('koneksi.php');
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

        <input name="submit" type="submit" value="submit" class="btn btn-primary" />
        </form>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body chart-responsive">
         <div class="chart result" id="revenue-chart" style="height: 400px;"></div>
    </div>
            <!-- /.box-body -->
</div>

<?
 include('koneksi.php'); 
 if (isset($error)) {
  echo '<b>Error</b>: <br />'.implode('<br />', $error);
} else {
  /*
  
  */
  if (isset($_POST['submit'])){
  $data = $_POST['pelajaran'];

  $tampilmaxi=mysql_query("SELECT MAX(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $empat=mysql_result($tampilmaxi,0);

    $tampilmini=mysql_query("SELECT MIN(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $lima=mysql_result($tampilmini,0);

    $tampilavgi=mysql_query("SELECT AVG(UAS) FROM nilai_akhir WHERE kode_pelajaran='$data';");
    $enam=mysql_result($tampilavgi,0);
  }
  }
  ?>

  <script>
  $(function () {
    "use strict";

    // AREA CHART
    var bar = new Morris.Bar({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: 'Statistik Nilai Siswa', a:<?php echo $empat; ?> , b:<?php echo $lima; ?>, c:<?php echo $enam; ?>, d:75},
      ],
      barColors: ['#367fa9', '#f56954', '#e08e0b', '#00a65a'],
      xkey: 'y',
      ykeys: ['a', 'b','c','d'],
      labels: ['Nilai Tertinggi', 'Nilai Terendah','Rata-rata','KKM'],
      hideHover: 'auto'
    });
  });
  </script>