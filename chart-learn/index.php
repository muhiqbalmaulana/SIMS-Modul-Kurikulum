<?
	$konek = @mysql_connect('localhost','root','');
if (!$konek) die ('gagal mengkoneksikan ke database server');
$db = @mysql_select_db('chart-learn');
if (!$db) die('gagal konek ke database');
	
?>
<form method='post' action='proses.php'>
<fieldset style="width:300px;">
	<legend>Inputan</legend>
	<table>
		<tr><td>Produk</td>
			<td>
				<select name='produk'>
					<?	
						$q = mysql_query("select * from data");
						while($r = mysql_fetch_array($q)){
						echo "<option value=$r[id]>$r[produk]</option>";
						}
					?>
				</select>
			</td>
			</tr>
			<tr>
				<td>Jumlah terjual</td><td><input type='text' name='jml'></td>
			</tr>
			<tr>
				<td><input type='button' id='save' value='tampil Data'></td><td><input type='submit' value='Simpan'></td>
			</tr>
	</table>
</fieldset>
</form>
<style>
	#tampil{
		display:none;
	}
</style>
		<div class="box box-warning">
            <div class="box-header with-border">
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" id='close' value='Close'><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="tampil" style="height: 300px;"><?include('chart.php');?></div>
            </div>
            
          </div>


<script language='javascript'>
$(document).ready(function(){
	$("#save").click(function(){
		$("#tampil").fadeIn('slow');
	});
	
	$("#close").click(function(){
		$("#tampil").fadeOut('slow');
	});
	
});
</script>