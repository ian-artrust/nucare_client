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
	<script src="../module/532_lap_transaksi/lap_transaksi.js" type="text/javascript"></script>

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
        <!-- fieldset -->
			<!-- legend>LAPORAN TRANSAKSI</legend -->
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">

                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <fieldset>
                        <legend>Rekap Transaksi</legend>
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Dari</label><br>
                                    <div class='input-group date' id="dtpj1">
                                        <input type='text' class="form-control" id="dari" size="30" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Sampai</label><br>
                                    <div class='input-group date' id="dtpj2">
                                        <input type='text' class="form-control" id="sampai" size="30" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <a>
                                        <button class="btn" id="load_transaksi">Load</button>
                                    </a>
                                </td>
                            </tr>
                        </table>
                        </fieldset>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <fieldset>
                        <legend>Detail Transaksi</legend>
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Dari</label><br>
                                    <div class='input-group date' id="dtpj1_detail">
                                        <input type='text' class="form-control" id="dari_detail" size="30" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Sampai</label><br>
                                    <div class='input-group date' id="dtpj2_detail">
                                        <input type='text' class="form-control" id="sampai_detail" size="30" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <a>
                                        <button class="btn" id="load_detail">Load</button>
                                    </a>
                                </td>
                            </tr>
                        </table>
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