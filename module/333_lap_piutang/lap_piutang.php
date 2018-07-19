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
	<script src="../module/333_lap_piutang/lap_piutang.js" type="text/javascript"></script>

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
    <!-- Modal Angsuran Kreditur -->
    <div class="modal fade" id="krediturAngsuranModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Piutang Kreditur</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kreditur_angsuran" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>No Piutang</th>
                                <th>Nama Kreditur</th>
                                <th>Jumlah</th>
                                <th>Sumber Dana</th>
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
                        <legend>Angsuran Piutang</legend>
                            <table border="0">
                                <tr>
                                    <td>
                                        <label>No Piutang</label><br>
                                        <input type="hidden" class="form-control" size="20" 
                                        name="no_angsuran" id="no_angsuran" readonly="true">
                                        <input type="text" class="form-control" size="25" 
                                        name="no_piutang_ang" id="no_piutang_ang" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Kreditur</label><br>
                                        <input type="text" class="form-control" size="25" 
                                        name="nama_kreditur_ang" id="nama_kreditur_ang" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Jml Piutang</label><br>
                                        <input type="text" class="form-control" size="25" 
                                        name="jumlah_piutang" id="jumlah_piutang" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Sisa Piutang</label><br>
                                        <input type="text" class="form-control" size="25" 
                                        name="sisa_piutang" id="sisa_piutang" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-info" 
                                        data-toggle="modal" data-target="#krediturAngsuranModal">
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
                        <legend>Piutang</legend>
                            <br>
                            <button class="btn" id="load_piutang">Daftar Piutang</button>
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