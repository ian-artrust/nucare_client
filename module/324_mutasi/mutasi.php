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
	<script src="../module/324_mutasi/mutasi.js" type="text/javascript"></script>

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

    <!-- Modal Lookup Target Muzaki -->
	<div class="modal fade" id="muzakiTargetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Target Data Muzaki</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_muzaki_target" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>NPWZ</th>
	                            <th>Nama Muzaki</th>
                                <th>Alamat</th>
	                        </tr>
	                    </thead>
	                    <tbody></tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Sumber Muzaki -->
	<div class="modal fade" id="muzakiSumberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Sumber Data Muzaki</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_muzaki_sumber" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>NPWZ</th>
	                            <th>Nama Muzaki</th>
                                <th>Alamat</th>
	                        </tr>
	                    </thead>
	                    <tbody></tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>
   
    <!-- Modal Lookup Kas Debit -->
	<div class="modal fade" id="akunDebit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Kas Debit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kas_debit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                            <th>No Akun</th>
                            <th>Akun Kas Debit</th>
                            <th>Periode</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

    <!-- Modal Lookup Kas Kredit -->
	<div class="modal fade" id="akunKredit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Kas Kredit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kas_kredit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>No Akun</th>
                                <th>Akun Kas Kredit</th>
                                <th>Periode</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		        </tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Debit 2 -->
	<div class="modal fade" id="akunDebit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Debit 2</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kas_debit2" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>No Akun</th>
                                <th>Akun Kas Debit</th>
                                <th>Periode</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		        </tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

    <!-- Modal Lookup Kredit 2 -->
	<div class="modal fade" id="akunKredit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Kredit 2</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kas_kredit2" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>No Akun</th>
                                <th>Akun Kas Kredit</th>
                                <th>Periode</th>
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
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_mutasi_kas">Mutasi Kas</a></li>
                <li><a data-toggle="tab" href="#tab_revisi">Revisi Donasi</a></li>
            </ul>

            <div class="tab-content">
                <br>
                <div id="tab_mutasi_kas" class="tab-pane fade in active">
                    <div class="row container-fluid">
                        <div class="col-md-6">
                            <label>Jurnal-1 Debit </label><br>
                            <table class="table" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                         <input type="text" class="form-control" size="10" 
                                         name="kode_akun_debit" id="kode_akun_debit" readonly="true"
                                         placeholder="No Akun ...">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="30"
                                        name="akun_kas_debit" id="akun_kas_debit" readonly="true" 
                                        placeholder="Akun Kas Debit ...">
                                        <input type="hidden" name="txt_periode_debit" id="txt_periode_debit">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="20" 
                                        name="saldo_debit" id="saldo_debit" readonly="true"
                                        placeholder="Saldo ..." >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal" 
                                        data-target="#akunDebit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <label>Jurnal-1 Kredit</label><br>
                            <table class="table" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                         <input type="text" class="form-control" size="10" 
                                         name="kode_akun_kredit" id="kode_akun_kredit" readonly="true"
                                         placeholder="No Akun ...">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="30"
                                        name="akun_kas_kredit" id="akun_kas_kredit" readonly="true" 
                                        placeholder="Akun Kas Kredit ...">
                                        <input type="hidden" name="txt_periode_kredit" id="txt_periode_kredit">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="20" 
                                        name="saldo_kredit" id="saldo_kredit" readonly="true"
                                        placeholder="Saldo ..." >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" 
                                        data-target="#akunKredit">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-6">
                            <label>Jurnal-2 Debit </label><br>
                            <table class="table" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                         <input type="text" class="form-control" size="10" 
                                         name="kode_akun_debit2" id="kode_akun_debit2" readonly="true"
                                         placeholder="No Akun ...">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="30"
                                        name="akun_kas_debit2" id="akun_kas_debit2" readonly="true" 
                                        placeholder="Akun Kas Debit ...">
                                        <input type="hidden" name="txt_periode_debit2" 
                                        id="txt_periode_debit2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="20" 
                                        name="saldo_debit2" id="saldo_debit2" readonly="true"
                                        placeholder="Saldo ..." >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#akunDebit2">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <label>Jurnal-2 Kredit</label><br>
                            <table class="table" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                         <input type="text" class="form-control" size="10" 
                                         name="kode_akun_kredit2" id="kode_akun_kredit2" readonly="true"
                                         placeholder="No Akun ...">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="30"
                                        name="akun_kas_kredit2" id="akun_kas_kredit2" readonly="true" 
                                        placeholder="Akun Kas Kredit ...">
                                        <input type="hidden" name="txt_periode_kredit2" id="txt_periode_kredit2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="20" 
                                        name="saldo_kredit2" id="saldo_kredit2" readonly="true"
                                        placeholder="Saldo ..." >
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" 
                                        data-target="#akunKredit2">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <table class="table" border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <input type="text" class="form-control" size="20" 
                                    name="jml_mutasi" id="jml_mutasi"
                                    placeholder="Jumlah Mutasi">
                                </td>
                                <td>
                                    <input type="text" class="form-control" size="65"
                                    name="keterangan" id="keterangan" 
                                    placeholder="Keterangan ...">
                                </td>
                                <td>
                                    <select class="form-control" style="width:120px;" 
                                    data-show-subtext="true" data-live-search="true" 
                                    name="periode" id="periode">
                                    </select>
                                </td>
                                <td>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' size="15" class="form-control" id="tgl_transaksi"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    Format: <label id="format_jml"></label><br><br>
                    <button type="button" class="btn btn-success" id="save">
                        <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                    </button>
                    <button type="button" class="btn btn-info" id="reset">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </button>
                    
                </div>
                <div id="tab_revisi" class="tab-pane">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Muzaki Target</label><br>
                                    <div class="input-group">
                                        <input type="hidden" name="npwz_target" id="npwz_target">
                                        <input type="text" class="form-control" name="muzaki_target" id="muzaki_target" readonly="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" data-toggle="modal" data-target="#muzakiTargetModal" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Muzaki Sumber</label><br>
                                    <div class="input-group">
                                        <input type="hidden" name="npwz_sumber" id="npwz_sumber">
                                        <input type="text" class="form-control" name="muzaki_sumber" id="muzaki_sumber" readonly="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" data-toggle="modal" data-target="#muzakiSumberModal" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>     
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" id="rev_donasi">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Rubah
                                    </button>  
                                    <button type="button" class="btn btn-info" id="reset_rev">
                                        <span class="glyphicon glyphicon-refresh"></span> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		    </div>
        </div> 
	</div>
</body>
</html>
<?php } ?>