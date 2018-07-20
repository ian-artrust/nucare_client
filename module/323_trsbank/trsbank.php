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
    <script src="../bower_components/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="../bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../bower_components/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
    <script src="../bower_components/wnumb/wNumb.js" type="text/javascript"></script>

    <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/chosen/chosen.min.css"> -->

	<!-- Call Custom Library -->
	<script src="../module/323_trsbank/trsbank.js" type="text/javascript"></script>
</head>
<body>
	<br>
	<!-- Container datagrid dan form -->
	<div class="container-fluid">
		<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_bank">Bank</a></li>
			<li><a data-toggle="tab" href="#tab_validasi">Validasi Setoran KL</a></li>
        </ul>
		<div class="tab-content">
			<br>
			<div id="tab_bank" class="tab-pane fade in active">
				<div class="row container-fluid" style="padding:5px;">
					<div class="form-group">
						<table class="table">
							<tr>
								<td>
									<input type="text" class="form-control" size="15" id="no_rekening" name="no_rekening"
									placeholder="No Rekening" readonly="true" >
								</td>
								<td>
									<input type="text" size="50" class="form-control" id="nama_bank" name="nama_bank" 
									required placeholder="Nama Bank ...."  readonly="true">
								</td>
								<td>
									<input type="text" class="form-control" name="kode_akun" id="kode_akun"
									required placeholder="Kode Akun" readonly="true">
								</td>
								<td>
									<input type="text" class="form-control" name="saldo" id="saldo"
									required placeholder="Saldo..." readonly="true">
								</td>
								<td>
									<select class="form-control" style="width:150px;" 
									data-show-subtext="true" data-live-search="true" 
									name="periode" id="periode">
								</td>
								<td>
									<div class='input-group date' id="datetimepicker1">
										<input type='text' class="form-control" id="tgl_transaksi"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</td>
								<td>
									<button type="button" class="btn btn-warning" 
									data-toggle="modal" data-target="#rekeningModal">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</td>
							</tr>
							<tr>
								<td>
									<select class="form-control"
									data-show-subtext="true" data-live-search="true" 
									name="kode_transaksi" id="kode_transaksi">
										<option value="01">01</option>
										<option value="02">02</option>
									</select>
								</td>
								<td>
									<input type="text" class="form-control" 
									name="keterangan" id="keterangan"
									required placeholder="Keterangan..." >
								</td>
								<td>
									<input type="text" class="form-control" 
									name="jml_transaksi" id="jml_transaksi"
									required placeholder="Jumlah Transaksi..." >
								</td>
								<td>
									<input type="text" class="form-control" name="kode_akun_counter" id="kode_akun_counter"
									required placeholder="No Akun" readonly="true">
								</td>
								<td colspan="2">
									<input type="text" class="form-control" name="akun_counter" id="akun_counter"
									required placeholder="Akun Counter..." readonly="true">
								</td>
								<td>
									<button type="button" class="btn btn-info" 
									data-toggle="modal" data-target="#akunModal">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</td>
							</tr>
						</table>
					</div>					
									
					<button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Save</button>	
					<button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
					[ 01 : Setoran ] [ 02 : Penarikan ] Format: <label id="format_jml"></label>						
		
				</div>
				<div class="row clearfix">
					<div class="col-md-3">
						<input type="text" name="no_batal_bank" id="no_batal_bank" 
						class="form-control" placeholder="No Transaksi...">
						<button class="btn btn-danger" id="batal_bank">
							<span class="glyphicon glyphicon-remove-sign"></span>
							Batal Transaksi
						</button>
						<br>
						*Copy No Transaksi pada datagrid Paste Pada Textbox
					</div>
					<!-- Datagrid Place -->
					<div class="col-md-9 column">
						<table id="tabelbank" class="display" cellspacing="0">
							<thead>
								<tr>
									<th>No Transaksi</th>
									<th>Periode</th>
									<th>Tanggal</th>
									<th>Keterangan</th>
									<th>Debit</th>
									<th>Kredit</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody id="grid_transaksi"></tbody>
						</table>
					</div>
				</div> 
			</div>
			<div id="tab_validasi" class="tab-pane">
				<div class="row">
                    <div class="col-md-2">
                        <label>No Jurnal</label><br>
                        <input type="text" name="no_jurnal" id="no_jurnal" class="form-control" readonly="true">
                    </div>
                    <div class="col-md-4">
                    <br>
                        <button type="button" class="btn btn-info" id="reset_batal">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Reset
						</button>	
                        &nbsp;
                        <button class="btn btn-success" id="validasi">
                            <span class="glyphicon glyphicon-remove-sign"></span> Validasi
                        </button>
                    </div>
                </div>
				<div class="row">
					<table id="tabel_setoran" width="100%" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No Setoran</th>
								<th>Tgl Setoran</th>
								<th>Penyetor</th>
								<th>Jumlah</th>
								<th>Bank</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>  
				</div>
			</div>
		</div>	
	</div>	<!-- ./End Datagrid-->

	<!-- Modal Lookup Kantor -->
	<div class="modal fade" id="rekeningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Bank</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_bank" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>No Rekening</th>
	                            <th>Nama Bank</th>
								<th>Kode Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal Lookup Akun -->
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
	                            <th>Akun</th>
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