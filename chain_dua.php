<script type="text/javascript">

$(document).ready(function()
{
 $(".jurusana").change(function()
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
    $(".kelasa").html(html);
   } 
  });

 });
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
 $(".kelasa").change(function()
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
    $(".pelajarana").html(html);
   } 
  });
 });
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
    $('.myForm1').submit(function() {
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
                  element: charti,
                  data: json,
                  barColors: ['#367fa9','#f56954','#e08e0b','#00a65a'],
                  xkey: 'labeli',
                  ykeys: ['maxi','mini','avgi','kkmi'],
                  labels: ['Nilai Tertingi ','Nilai Terendah ','Rata-rata ','KKM '],
                  hideHover: 'auto',
                  resize: true
                });
            }
            
        });
        
        return false;
    });

});
</script>
<div class="box box-success">
    <div class="box-header with-border">
        <form class="myForm1" method="POST" action="proses_dua.php">
        <div class="col-xs-3">
            <select name="jurusan" class="form-control jurusana" id="jurusan">
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
            <select name="kelas" class="form-control kelasa" id="kelas">
                <option selected="selected">Semester</option>
            </select>
        </div>

        <div class="col-xs-3">
            <select name="pelajaran" class="form-control pelajarana" id="pelajaran">
                <option selected="selected">Pelajaran</option>
            </select>
        </div>

        <input name="submit" type="submit" value="submit" class="btn btn-success" />
        </form>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body chart-responsive"  >
         <div class="chart result" id="charti" style="height: 300px;"></div>
    </div>
            <!-- /.box-body -->
</div>
