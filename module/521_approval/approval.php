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
	<script src="../module/521_approval/approval.js" type="text/javascript"></script>

    <style>
        input, select {
            padding: 3px;
        }
        #npwz, #muzaki, #zisr, #total_donasi{
            background-color:#e1f4f7;
        }
    </style>
</head>
<body>
    <br>
	<div class="container-fluid">
        <div class="row" id="header">
            <!-- Column 1 -->
            <div class="col-md-12">
                <table border="0" class="table table-condensed" cellspacing="2" cellpadding="2">
                    <tr>
                        <td>
                            <label>No Pengajuan</label><br>
                            <input type="text" class="form-control" 
                            name="no_pengajuan" id="no_pengajuan" 
                            size="20" readonly="true">
                        </td>
                        <td>
                            <label>Mustahik</label><br>
                            <input type="text" class="form-control" size="20" 
                            name="nama_mustahik" id="nama_mustahik"  readonly="true">
                        </td>
                        <td>
                            <label>Pengajuan</label><br>
                            <input type="text" class="form-control" 
                            name="nama_master" id="nama_master" size="30" readonly="true">
                        </td>
                        <td>
                            <label>Asnaf</label><br>
                            <input type="text" class="form-control" 
                            name="asnaf" id="asnaf" size="10" readonly="true">
                        </td>
                        <td>
                            <label>Jumlah</label><br>
                            <input type="text" class="form-control" 
                            name="jml_pengajuan" id="jml_pengajuan" 
                            size="15" readonly="true">
                        </td>
                        <td>
                            <label>Poin</label><br>
                            <input type="text" class="form-control" size="10"
                            name="poin_penilaian" id="poin_penilaian" readonly="true">
                        </td>
                        <td>
                            <label>Rekomendasi</label><br>
                            <input type="text" class="form-control" size="25"
                            name="rekomendasi" id="rekomendasi" readonly="true">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table border="0" class="table" cellspacing="2" cellpadding="2">
                    <tr>
                        <td>
                            <label>Output</label><br>
                            <select class="form-control" name="status" id="status">
                            <option value="DITOLAK">DITOLAK</option>
                            <option value="REALISASI">REALISASI</option>
                        </td>
                        <td>
                            <label>Jml Realisasi</label><br>
                            <input type="text" class="form-control" 
                            name="jml_realisasi" id="jml_realisasi" >
                        </td>
                        <td>
                            <label>Tgl Realisasi</label><br>
                            <div class='input-group date' id="datetimepicker1">
                                <input type='text' class="form-control" size="10" id="tgl_realisasi" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <label>Sumber Dana</label><br>
                            <select class="form-control" width="75px" name="sumber_dana" id="sumber_dana">
                            <option value="Dana Zakat">Dana Zakat</option>
                            <option value="Dana Infak Sedekah">Dana Infak Sedekah</option>
                            <option value="Dana CSR">Dana CSR</option>
                            <option value="Dana Amil">Dana Amil</option>
                        </td>
                        <td>
                            <label>Catatan</label><br>
                            <input type="text" class="form-control" size="35" 
                            name="catatan_direktur" id="catatan_direktur" >
                        </td>
                        <td>
                            <br>
                            <button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Proses</button>
                            <!-- <button type="submit" id="update" name="update" value="update" class="btn btn-sm btn-warning">Update</button> -->
                            <button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>	
                            <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
                        </td>
                    </tr>
                </table>
            </div>                             
        </div>
	</div>
    <div class="container-fluid">
        <div class="row-md-11">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_apr_individu">Individu</a></li>
                <li><a data-toggle="tab" href="#tab_apr_entitas">Entitas</a></li>
            </ul>
            <div class="tab-content">
                <br>
                <div id="tab_apr_individu" class="tab-pane fade in active">
                    <table id="tabelapproval" class="table table-condensed" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Tgl Survey</th>
                                <th>Jml Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div id="tab_apr_entitas" class="tab-pane fade in">
                    <table id="tabelapproval_entitas" width="100%" class="table table-condensed" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Lembaga</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Tgl Survey</th>
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