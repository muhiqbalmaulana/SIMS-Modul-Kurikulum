<?php 
session_start();
if(isset($_SESSION['nip'])){ ?>
<script>
		window.location="index.php";
</script>	
<?php 
}
if(isset($_REQUEST['x'])){
		if($_REQUEST['x']=="login"){
	     require "config.php";
    //  require "models/global.php";
        // $konek = mysql_connect($_CONFIG['db']['host'],$_CONFIG['db']['user'],$_CONFIG['db']['pass']);
        // if (!$konek) die ('Conecction Failure');
        //     $db = mysql_select_db($_CONFIG['db']['db']);
        // if (!$db) die ('Database "<b>'.$config['db'].'</b>" not Found');

          $data_result=array();
                $user=$_POST['username'];
                $pass=$_POST['password'];
                 
                        $sql=sprintf("select guru.nip from guru where guru.nip ='%s' and guru.superad='y' order by guru.nip limit 1",
                        addslashes($user)
                        );  
                        $ckuser=mysql_fetch_assoc(mysql_query($sql));
                              
                        if($ckuser['nip']!=""){ //is guru superad
								//$pas=md5($pass.'*kunam*');
                                $pas=$pass;
                                $dataUser=mysql_fetch_assoc(mysql_query("select guru.nip,guru.superad,guru.nama from guru where guru.nip ='$user' and guru.password ='$pas' and guru.kurikulum='y' order by guru.nip limit 1"));
								
                                if($dataUser['nip']!=""){                                 
                                    $_SESSION['nip']=$dataUser['nip'];
                                    $_SESSION['superad']=$dataUser['superad'];  
									$_SESSION['nama'] = $dataUser['nama'];
									$_SESSION ['logged'] = true;
                                    $data_result="success";
                                    echo $data_result;
                                }else{
                                     $data_result=array(
                                    'action' => 'Gagal',
                                    'erno'=>'password',
                                    'msg'=>'Maaf, Password Yang Anda Masukan Salah.'
                                    );
                                     echo json_encode($data_result);

                                }
                          
                        }else{
							//cek what is nip kapro in tahun ajaran now
							$pas=md5($pass.'*kunam*');
							$dataUser=mysql_fetch_assoc(mysql_query("select guru.nip from guru where guru.nip ='$user' and guru.password ='$pas' order by guru.nip limit 1"));
							if($dataUser['nip']!=""){							
							require_once 'models/tahun_ajaran.php';
							$listTahun = TahunAjaran::getAllData(); 							
							$end = end($listTahun);
							$th_aktif = $end['id'];
							
							$sql_kapro=("SELECT jurusan.nama as kapro,jurusan.kapro_ganjil,jurusan.kapro_genap , guru.nama FROM jurusan ,guru
							where jurusan.tahun_ajaran='$th_aktif' and jurusan.kapro_ganjil ='$user' 
							and jurusan.kapro_genap ='$user' and guru.nip = '$user';");//, $th_aktif,
							//addslashes($user)
							//);  echo$sql_kapro;die();
							$user_kapro=mysql_fetch_assoc(mysql_query($sql_kapro));
								if($user_kapro['kapro_ganjil']!="" or $user_kapro['kapro_genap']!=""){
									//(isset($_SESSION['smt'])) ? $_SESSION['smt'] : '1';
									$_SESSION['nip']=($user_kapro['kapro_ganjil'] !="") ? $user_kapro['kapro_ganjil'] : ($user_kapro['kapro_genap'] !="") ? $user_kapro['kapro_genap'] : '';
                                    $_SESSION['kapro']=$user_kapro['kapro'];
									$_SESSION['nama'] = $user_kapro['nama'];
									$_SESSION ['logged'] = true;
                                    $data_result="success";
                                    echo $data_result;
									 
								 }else{ 
								$sql_kapro_na=("SELECT kaprog_na.* FROM kaprog_na where kaprog_na.nip = '$user';");
								$user_kapro_na = mysql_fetch_assoc(mysql_query($sql_kapro_na));	
									 if($user_kapro_na['nip'] !=''){
										$_SESSION['nip']= $user_kapro_na['nip'];
										$_SESSION['kapro']='NAtif';
										$_SESSION['nama'] = $user_kapro_na['nama'];
										$_SESSION ['logged'] = true;
										$data_result="success";
                                        echo $data_result; 
									 }else{
									$data_result=array(
									'action' => 'Gagal',
									'erno'=>'username',
									'msg'=>'Maaf, Username Yang Anda Masukan Salah masuk ke kapro NA.' );
                                    echo json_encode($data_result);
									 }
								}
							}else{
								$data_result=array(
								'action' => 'Gagal',
								'erno'=>'username',
								'msg'=>'Maaf, Username Yang Anda Masukan Salah.' );
                                echo json_encode($data_result);								
							}
						
						} 
                
                
                die();
             
    }else{}
}else{
 ?>



<html >
    <head>
        <meta charset="UTF-8">
        <title>Login SMS Support</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- DATA TABLES -->
        <link href="assets/plugins/flexigrid/flexigrid.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/flexigrid/validasi.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css" />



    <!-- Pace 1.0.0 --
    <script src="js/plugins/pace/pace.js" type="text/javascript"></script-->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>

    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/flexigrid/flexigrid.js" type="text/javascript"></script>
        <script src="assets/plugins/flexigrid/jquery.tooltipster.js" type="text/javascript"></script>
        <script src="assets/plugins/flexigrid/jquery.validate.min.js" type="text/javascript"></script> 
        
        <script src="assets/plugins/fileuploader/fileuploader.js" type="text/javascript"></script> 
    <script src="assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>


    <style type="text/css">
body{

background: #00568B;
  background: -webkit-gradient(radial, center center, 0, center center, 660, from(#00C0EF), to(#00568B));
}
    .input-login {
        padding: 7px 10px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.89);
        border: solid 1px #00C0EF;  

        color: #00C0EF;
    }
form {
    margin: 0;
    padding: 0;
}
    label { color: #00C0EF;
    }
    .body.bg-gray {
        background: rgba(255, 255, 255, 0.26) !important;
        border-bottom: solid 1px rgba(255, 255, 255, 0.8);
    }

        .form-box {
            width: 90%;
            max-width: 800px;
            margin-top: 60px;
border: solid 1px #eee;
        }

        .ttl {
            border-bottom: solid 2px #00C0EF;
            color: #00C0EF;
        }

        .header.bg-aqua {
            background: #fff !important;
            box-shadow: none !important;
            text-align: left;
            padding: 15px 20px;
        }

        .body.bg-gray {
            background: #fff !important;
        }

.ttl span {
    border-bottom: solid 2px #00C0EF;
    display: inline-block;
}
.footer{
     background: rgba(255, 255, 255, 0.54);
}.copy {
text-align: center;
margin-top: 15px;
color: #000;
}

@media (max-width: 767px){
.form-box{
    margin-top: 20px;
}


}
</style>
    </head>
    <body class="bg-blsack">

        <div class="form-box" id="login-box" >
            <div class="header bg-aqua" >
                <div class="ttl">
                    <span><i class="fa fa-user"> </i> </span>
                </div>
            </div>
            <div class="ctn">
            <div style="font-size: 24px;
    border-bottom: solid 2px #00C0EF;
    line-height:28px;
    display: block;
    text-align: center;
    padding: 5px;
    color: #00C0EF;
    margin-bottom: 20px;
    text-shadow: 1px 1px 1px #FFFFFF;">
                <span class="">Welcome To Kurikulum Support <br/><b>SIMS</b></span>
            </div>

                   <div class="body bg-gray">

<!-- contrent -->

              
                        <div class="tlb">  
                            <div class="form-group"><label for="">Username </label>
                                <input type="text" name="username" class="form-controlx input-login" id="username" placeholder="username"/>
                            </div>
                            <div class="form-group"><label for="">Password </label>
                                <input type="password" name="password" class="form-controlx input-login"  id="password" placeholder="Password"/>
                            </div> 
                        </div>
                    </div>
                    <div class="footer" >
                        <button type="button " id="submit-login" class="btn btn-lg bg-aqua btn-block"> <span class="fa fa-lock"></span> Login </button>

 
 <!-- <a href="?act=guru&do=forgot">Lupa Password ?</a><br/> -->
  
    <!--                     <p><a href="#">I forgot my password</a></p>

                        <a href="register.html" class="text-center">Register a new membership</a>
                    --> 
                    <?php //if($notif_socmed!=""){ 
                        ?>
            <!--div class="alert alert-danger alert-dismissable erno " style="margin:5px 0px;"> 

                                            <b>Gagal !</b> <span class="erno-text"><?php// echo $notif_socmed; ?></span>
                                        </div-->
                    <?php //}else{
                        ?>
                                <div class="alert alert-danger alert-dismissable erno " style="margin:5px 0px;display:none;"> 

                                            <b>Gagal !</b> <span class="erno-text">username & Password Salah.</span>
                                        </div>
                    
                        <?php

                   // } ?>

           
<script>
    $(document).ready(function(){
        

        var doLogin=function(){
            var tmptombol=$('#submit-login').html();
                $('#submit-login').html('<span class="fa fa-spinner fa-spin"></span> Login...');
                //alert($('.input-login').serialize());
                // $.ajax({
                //     url:'?x=login',
                //     type:'post',
                //     dataType:'json',
                //     data:$('.input-login').serialize(),
                //     success:function(data){		
                //         alert("coba");
                            			
                //         if(data.action=="success"){
                //             window.location='index.php';
                //             $('#submit-login').html('<span class="fa fa-unlock"></span> Success...');
                //          $(".erno").slideUp(400);       
                //         }
                //         else{
                //             $('#submit-login').html(tmptombol);
                //               $(".erno").slideUp();
                //                $(".erno-text").html(data.msg);
                //                $(".erno").slideDown(400);

                //         }
                        
                //     }
                // });
                $.post('?x=login',
                    {username:$("#username").val(),password:$("#password").val()},
                    function(data){
                        //alert(data);
                        if(data=="success"){
                            location.reload(true); 
                        }
                        else{
                            $('#submit-login').html(tmptombol);
                              $(".erno").slideUp();
                               $(".erno-text").html(data.msg);
                               $(".erno").slideDown(400);
                              
                        }

                    }   
                );
                //alert("sukses");

        }
        $('.input-login').keypress(function(e){
            if(e.keyCode==13){
                doLogin();
            }
        });
        $('#submit-login').click(function(){
            doLogin();

        });

    });
</script>
<style type="text/css">
.form-box {
max-width: 400px;
    margin: 100px auto;
    background: #fff;
position: relative;
    border-radius:2px;
}
.form-controlx{
    width: 100%;
}
   .ctn {
    margin: 50px 20px 50px 20px;
}

.header.bg-aqua {
    position: absolute;
    border-radius: 100px;
    border: solid 1px #E9E9E9;
    top: -50px;
    width: 100px;
    height: 100px;
    left: 38%;
}
.ttl {
    text-align: center;
}

i.fa.fa-user {
    font-size: 50px;
}
</style> 
<!-- edn contetn -->
          			</div>         
        <div class="copy"><b>&copy; 2017 Girisa Teknologi </b></div>
            </div>
        </div>
    </body>
</html>
<?php } ?>