<?php
include('../../koneksi.php');
$tahun = $_SESSION['tahun_ajaran'];
?>  
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Generate Chart
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i> Home</a></li>        
        <li class="active">Generate Chart</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
              <form class="myForm" method="POST" action="generate_chart.php">
                <div class="col-xs-3">
                  <select name="jurusan" class="form-control jurusan" id="jurusan">
                    <option selected="selected">Jurusan</option>
                    <?php
                      $tampil = "SELECT id,nama from jurusan where jurusan.tahun_ajaran='$tahun'";
                      $ajaran = mysql_query($tampil);
                      while($data = mysql_fetch_array($ajaran)){
                        echo "<option value=\"$data[id]\">$data[nama]</option>";
                      }
                    ?>
                  </select>
                </div>
                    <div class="col-xs-3">
                        <input id="input_id_semester" 
                          style="display: none;" class="form-control" type="text" 
                          placeholder="loading..." readonly="true">

                        <select name="semester" class="form-control semester" id="semester">
                            <option selected="selected">Semester</option>
                        </select>
                    </div>  
                    
                    <div class="col-xs-3">
                        <input id="inid_pelajaran" 
                          style="display: none;" class="form-control" type="text" 
                          placeholder="loading..." readonly="true">

                        <select name="pelajaran" class="form-control pelajaran" id="pelajaran">
                            <option selected="selected">Pelajaran</option>
                        </select>
                    </div>  

                    <input id="idsubmit" name="submit" type="submit" value="submit" class="btn btn-primary" />
                    <br><input type="hidden" name="input_maksimal_baris" id="input_maksimal_baris" value="100" />
                                                    
              </form>
        </div>
        <div class="box-body">
            <div>
                <div id="isi"></div>
                <div id="pesankesan" class="callout callout-info" style="display: none;">
                    <h4><i class="icon fa fa-info"></i> Info</h4>
                    <p id="p_id01"></p>
                </div>     

                <div id="pesanwarning" class="callout callout-warning" style="display: none;">
                  <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                  <p id="p_id02"></p>
                </div>              

            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <style type="text/css">
                #divpagingaaaaaaaa {
                    display: none;
                }
            </style>
            <div id="divpaging" class="row" style="padding: 0px 20px 20px 20px; display: none;">
                <div class="col-md-12">
                    <div class="input-group" style="width: 50px; float: right;">
                        <span id="tombol_first_page" class="input-group-addon btn btn-default"><i class='fa fa-angle-double-left'></i></span>
                        <span id="tombol_previous_page" class="input-group-addon btn btn-default"><i class='fa fa-angle-left'></i></span>
                        
                        <span class="input-group-addon">Halaman </span>
                        <input id="input_id_input_halaman" value="1" style="width: 50px;" type="text"
                            class="form-control input-sm hanya-angka"
                         />
                        
                        <span id="" class="input-group-addon btn btn-default"> Dari</span>
                        <input id="maksimal_page" style="width: 50px;" class="form-control input-sm" type="text" disabled="true"  /> 
                        
                        <span id="tombol_next_page" class="input-group-addon btn btn-default"><i class='fa fa-angle-right'></i></span>
                        <span id="tombol_last_page" class="input-group-addon btn btn-default"><i class='fa fa-angle-double-right'></i></span>  
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-footer-->

        <div id="divid_overlay" class="overlay" style="display: none;">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
      <!-- /.box -->

      <!--modal-->
      <!-- Button trigger modal 
      <button style="display: none;" id="buttonid_modal"
          type="button" class="btn btn-primary btn-lg" 
          data-toggle="modal" data-target="#myModal">
          Launch demo modal
      </button>-->

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Sukses</h4>
            </div>
            <div class="modal-body">
                <p id="pid_isipesan"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
        </div>
      </div>
      <!---->

    </section>
    <!-- /.content -->
