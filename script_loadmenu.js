$(document).ready(function(){
    window.onload = Loaddashboard();
    $("a#dashboard").click(function(){
        Loaddashboard();
    });
    $("a#user_guru").click(function(){
        user_guru();
    });
    $("a#guruNA").click(function(){
        guruNA();
    });
    $("a#statistik").click(function(){
        grafik();
    });
	$("a#guru").click(function(){
		guru();
    });
	$("a#rec_log").click(function(){
        rec_log();
    });
	$("a#rec_log_as").click(function(){
        rec_log_as();
    });
	$("a#generatechart").click(function(){
        generatechart();
    });
});

function loading(){
    $("#view").hide();
    $("#view").fadeIn("slow");
}
function Loaddashboard(){   
	$(".loader").fadeIn("slow");
    $("#view").load("dashboard.php",function() { 
	  $(".loader").fadeOut();
	});		
};

function Loadmenu1(){
    loading();
    $("#halamannya").load("pages/menu1/view/menu1.php");
};

function Loadmenu2(){
    loading();
    $("#halamannya").load("pages/menu2/view/menu2.php");
};
function user_guru(){
    $(".loader").fadeIn("slow");
    $("#view").load("pages/user_guru.php",function(){  
	$(".loader").fadeOut();
	});	
};

function grafik(){
    $(".loader").fadeIn("slow");
    $("#view").load("isi.php",function(){  
	$(".loader").fadeOut();
	});	
};
function guru(){	
	$(".loader").fadeIn("slow");	
    $("#view").load("pages/guru.php",function(){  
	$(".loader").fadeOut();
	});	
};

function guruNA(){	
	$(".loader").fadeIn("slow");	
    $("#view").load("pages/guruNA.php",function(){  
	$(".loader").fadeOut();
	});	
};

function rec_log(){
   $(".loader").fadeIn("slow");
    $("#view").load("pages/rec_log.php",function(){  
	$(".loader").fadeOut();
	});	
};

function rec_log_as(){
    $(".loader").fadeIn("slow");
    $("#view").load("pages/rec_log_as.php",function(){  
	$(".loader").fadeOut();
	});	
};

function generatechart(){
    $(".loader").fadeIn("slow");
    $("#view").load("pages/generatechart/generatechart.php",function(){  
	$(".loader").fadeOut();
	});	
};

function LoadSiswaJurusan(data){
    $(".loader").fadeIn("slow");
	var jurusan = data;	
	$("#view").load("pages/siswa_jurusan.php",{jur:jurusan},function() { 
	  $(".loader").fadeOut();
	});
};

function Rangkin(data){	
	$(".loader").fadeIn("slow");
	var rat = data;	
	$("#view").load("pages/rating_siswa.php",{rangkin_jur:rat},function() { 
	  $(".loader").fadeOut();
	});
};

function LoadSiswa(data){
	$(".loader").fadeIn("slow"); 
	var siswa = data;	
    $("#halamannya").load("pages/data_siswa.php",{nis:siswa},function() { 
	  $(".loader").fadeOut();
	});
};