  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.7
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>


<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../plugins/jQuery/jquery.chained.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
	$().ready(function(){
        $("#cmbTahun").change(function(){
			var tahun_ajaran = $(this).val();
            $.post( '../setTahunSemester.php',
			'do=set&tahun='+tahun_ajaran,
            function (data){						
                window.location.reload();
            }, 
            'json')
        });

		$("#cmbSemester").change(function(){

            $.post('../setTahunSemester.php',
                'do=set_smt&smt='+$(this).val(),
                function(data){
                    window.location.reload();
                },
                'json'
            );

        });		

        
	});
</script>

</body>
</html>