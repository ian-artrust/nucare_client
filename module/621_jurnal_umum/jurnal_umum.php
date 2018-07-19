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
        #format_jml
            {
                font-size: 14px;
                font-weight:bold;
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
	<script src="../module/621_jurnal_umum/jurnal_umum.js" type="text/javascript"></script>

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
   
    <!-- Modal Lookup Akun Debit -->
	<div class="modal fade" id="akunDebit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Akun Debit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_debit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                            <th>Kode Akun</th>
                            <th>Akun Debit</th>
                            <th>Kategori</th>
	                        </tr>
	                    </thead>
	                    <tbody></tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

    <!-- Modal Lookup Akun Kredit -->
	<div class="modal fade" id="akunKredit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Akun Kredit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_kredit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                            <th>Kode Akun</th>
                            <th>Akun Debit</th>
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
<br>
	<div class="container-fluid">
        <div class="row col-md-12">
            <div class="row container-fluid">
                <h3>JURNAL UMUM</h3>
                <div class="col-md-12">
                    <table class="table table-condensed" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td width="50">
                                <select class="form-control" style="width:120px;" 
                                data-show-subtext="true" data-live-search="true" 
                                name="periode" id="periode">
                                </select>
                            </td>
                            <td width="200">
                                <div class='input-group date' id="datetimepicker1">
                                    <input type='text' class="form-control" 
                                    id="tgl_jurnal"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" 
                                name="keterangan" id="keterangan"
                                placeholder="Keterangan...">
                            </td>
                            <td>
                                <input type="number" class="form-control" 
                                name="jml_alokasi" id="jml_alokasi"
                                placeholder="Jumlah...">
                            </td>
                        </tr>
                    </table>
                    <table class="table table-condensed">
                        <tr>
                            <td>
                                <input type="text" class="form-control" size="10" 
                                name="kode_akun_debit" id="kode_akun_debit" readonly="true"
                                placeholder="Kode Debit ..." >
                            </td>
                            <td>
                                <input type="text" class="form-control" size="20" 
                                name="akun_debit" id="akun_debit" readonly="true"
                                placeholder="Akun Debit ..." >
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" 
                                data-target="#akunDebit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </td> 
                            <td>
                                <input type="text" class="form-control" size="10" 
                                name="kode_akun_kredit" id="kode_akun_kredit" readonly="true"
                                placeholder="Kode Kredit ..." >
                            </td>
                            <td>
                                <input type="text" class="form-control" size="20" 
                                name="akun_kredit" id="akun_kredit" readonly="true"
                                placeholder="Akun Kredit ..." >
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" 
                                data-target="#akunKredit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </td>        
                        </tr>
                    </table>
                    <button type="button" class="btn btn-success" id="save">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                    </button>
                    <button type="button" class="btn btn-info" id="reset">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </button>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div class="col-md-12">
                    <table id="tabel_alokasi" width="100%" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No Jurnal</th>
                                <th>Akun</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Periode</th>
                                <th>Debit</th>
                                <th>Kredit</th>
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