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
    <script src="../bower_components/Jquery-Price-Format/jquery.priceformat.min.js" type="text/javascript"></script>
    <script src="../bower_components/PrintArea/demo/jquery.PrintArea.js" type="text/javascript"></script>

    <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/chosen/chosen.min.css"> -->

	<!-- Call Custom Library -->
	<script src="../module/334_lap_asset/lap_asset.js" type="text/javascript"></script>

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
    <!-- Modal Lookup Transaksit -->
	<div class="modal fade" id="akunTransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Asset</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_transaksi" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>No Asset</th>
                                <th>Asset</th>
                                <th>Kategori</th>
                                <th>Nilai Penyusutan</th>
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
        <!-- fieldset -->
			<!-- legend>LAPORAN TRANSAKSI</legend -->
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-8">
                        <fieldset>
                        <legend>Penyusutan Asset</legend>
                            <table id="tabel_penyusutan" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" size="25" 
                                        name="no_asset_pny" id="no_asset_pny" readonly="true"
                                        placeholder="No Asset ...">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="text" class="form-control" size="50"
                                        name="asset_pny" id="asset_pny" readonly="true"
                                        placeholder="Asset ...">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="text" class="form-control" size="40" 
                                        name="kat_asset_pny" id="kat_asset_pny" readonly="true"
                                        placeholder="Kategori ..." >
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="text" class="form-control" size="25"
                                        name="nilai_pny" id="nilai_pny" readonly="true"
                                        placeholder="Nilai Penyusutan...">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" 
                                        data-target="#akunTransaksi">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-4">
                        <fieldset>
                        <legend>Asset</legend>
                            <button class="btn" id="load_asset">Daftar Asset</button>
                        </fieldset>
                    </div>
                </div>
                <br>
                <button class='btn' id='cetak'>
                    Cetak
                </button>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="data-here">
                        
                        </div>
                    </div>
                </div>
            </div>
        <!-- /fieldset --> 
	</div>
</div>
</body>
</html>
<?php } ?>