<script type="text/javascript">
  $(document).ready(function(){

    //==============================================================
    //   PAGING
    //==============================================================  
    var halaman_saat_ini=$("#input_id_input_halaman");
    var Maksimal_row=$("#input_maksimal_baris"); 
    var offsetnya=0;
    var halaman_maksimal=0;

    $("#input_id_input_halaman").keypress(
        function( event ) {
            if (event.which == 13) {
                
                
                if(halaman_saat_ini.val() < 1 || halaman_saat_ini.val()==""){
                    halaman_saat_ini.val(1); //alert("if 01");
                }

                if ( halaman_saat_ini.val() > halaman_maksimal ){
                    halaman_saat_ini.val( halaman_maksimal ); //alert( Maksimal_row.val() );
                }
/*
                // if ( halaman_saat_ini.val() < 1 ){ // || halaman_saat_ini.val()>Maksimal_row.val() ) {
                //     halaman_saat_ini.val("1");
                // } else if ( halaman_saat_ini.val() > Maksimal_row.val() ){
                //     halaman_saat_ini.val( Maksimal_row.val() );
                // }
*/               
                load_data(""); // $("#idsubmit").click();

            }
        }    
    );

    // PAGING , FIRST PAGE
    $("#tombol_first_page").click(
        function(){
            halaman_saat_ini.val(1);
            load_data("");
        }
    );

    // PAGING , PREVIOUS PAGE                
    $("#tombol_previous_page").click(
        function(){
            if(halaman_saat_ini.val() < 1 || halaman_saat_ini.val()==""){
                halaman_saat_ini.val(1);
            }
            
            dikurangi_satu=halaman_saat_ini.val();
                dikurangi_satu--;
            
            if(dikurangi_satu<1){ dikurangi_satu=1; }
            
            halaman_saat_ini.val(dikurangi_satu);
            if ( halaman_saat_ini.val() < 1 ){ halaman_saat_ini.val("1"); }

            load_data("");
        }
    );    

    // PAGING , NEXT PAGE   
    $("#tombol_next_page").click(
        function(){
            if(halaman_saat_ini.val()==0 || halaman_saat_ini.val()==""){
                halaman_saat_ini.val(1);
            }
            ditambahsatu=halaman_saat_ini.val();
                ditambahsatu++;
            
            if(ditambahsatu<1){ ditambahsatu=1; }
            halaman_saat_ini.val(ditambahsatu);

            if ( halaman_saat_ini.val() > halaman_maksimal ){
                halaman_saat_ini.val( halaman_maksimal );
            }
            
            load_data("");
        }
    );    

    // PAGING , LAST PAGE   
    $("#tombol_last_page").click(
        function(){
            halaman_saat_ini.val(halaman_maksimal);
            if(halaman_saat_ini.val()==0 || halaman_saat_ini.val()==""){
                halaman_saat_ini.val(1);
            }

            load_data("");
        }
    );
    //==============================================================
    //   END OF PAGING
    //==============================================================


    function tampilkan_pesan(tipe,pesannya){
        $("#isi").html("");
        reset_pesan();

        if (tipe=="info") {
            $("#p_id01").html(pesannya);
            $("#pesankesan").show();          
        }
        else if(tipe=="warning") {
            $("#p_id02").html(pesannya);
            $("#pesanwarning").show(); 
        }
    }

    function reset_pesan(){
        $("#pesankesan").hide();
        $("#pesanwarning").hide();
    }

    function tampilkan_modal(pesannya){
        $("#pid_isipesan").html(pesannya);
        $('#myModal').modal('show');
    }


    $(".jurusan").change(function(){
        var id=$(this).val();
        var dataString = 'id='+ id;   

        $(".semester").hide(); 
        $("#input_id_semester").show(); 

        $(".semester").html("<option selected=\"selected\">Semester</option>");
        $(".pelajaran").html("<option selected=\"selected\">Pelajaran</option>");

        $.ajax({
          type: "POST",
          url: "pages/generatechart/kelas.php",
          data: dataString,
          cache: false,
          success: function(html){            
              $(".semester").html(html);
              $(".semester").show(); 
              $("#input_id_semester").hide(); 
          },
          error: function(xhr){
            $(".semester").show(); 
            $("#input_id_semester").hide();
            alert("Gagal Ambil Data !");
          }

        });
        
    });

    $(".semester").change(function(){
      var id=$(this).val();
      var dataString = 'id='+ id;

        $(".pelajaran").hide(); 
        $("#inid_pelajaran").show(); 

      $.ajax({
        type: "POST",
        url: "pages/generatechart/pelajaran.php",
        data: dataString,
        cache: false,
        success: function(html){
            $(".pelajaran").html(html);
            $(".pelajaran").show(); 
            $("#inid_pelajaran").hide();
        } 
      });
    });

    $('.myForm').submit(function() {
        $('#divid_overlay').show();
        $("#isi").html("");
        
        $("#divpaging").hide(); 
        halaman_saat_ini.val("1");
        Maksimal_row.val("100"); //var Maksimal_row=$("#input_maksimal_baris").val();


        reset_pesan();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
              $('#divid_overlay').hide();

              if(data=="mapel_tidak_sesuai"){
                  tampilkan_pesan("warning","Mata Pelajaran Tidak Sesuai Jurusan.");
              } 
              else if(data=="pesan0001a"){
                  load_data("pesan0001a");
                  //tampilkan_pesan("info","Proses Simpan Nilai generate Berhasil.");
              }
              else if(data=="pesan0001b"){
                  load_data("pesan0001b");
                  //tampilkan_pesan("info","Proses Ubah Nilai Generate Berhasil.");
              }              
              else if(data=="pesan0002a"){
                  tampilkan_pesan("warning","Proses Simpan Nilai Generate Gagal !");
              }
              else if(data=="pesan0002b"){
                  tampilkan_pesan("warning","Proses Ubah Nilai Generate Gagal !");
              }
              else if(data=="pesan0003"){
                  tampilkan_pesan("warning","Tidak ada siswa yang mengambil Mata Pelajaran ini !");
              }
              else if(data=="pesan0004"){
                  tampilkan_pesan("info","Belum ada siswa terdaftar.");//
              }
              else if(data=="pesan0005"){
                  tampilkan_pesan("warning","Proses Ambil Data ... gagal !");//
              }
              else if(data=="pesan0006"){
                  tampilkan_pesan("warning","Harap pilih dengan benar !");//
              }
              else if(data=="pesan0007"){
                  tampilkan_pesan("warning","Proses Query Gagal !");//
              }
              else {
                  $("#isi").html(data);  
              }             
            },
            error: function(xhr){
                $('#divid_overlay').hide();
                tampilkan_pesan("warning","Proses Gagal. :: "+xhr);
            }
        });

        return false;
    });

    
    
    $("#input_maksimal_baris").click(
        function(){
            load_data("");
        }
    );

    function load_data(kodepesan){
        /*------------------------------------
          Load Data
        ------------------------------------*/  
        $('#divid_overlay').show();
        $("#isi").html("");
        reset_pesan();

        var pelajaran = $("#pelajaran").val();
        var jurusan = $("#jurusan").val();
        var semester = $("#semester").val();
        var tahun = "<?= $tahun; ?>";

        /*untuk paging*/
        //Maksimal_row=$("#input_maksimal_baris").val();

        //var Maksimal_row=$("#input_maksimal_baris").val();


        if(Maksimal_row.val()=="" || Maksimal_row.val()<1 || Maksimal_row.val()>500){
            Maksimal_row.val(100);
            //$("#input_maksimal_baris").val( Maksimal_row.val() );
        }
       /**/ offsetnya = ( (halaman_saat_ini.val()*Maksimal_row.val() )-Maksimal_row.val() );

        //alert( Maksimal_row.val() );
        //TentukanPageMaksimal_nya();

        /*tampilkan_pesan("info","jurusan = "+jurusan+", semester = "
            +semester+", pelajaran = "+pelajaran+", tahun = "+tahun);*/
        // alert("");

        var var_pesan = "";

        $.ajax({
            url: "pages/generatechart/loaddata.php",
            type: "post",
            data: {
                pelajaran: pelajaran
                ,jurusan: jurusan
                ,semester: semester
                ,tahun: tahun
                ,offsetnya: offsetnya
                ,maksimal_row: Maksimal_row.val()
                ,halaman_saat_ini: halaman_saat_ini.val()
            },
            success: function(data){
                switch(data) {
                    case "pesan1":
                        var_pesan = data;
                        break;
                    case "pesan2":
                        var_pesan = data; TentukanPageMaksimal_nya();
                        break;
                    default:
                        $("#isi").html(data); 
                        TentukanPageMaksimal_nya();
                        $("#divpaging").show();
                } 
            },
            error: function(xhr){
                $('#divid_overlay').hide();
                tampilkan_pesan("warning","Proses Gagal.");               
            }
        }).done(function(){
            $('#divid_overlay').hide();
            if (var_pesan=="pesan1"){
                tampilkan_pesan("warning","Proses Ambil Data ... gagal !");
            } else if (var_pesan=="pesan2") {
                tampilkan_pesan("info","Tidak Ada Data Untuk Halaman "+halaman_saat_ini.val() );

            }
            else {
                //tampilkan_modal("Proses Generate Berhasil.");
            }
        });
    }

    function TentukanPageMaksimal_nya(){
        var pelajaran = $("#pelajaran").val();
        var jurusan = $("#jurusan").val();
        var semester = $("#semester").val();
        var tahun = "<?= $tahun; ?>";

        $.ajax({
            url: "pages/generatechart/cari_jumlah.php",
            type: "post",
            data: {
                pelajaran: pelajaran
                ,jurusan: jurusan
                ,semester: semester
                ,tahun: tahun
            }, 
            success: function(data){
                // alert(data);
                halaman_maksimal = Math.ceil( data/Maksimal_row.val() ); 
                $("#maksimal_page").val(halaman_maksimal);

                /*if ( halaman_saat_ini.val() > halaman_maksimal ){
                    halaman_saat_ini.val( halaman_maksimal ); //alert( Maksimal_row.val() );
                }*/



            },
            error:function(xhr){
                alert("Gagal Tentukan Jumlah Page !","Pesan");
            }
        });
    }
  });
</script>