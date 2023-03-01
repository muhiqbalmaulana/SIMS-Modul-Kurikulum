<?php
include"koneksi.php"; 
if(isset($_SESSION['nip'])){
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>smkn1 | sgs</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style type="text/css">
  .hiddenRow {
    padding: 0 !important;
	}
  </style>
  <style type="text/css">
  .loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
}
</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  
  <script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
</head>
<div class="loader"></div>
<body class="hold-transition skin-blue sidebar-mini" onload="showcontent(main)">
<?php 
include"koneksi.php"; 
require_once 'models/tahun_ajaran.php';
$listTahun = TahunAjaran::getAllData(); 
if (!isset ($_SESSION['tahun_ajaran'])){
$end = end($listTahun);
    $_SESSION['tahun_ajaran'] = $end['id'];	
}
$_SESSION['smt']  = (isset($_SESSION['smt'])) ? $_SESSION['smt'] : '1';
?>

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>N</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Statistik</b> Nilai</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $_SESSION['nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                   <?= $_SESSION['nama'];?> - <?= ($_SESSION['kurikulum']!="") ? 'Waka Kurikulum' : $_SESSION['kapro'];?>
                  <small>smk negeri 1 singosari</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
				<div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php"  class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
		   <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
       <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
       <div class="pull-left info">
          <p><?= $_SESSION['nama']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Tahun Ajaran</li>
        <li>
            <div>     
                  <select class="form-control" name="cmbTahun" id="cmbTahun">
                    <?php         
                if (is_array($listTahun))
                foreach ($listTahun as $item){
                    $selected = ($item['id'] == $_SESSION['tahun_ajaran']) ? 'selected="selected"':'' ;
                    echo "<option value='$item[id]' $selected>$item[tahun]</option>";
                }?>
          
                  </select>
            </div>
        </li>    
        <li class="header">Semester</li>
        <li>
            <div>
                <select class="form-control" name="cmbSemester" id="cmbSemester">
                  <option value="1" <?=($_SESSION['smt']) ? 'selected="1"' : '';?>>  Ganjil   </option>
                  <option value="0" <?=(!$_SESSION['smt']) ? 'selected="1"' : '';?>>  Genap   </option>
                </select>
            </div>
        </li>   
		<li class="header">MAIN NAVIGATION</li>     
		<li class="active treeview">
          <a id="dashboard" style="cursor: pointer;">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>								
          </a>
        </li>
		<?php if($_SESSION['superad'] == 'y') {?>
        <li class="treeview">
          <a id="generatechart" style="cursor: pointer;"><!-- href="generate_chart/view.php -->
            <i class="fa fa-gears"></i> <span>Generate Chart</span>
          </a>
        </li>
        <li class="treeview">
          <a id="statistik" style="cursor: pointer;">
            <i class="fa fa-bar-chart"></i> <span>Statistik</span>
          </a>
        </li>
		 <li class="treeview">
          <a id="user_guru" style="cursor: pointer;">
            <i class="fa fa-users"></i> <span>List User</span>
          </a>
        </li>
		<li class="treeview">
          <a style="cursor: pointer;">
            <i class="fa fa-user"></i> <span>Record Log User</span>
			<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
		<ul class="treeview-menu">
            <li><a id="rec_log" style="cursor: pointer;"><i class="fa fa-user"></i> Log User</a></li>
            <li><a id="rec_log_as" style="cursor: pointer;"><i class="fa fa-users"></i> Log User As</a></li>           
        </ul>
        </li>
        <li class="treeview">
          <a id="guru" style="cursor: pointer;">
            <i class="fa fa-check-square-o"></i> <span>Progres Nilai</span>
         </a>
        </li>
		<li>
          <a href="#" style="cursor: pointer;"
            data-toggle="modal" 
			data-target="#jurusanModal">
			<i class="fa fa-book"></i> <span>DKN Jurusan</span>
          </a>
        </li>
		<li>
          <a href="#" style="cursor: pointer;"
            data-toggle="modal" 
			data-target="#ModalRangkin">
			<i class="fa fa-star-half-o"></i> <span>Rangkin</span>
          </a>
        </li>
		<?php }elseif($_SESSION['kapro']==='NAtif') { ?>
		<li class="treeview">
         <a id="guruNA" style="cursor: pointer;">
           <i class="fa fa-check-square-o"></i> <span>Progres N-A</span>
         </a>
        </li>
		<?php }else{ ?>
		<li>
          <a href="#" style="cursor: pointer;"
            data-toggle="modal" 
			data-target="#jurusanModal">
			<i class="fa fa-book"></i> <span>DKN Jurusan</span>
          </a>
        </li>
		<li>
          <a href="#" style="cursor: pointer;"
            data-toggle="modal" 
			data-target="#ModalRangkin">
			<i class="fa fa-star-half-o"></i> <span>Rangkin</span>
          </a>
        </li>	
		<?php 
		}
		?>
      </ul>
	  </section>
    <!-- /.sidebar -->
  </aside>
  <aside class="right-side" class="loader" >  
  <div id="view" ></div>
  </aside>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-2017 <a href="http://girisa.com">CV. Girisa Teknologi</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!----modal-->
		<div class="modal fade" id="jurusanModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nama Jurusan</h4>
              </div>
			  <form id="jurusan-submit">
              <div class="modal-body">
                <ul class="nav nav-list">
				<li class="nav-header">Name</li>
				<li>				
				<input id="jurusan" name="jurusan" class="typeahead form-control" style="margin:0px auto;width:300px;" type="text" placeholder="Pilih Jurusan">				
				</li>				
				</ul> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Next</button>
              </div>
			  </form>
            </div>
          </div>
     </div>
<!-- load menu -->
<!----modal_rangkin-->
		<div class="modal fade" id="ModalRangkin" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ketik Nama Jurusan</h4>
              </div>
			  <form id="jurusan-rangkin">
              <div class="modal-body">
                <ul class="nav nav-list">
				<li class="nav-header">Name</li>
				<li>				
				<input id="rating" name="rating" class="typeahead form-control" style="margin:0px auto;width:300px;" type="text" placeholder="Pilih Jurusan">				
				</li>				
				</ul> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Next</button>
              </div>
			  </form>
            </div>
          </div>
     </div>
<!-- load rangkin -->
<script src="script_loadmenu.js"></script>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="plugins/jQuery/jquery.chained.min.js"></script>
<!-- typeahead---> 
<script src="dist/js/bootstrap3-typeahead.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="lib/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->

<script type="text/javascript">
		$().ready(function(){
			$("#cmbTahun").change(function(){
					var tahun_ajaran = $(this).val();
                    $.post( 'setTahunSemester.php',
					'do=set&tahun='+tahun_ajaran,
                    function (data){						
                        window.location.reload();
                    }, 
                    'json')
            });
			
			$("#cmbSemester").change(function(){
                    $.post( 'setTahunSemester.php', 
                    'do=set_smt&smt='+$(this).val(), 
                    function (data){
                        window.location.reload();
                    }, 
                    'json')
            })			
		});
		
		$('input.typeahead').typeahead({
				source:  function (query, process) {
				return $.get('jurusan.php', { query: query }, function (data) {
						console.log(data);
						data = $.parseJSON(data);
						return process(data);
					});
				}
			});
			
		$(function(){
		$('#jurusan-submit').on('submit', function(e){
			e.preventDefault();					
			$.ajax({
				url: 'ajaxsubmite.php', //this is the submit URL
				type: 'POST', //or GET
				data: {
					'jurusan': $('#jurusan').val(),
				},//$('#jurusan-submit').serialize(),
					
				success: function(data){
					jurs = $.parseJSON(data);
					 $("#jurusanModal").modal('hide');
					 //$("#myDiv").show();
					 //$("#halamannya").html(data);
					 window.onload = LoadSiswaJurusan(jurs);
					 
				}
			});
		});
		});
		
		$(function(){
		$('#jurusan-rangkin').on('submit', function(e){
			e.preventDefault();					
			$.ajax({
				url: 'submite_jur.php', //this is the submit URL
				type: 'POST', //or GET
				data: {
					'Rangkin': $('#rating').val(),
				},//$('#jurusan-submit').serialize(),					
				success: function(data){
					ranking = $.parseJSON(data);
					 $("#ModalRangkin").modal('hide');					
					 window.onload = Rangkin(ranking);					 
				}
			});
		});
		});
</script>
<script type="test/javascript">

    function showcontent(x){

      if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
      }

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 1) {
            document.getElementById('content').innerHTML = "<img src='loading.gif' />";
        }
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById('content').innerHTML = xmlhttp.responseText;
        } 
      }

      xmlhttp.open('POST', x+'.html', true);
      xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
      xmlhttp.send(null);

    }
</script>
</body>
</html>
<?php
}else{ 
?>
	<script>
		window.location="login.php";
	</script>
<?php }?>
