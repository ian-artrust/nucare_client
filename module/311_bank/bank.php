<?php
session_start();
  if($_SESSION['status']!='LOGIN'){
    header("location:../index.php");
  } else {
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- Custom CSS -->
	<style type="text/css">
		.form-control{
			padding-bottom: auto;
			margin-bottom: 5px;
		}

		fieldset 
			{
				border: 1px solid #ddd !important;
				margin: 0;
				xmin-width: 0;
				padding: 10px;       
				position: relative;
				border-radius:4px;
				background-color:#f5f5f5;
				padding-left:10px!important;
			}	
			
		legend
			{
				font-size:14px;
				font-weight:bold;
				margin-bottom: 0px; 
				width: 35%; 
				border: 1px solid #ddd;
				border-radius: 4px; 
				padding: 5px 5px 5px 10px; 
				background-color: #ffffff;
			}
	</style>
	<!-- Call JQuery Library -->
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>

    <!-- Call DataTables Library -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

     <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

	<!-- Call Custom Library -->
	<script src="../module/311_bank/bank.js" type="text/javascript"></script>
</head>
<body>
	<br>
	<!-- Container datagrid dan form -->
	<div class="container-fluid">
		<div class="row clearfix">

			<!-- Form Place -->
			<div class="col-md-5 column">
			<fieldset>
				<legend>DATA BANK</legend>
			    <!-- Form CRUD Book Master -->
				<!-- <form class="form" id="frmanggota" action="" method="post"> -->
					<div class="form-group">
						<label>No Rekening</label>
						<div class="row">
							<div class="col-md-9">
								<input type="text" class="col-md-2 form-control" id="no_rekening"
								placeholder="No Rekening" >
							</div>
							<div class="col-md-3">
								<select class="form-control" name="status" id="status">
				                <option value="Aktif">Aktif</option>
				                <option value="Tidak Aktif">Tidak Aktif</option>
				            	</select>
							</div>
						</div>					

						<label>Nama Bank</label>
						<input type="text" class="form-control" id="nama_bank" name="nama_bank" 
						required placeholder="Nama Bank ....">

						<label>Akun</label>
		                <div class="row">
		                    <div class="col-md-4">
		                        <input type="text" class="form-control" name="kode_akun" id="kode_akun" placeholder="Kode Akun" readonly="true"/>		                    </div>
		                    <div class="col-md-6">
		                        <input type="text" class="form-control" name="akun" id="akun" placeholder="Nama Akun" readonly="true" />
		                    </div>
		                    <div class="col-md-1">
		                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#akunModal">
		                        	<span class="glyphicon glyphicon-search"></span>
		                        </button>
		                    </div>
		                </div>					
					</div>
					<br>				
					<button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Save</button>
					<button type="button" id="update" name="update" class="btn btn-sm btn-warning">Update</button>
					<button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>	
					<button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>					
				<!-- </form>/. End Form CRUD Book Master -->
			</fieldset>		
			</div><!-- /. End Form Place -->

			<!-- Datagrid Place -->
			<div class="col-md-7 column">
				<table id="tabelbank" class="display" cellspacing="0">
					<thead>
						<tr>
							<th>No Rekening</th>
							<th>Nama Bank</th>
							<th>Akun</th>
						</tr>
					</thead>
	                <tbody></tbody>
				</table>
			</div><!-- /. End Datagrid Place -->

		</div>
	</div>	<!-- ./End Container datagrid dan form -->

	<!-- Modal Lookup Kantor -->
	<div class="modal fade" id="akunModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Akun</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Akun</th>
	                            <th>Nama Akun</th>
								<th>Kategori</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>
<?php } ?>