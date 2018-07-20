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
	<script src="../module/321_setup_saldo/setup_saldo.js" type="text/javascript"></script>

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
	<div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Akun Debit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_debit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Akun</th>
	                            <th>Nama Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Akun Debit Bank -->
	<div class="modal fade" id="debitModalBank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Akun Debit Bank</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_debit_bank" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Akun</th>
	                            <th>Nama Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Akun Kredit -->
	<div class="modal fade" id="kreditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Akun Kredit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kredit" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Akun</th>
	                            <th>Nama Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Akun Kredit Bank -->
	<div class="modal fade" id="kreditModalBank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Akun Kredit Bank</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kredit_bank" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode Akun</th>
	                            <th>Nama Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
    </div>

    <!-- Modal Lookup Rekening -->
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
    
   
    <br>
	<div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_setup">Non Bank</a></li>
            <li><a data-toggle="tab" href="#tab_setup_bank">Bank</a></li>
            <li><a data-toggle="tab" href="#tab_batal">Batal Setup</a></li>
        </ul>
        <div class="tab-content">
            <br>
            <div id="tab_setup" class="tab-pane fade in active">
                <div class="form-group">
                    <!-- Header Transaksi -->
                    <div class="row" id="header">
                        <!-- Column 1 -->
                        <div class="col-md-12">
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                        <label>Kode Akun Debit</label><br>
                                        <input type="text" class="form-control" 
                                        name="kode_akun_debit" id="kode_akun_debit" size="15" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Akun Debit</label><br>
                                        <input type="text" class="form-control" 
                                        name="akun_debit" id="akun_debit" size="45" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-success" 
                                        data-toggle="modal" data-target="#debitModal">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Kode Akun Kredit</label><br>
                                        <input type="text" class="form-control" 
                                        name="kode_akun_kredit" id="kode_akun_kredit" 
                                        size="15" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Akun Kredit</label><br>
                                        <input type="text" class="form-control" 
                                        name="akun_kredit" id="akun_kredit" 
                                        size="45" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-info" 
                                        data-toggle="modal" data-target="#kreditModal">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
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
                                </tr>
                                <tr>
                                    <td>
                                        <label>Tgl Setup</label><br>
                                        <div class='input-group date' id="datetimepicker1">
                                            <input type='text' class="form-control" id="tgl_setup" size="15" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Jumlah</label><br>
                                        <input type="text" placeholder="Jumlah" 
                                        name="jml_setup" id="jml_setup" 
                                        class="form-control" size="35">
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <br>
                            <button type="button" class="btn btn-info" id="reset">
                                <span class="glyphicon glyphicon-refresh"></span>
                                Reset
                            </button>
                            &nbsp;
                            <button class="btn btn-success" id="cetak">
                                <span class="glyphicon glyphicon-floppy-saved"></span> Simpan
                            </button>
                            &nbsp;
                            Format : <label id="format_mata_uang"></label>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div id="tab_setup_bank" class="tab-pane">
                <div class="row" id="header_dua">
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Kode Akun Debit Bank</label><br>
                                    <input type="text" class="form-control" 
                                    name="kode_akun_debit_bank" id="kode_akun_debit_bank" 
                                    size="15" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Akun Debit Bank</label><br>
                                    <input type="text" class="form-control" 
                                    name="akun_debit_bank" id="akun_debit_bank" 
                                    size="45" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="button" class="btn btn-success" 
                                    data-toggle="modal" data-target="#debitModalBank">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Kode.Ak Bank</label><br>
                                    <input type="text" class="form-control" 
                                    name="kode_akun_kredit_bank" id="kode_akun_kredit_bank" 
                                    size="15" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Akun Kredit Bank</label><br>
                                    <input type="text" class="form-control" 
                                    name="akun_kredit_bank" id="akun_kredit_bank" 
                                    size="45" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="button" class="btn btn-info" 
                                    data-toggle="modal" data-target="#kreditModalBank">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Periode</label><br>
                                    <select class="form-control" style="width:120px;" 
                                    data-show-subtext="true" data-live-search="true" 
                                    name="periode_bank" id="periode_bank">
                                        
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tgl Setup</label><br>
                                    <div class='input-group date' id="datetimepicker2">
                                        <input type='text' class="form-control" id="tgl_setup_bank" size="15" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Jumlah</label><br>
                                    <input type="text" placeholder="Jumlah" 
                                    name="jml_setup_bank" id="jml_setup_bank" 
                                    class="form-control" size="35">
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Rekening</label><br>
									<input type="text" class="form-control" size="15" id="no_rekening" name="no_rekening"
									placeholder="No Rekening" readonly="true" >
								</td>
                                <td>&nbsp;</td>
								<td>
                                    <label>Bank</label><br>
									<input type="text" size="50" class="form-control" id="nama_bank" name="nama_bank" 
									required placeholder="Nama Bank ...."  readonly="true">
								</td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
									<button type="button" class="btn btn-warning" 
									data-toggle="modal" data-target="#rekeningModal">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    *Rekening Bank Wajib Dipilih 
                                </td>
                            </tr>
                        </table>
                        <br>
                        <button type="button" class="btn btn-info" id="reset_bank">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Reset
                        </button>
                        &nbsp;
                        <button class="btn btn-success" id="cetak_bank">
                            <span class="glyphicon glyphicon-floppy-saved"></span> Simpan
                        </button>
                        &nbsp;
                        Format : <label id="format_mata_uang_bank"></label>
                    </div>
                </div>
                <br>
            </div>
            <div id="tab_batal" class="tab-pane">
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
                        <button class="btn btn-danger" id="setup_batal">
                            <span class="glyphicon glyphicon-remove-sign"></span> Batal Setup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="grid-data">
            <div class="col-md-12 column">
                <table id="tabelsaldo" class="display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Jurnal</th>
                            <th>Kode</th>
                            <th>Akun</th>
                            <th>Periode</th>
                            <th>Tgl Setup</th>
                            <th>Saldo</th>
                            <th>Rekening</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
	</div>
</div>
</body>
</html>
<?php } ?>