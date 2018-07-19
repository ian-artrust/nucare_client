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
	<script src="../module/212_mustahik/mustahik.js" type="text/javascript"></script>
</head>
<body>
	<!-- Modal Lookup Provinsi -->
	<div class="modal fade" id="provModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Provinsi</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_provinsi" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Prov</th>
	                            <th>Provinsi</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

	<!-- Modal Lookup Kab Kota -->
	<div class="modal fade" id="kabkotaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Kab / Kota</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kabkota" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Kab</th>
	                            <th>Kabupaten / Kota</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

	<!-- Modal Lookup Kecamatan -->
	<div class="modal fade" id="kecModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Kab / Kota</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kec" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Kec</th>
	                            <th>Kecamatan</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

	<!-- Modal Lookup Desa -->
	<div class="modal fade" id="desaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Kab / Kota</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_desa" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Desa</th>
	                            <th>Desa</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>
	<br>
	<!-- Container datagrid dan form -->
	<div class="container-fluid">
		<div class="row clearfix">

			<!-- Form Place -->
			<div class="col-md-7 column">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_mustahik">Mustahik</a></li>
					<li><a data-toggle="tab" href="#tab_profile">Profile</a></li>
					<li><a data-toggle="tab" href="#tab_domisili">Domisili</a></li>
				</ul>

				<div class="tab-content">
					<br>
					<div id="tab_mustahik" class="tab-pane fade in active">
						<div class="row container">
							<div class="col-md-8">
								<table width="100%" border="0" cellspacing="2" cellpadding="2">
									<tr>
										<td>
											<label>No Registrasi</label><br>
											<input type="text" class="form-control" size="30" 
											name="no_registrasi" id="no_registrasi" readonly="true"
											placeholder="No Registrasi ...">
										</td>
										<td>&nbsp;</td>
										<td>
											<label>Nama</label><br>
											<input type="text" class="form-control" 
											size="55" name="nama_mustahik" id="nama_mustahik"
											placeholder="Nama Lengkap ...">
										</td>
										<td>&nbsp;</td>
										<td>
											<label>NIK</label><br>
											<input type="text" class="form-control" 
											size="30" name="nik" id="nik"
											placeholder="NIK ...">
										</td>
										<td>&nbsp;</td>
										<td>
											<label>No KK</label><br>
											<input type="text" class="form-control" 
											size="30" name="no_kk" id="no_kk"
											placeholder="No KK ...">
										</td>
									</tr>
									<tr>
									<tr>
										<td>
											<label>Tgl Lahir</label><br>
											<div class='input-group date' id="datetimepicker1">
												<input type='text' class="form-control" 
												name="tgl_lahir" id="tgl_lahir" size="40" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</td>
										<td>&nbsp;</td>
										<td>
											<label>Tmp Lahir</label><br>
											<input type="text" class="form-control" 
											size="55" name="tmp_lahir" id="tmp_lahir"
											placeholder="Tempat Lahir ...">
										</td>
										<td>&nbsp;</td>
										<td>
											<label>Agama</label><br>
											<select class="form-control" style="width:150px;" 
											name="agama" id="agama">
												<option value="Islam">Islam</option>
												<option value="Kristen">Kristen</option>
												<option value="Khatolik">Khatolik</option>
												<option value="Hindu">Hindu</option>
												<option value="Budha">Budha</option>
											</select>
										</td>
										<td>&nbsp;</td>
										<td>
											<label>No HP</label><br>
											<input type="text" class="form-control" 
											size="45" name="no_hp" id="no_hp"
											placeholder="No HP ...">
										</td>
									</tr>
									<tr>
										<td colspan="7">
											<label>Alamat</label><br>
											<input type="text" class="form-control" 
											name="alamat" id="alamat"
											placeholder="Alamat ...">
										</td>
									</tr>
								</table>
								<table>
									<tr>
										<td width="25%">
											<label>Kode Provinsi</label><br>
											<input type="text" class="form-control" 
											name="prov" id="prov" 
											placeholder="Kode Provinsi" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="70%">
											<label>Provinsi</label><br>
											<input type="text" class="form-control" 
											name="nama_prov" id="nama_prov" 
											placeholder="Provinsi" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="5%">
											<br>
											<button type="button" class="btn btn-info" 
											data-toggle="modal" data-target="#provModal">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</td>
									</tr>
									<tr>
										<td width="25%">
											<label>Kode Kab Kota</label><br>
											<input type="text" class="form-control" 
											name="kab_kota" id="kab_kota" 
											placeholder="Kode Kab / Kota" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="70%">
											<label>Kabupaten / Kota</label><br>
											<input type="text" class="form-control" 
											name="nama_kab_kota" id="nama_kab_kota" 
											placeholder="Kab / Kota" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="5%">
											<br>
											<button type="button" class="btn btn-info" 
												data-toggle="modal" data-target="#kabkotaModal"
												id="lk_kabkota">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</td>
									</tr>
									<tr>
										<td width="25%">
											<label>Kode Kec</label><br>
											<input type="text" class="form-control" 
											name="kec" id="kec" 
											placeholder="Kode Kecamatan" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="70%">
											<label>Kecamatan</label><br>
											<input type="text" class="form-control" 
											name="nama_kec" id="nama_kec" 
											placeholder="Kecamatan" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="5%">
											<br>
											<button type="button" class="btn btn-info" 
												data-toggle="modal" data-target="#kecModal"
												id="lk_kec">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</td>
									</tr>
									<tr>
										<td width="25%">
											<label>Kode Desa</label><br>
											<input type="text" class="form-control" 
											name="desa" id="desa" 
											placeholder="Kode Desa" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="70%">
											<label>Desa / Keluarahan</label><br>
											<input type="text" class="form-control" 
											name="nama_desa" id="nama_desa" 
											placeholder="Desa / Kelurahan" readonly="" />
										</td>
										<td>&nbsp;</td>
										<td width="5%">
											<br>
											<button type="button" class="btn btn-info" 
											data-toggle="modal" data-target="#desaModal"
											id="lk_desa">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</td>
									</tr>
								</table>
								<br>
								<button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Save</button>
								<button type="button" id="update" name="update" class="btn btn-sm btn-warning">Update</button>
								<button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>	
								<button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
							</div>
						</div>
					</div>
					<div id="tab_profile" class="tab-pane fade in active">
					</div>
					<div id="tab_domisili" class="tab-pane fade in active">
					</div>
				</div>
			</div>

			<!-- Datagrid Place -->
			<div class="col-md-5 column">
				<table id="tabelmustahik" class="display" cellspacing="0">
					<thead>
						<tr>
							<th>No Registrasi</th>
							<th>Nama</th>
							<th>NIK</th>
						</tr>
					</thead>
	                <tbody></tbody>
				</table>
			</div><!-- /. End Datagrid Place -->

		</div>
	</div>	<!-- ./End Container datagrid dan form -->

	<!-- Modal Lookup Kantor -->
	<div class="modal fade" id="kantorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Kantor Layanan</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kantor" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>No Kantor</th>
	                            <th>Kantor Layanan</th>
								<th>Pimpinan</th>
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