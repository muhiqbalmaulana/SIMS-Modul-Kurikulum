<?php
session_start ();
//session_destroy();

?>
<?php /*
include"koneksi.php"; 
require_once 'models/jurusan.php';

$listJurusan = Jurusan::getAllData(); 
if (isset ($_SESSION[jurusan])){
$end = end($listJurusan);
    $_SESSION[jurusan] = $end[id]; }
*/?>
<form>
  <div class="col-xs-3">
    <select class="form-control" name="cmbJurusan" id="cmbJurusan">
      <option>--Jurusan--</option>
      <?php /* require 'models/jurusan.php'; */ 
      
include ('koneksi.php');
$tahun = $_SESSION['tahun_ajaran'];
$tampil = "SELECT id,nama from jurusan where jurusan.tahun_ajaran='$tahun'";
$ajaran = mysql_query($tampil);
while($data = mysql_fetch_array($ajaran)){
    echo "<option value=$data[id]>$data[nama]</option>";
}
//$_SESSION[tahun_ajaran] = '3';//$_POST[id];   

?>
<?php  /*       
                if (is_array($listJurusan))
                foreach ($listJurusan as $item){
                    $selected = ($item[id] == $_SESSION[jurusan]) ? 'selected="selected"':'' ;
                    echo "<option value='$item[id]' $selected>$item[nama]</option>";
                }*/?>

    </select>
  </div>
  <div class="col-xs-3">
     <select class="form-control" name="cmbTingkat" id="cmbTingkat">
        <option>--Tingkat--</option>
        <option value="1" <?=(!$_SESSION['smt']) ? 'selected="1"' : '';?>>X</option>
        <option value="3" <?=(!$_SESSION['tkt']) ? 'selected="3"' : '';?>>XI</option>
        <option value="5" <?=(!$_SESSION['tkt']) ? 'selected="5"' : '';?>>XII</option>
      </select>
  </div>
  <div class="col-xs-3">
    <select class="form-control">
      <option>--Mapel--</option>
      <?php /* require 'models/jurusan.php'; */ 
      
include ('koneksi.php');
$pelajaran = $_SESSION['tkt'];
$tampil = "SELECT id,nama,semester FROM pelajaran WHERE pelajaran.semester='$pelajaran'";
$ajaran = mysql_query($tampil);
while($data = mysql_fetch_array($ajaran)){
    echo "<option value=$data[id]>$data[nama]</option>";
}
//$_SESSION[tahun_ajaran] = '3';//$_POST[id];   

?>
    </select>
  </div>
  <button type="button" class="btn btn-success">Submit</button>
  <?php
//echo $_SESSION['id'];echo"#"; echo $_SESSION['tkt'];
?>
</form>


<!--<script type="text/javascript">
    $().ready(function(){
      $("#cmbJurusan").change(function(){
          var jurusan = $(this).val();
                    $.post( 'setTahunSemester.php',
          'do=set_jrs&id='+jurusan,
                    function (data){            
                        window.location.reload();
                    }, 
                    'json')
                })
        $("#cmbTingkat").change(function(){
                    $.post( 'setTahunSemester.php', 
                    'do=set_tkt&tkt='+$(this).val(), 
                    function (data){
                        //window.location.reload();
                    }, 
                    'json')
                })      
    });
</script>-->