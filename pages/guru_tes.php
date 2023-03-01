 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simple Tables
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content"> 
     
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
					<tr>
					  <th>ID</th>
					  <th>User</th>
					  <th>Date</th>
					  <th>Status</th>
					  <th>Reason</th>
					</tr>
				</thead>
                <tbody>
                <tr>
                  <td rowspan="3">183</td>
                  <td rowspan="3">John Doe</td>
                  <td rowspan="3">11-7-2014			  
					  <tr>
					  <td ><span class="label label-success">Approved</span></td>					  
					  <td >tkj1</td>
					 </tr>
					 <tr>
					   <td ><span class="label label-success">Approved</span></td>
					  <td >tkj2</td>
					  </tr>
				</td>	  	
					 
                </tr>
				  <tr>
                  <td rowspan="3">183</td>
                  <td rowspan="3">John Doe</td>
                  <td rowspan="3">11-7-2014			  
					  <tr>
					  <td ><span class="label label-success">Approved</span></td>					  
					  <td >tkj1</td>
					 </tr>
					 <tr>
					   <td ><span class="label label-success">Approved</span></td>
					  <td >tkj2</td>
					  </tr>
				</td>	  	
					 
                </tr>
				  <tr>
                  <td>183</td>
                  <td >John Doe</td>
                  <td >11-7-2014</td>				  
					 
					  <td ><span class="label label-success">Approved</span></td>					  
					  <td >tkj1</td>					
				 </tr>	
				  <tr>
                  <td rowspan="3">183</td>
                  <td rowspan="3">John Doe</td>
                  <td rowspan="3">11-7-2014			  
					  <tr>
					  <td ><span class="label label-success">Approved</span></td>					  
					  <td >tkj1</td>
					 </tr>
					 <tr>
					   <td ><span class="label label-success">Approved</span></td>
					  <td >tkj2</td>
					  </tr>
				</td>	  	
					 
                </tr>
				  	
					 
               
				
				</tbody>
                <tfoot>
				<tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                </tr>
				 </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>       
    </section>
    <!-- /.content -->
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script>
  $(function () {
    $("#example2").DataTable();
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>