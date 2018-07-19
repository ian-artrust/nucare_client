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
	<script src="../module/224_pengajuan/pengajuan.js" type="text/javascript"></script>

    <style>
        input, select {
            padding: 3px;
        }
        #npwz, #muzaki, #zisr, #total_donasi{
            background-color:#e1f4f7;
        }
    </style>

    <!-- Modal Lookup Muzaki -->
	<div class="modal fade" id="mustahikModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Mustahik</h4>
	            </div>
	            <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_individu">Individu</a></li>
                        <li><a data-toggle="tab" href="#tab_entitas">Entitas</a></li>
                    </ul>
                    <div class="tab-content">
                    <br>
                        <div id="tab_individu" class="tab-pane fade in active">
                            <table id="lookup_mustahik" width="100%" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No Mustahik</th>
                                        <th>Nama Mustahik</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                        <div id="tab_entitas" class="tab-pane fade">
                            <table id="lookup_entitas" width="100%" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No Registrasi</th>
                                        <th>Nama Lembaga</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                    </div>
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Disposisi -->
	<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Disposisi</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_disposisi" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>No Disposisi</th>
	                            <th>Pengirim</th>
                                <th>Perihal</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

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
</head>
<body>
   <br>
	<div class="container-fluid">
        <fieldset>
			<legend>PENGAJUAN PENTASHARUFAN</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Kode Mustahik</label><br>
                                    <input type="text" class="form-control" size="20" 
                                    name="no_registrasi" id="no_registrasi"  readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Mustahik</label><br>
                                    <input type="text" class="form-control" size="40" 
                                    name="nama_mustahik" id="nama_mustahik" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#mustahikModal">
		                        	    <span class="glyphicon glyphicon-search"></span>
		                            </button>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Pengajuan </label><br>
                                    <select class="form-control" style="width:350px;" 
                                    name="no_master" id="no_master">
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Periode</label><br>
                                    <select class="form-control" style="width:120px;" 
                                    data-show-subtext="true" data-live-search="true" 
                                    name="periode" id="periode">
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Tgl Pengajuan</label><br>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' class="form-control" 
                                        id="tgl_pengajuan" size="20" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Jumlah: </label><label id="format_jml"></label><br>
                                    <input type="text" class="form-control" 
                                    name="jml_pengajuan" id="jml_pengajuan" size="25">
                                </td>
                            </tr>
                        </table>
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Keterangan </label><br>
                                    <input type="text" class="form-control" 
                                    name="keterangan" id="keterangan" size="100">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Disposisi</label><br>
                                    <input type="text" class="form-control" size="25" 
                                    name="no_disposisi" id="no_disposisi"  readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Perihal</label><br>
                                    <input type="text" class="form-control" size="45" 
                                    name="perihal" id="perihal" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#disposisiModal">
		                        	    <span class="glyphicon glyphicon-search"></span>
		                            </button>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <input type="text" name="no_kantor" id="no_kantor" 
                        style="background-color:#dee2e2;" size="15"
                        placeholder="Nomor" readonly="true"/>
                        &nbsp;
                        <input type="text" name="nama_kantor" id="nama_kantor" 
                        style="background-color:#dee2e2;" size="25"
                        placeholder="Kantor Layanan" readonly="true" />
                        &nbsp;
                        <button type="button" class="btn btn-info" 
                        data-toggle="modal" data-target="#kantorModal">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        &nbsp;
                        <button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Save</button>	
                        <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
                        &nbsp;&nbsp;&nbsp;
                        <input type="text"
                        name="no_pengajuan" id="no_pengajuan" style="background-color:#dee2e2;"
                        placeholder="No Pengajuan..." readonly="true">
                        &nbsp;
                        <!-- <button type="submit" id="update" name="update" value="update" class="btn btn-sm btn-warning">Update</button> -->
                        <button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </fieldset> 
	</div>
    <br>
    <div class="container-fluid">
        <div class="row-md-11">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_pj_individu">Individu</a></li>
                <li><a data-toggle="tab" href="#tab_pj_entitas">Entitas</a></li>
            </ul>
            <div class="tab-content">
            <br>
                <div id="tab_pj_individu" class="tab-pane fade in active">
                    <table id="tabelpengajuan" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Jml Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div id="tab_pj_entitas" class="tab-pane fade in">
                    <table id="tabelpengajuan_entitas" width="100%" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Lembaga</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Jml Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>