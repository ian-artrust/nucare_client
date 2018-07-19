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
	<script src="../module/226_rekap_kasir/rekap_kasir.js" type="text/javascript"></script>

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
<!-- Modal Lookup Muzaki -->
<div class="modal fade" id="muzakiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Muzaki</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_muzaki" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>NPWZ</th>
	                            <th>Nama Muzaki</th>
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
	<div class="container-fluid">
        <fieldset>
			<legend>REKAP KAS DAN KARTU MUZAKI</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Tgl Donasi</label><br>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' class="form-control" id="tgl_donasi" size="40" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <button type="button" class="btn btn-info" id="reset">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Reset
                        </button>
                        &nbsp;
                        <button class="btn btn-success" id="cetak">
                            <span class="glyphicon glyphicon-floppy-saved"></span> Cetak
                        </button>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>NPWZ</label><br>
                                    <input type="text" class="form-control" size="20" 
                                    name="npwz" id="npwz"  readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Muzaki</label><br>
                                    <input type="text" class="form-control" size="45" 
                                    name="nama_muzaki" id="nama_muzaki" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#muzakiModal">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <button class="btn btn-info" id="load_donasi">
                            <span class="glyphicon glyphicon glyphicon-retweet"></span> Load 
                        </button>
                        &nbsp;
                        <button class="btn btn-success" id="cetak_km">
                            <span class="glyphicon glyphicon-floppy-saved"></span> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </fieldset>

	</div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="data-here">
                        
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>