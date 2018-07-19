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
	<script src="../module/222_non_tunai/non_tunai.js" type="text/javascript"></script>

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
    
    <!-- Modal Lookup Program -->
	<div class="modal fade" id="programModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Program</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_program" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>Kode</th>
                                <th>Program</th>
                                <th>Kategori</th>
                                <th>Akun Debit</th>
                                <th>Akun Debit Bank</th>
                                <th>Akun Kredit</th>
                                <th>Akun Kredit Bank</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		        </tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

    <!-- Modal Lookup Bank -->
	<div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Bank</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_bank" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>No Rekening</th>
	                            <th>Bank</th>
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
                <li class="active"><a data-toggle="tab" href="#tab_non_tunai">Non Tunai</a></li>
                <li><a data-toggle="tab" href="#tab_qurban">Tabungan Qurban</a></li>
            </ul>

            <div class="tab-content">
                <br>
                <div id="tab_non_tunai" class="tab-pane fade in active">
                    <div class="row container-fluid">
                        <div class="col-md-12">
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                        <label>NPWZ</label><br>
                                        <input type="text" class="form-control" name="npwz" id="npwz" size="40" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Muzaki</label><br>
                                        <input type="text" class="form-control" name="muzaki" id="muzaki" size="80" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#muzakiModal">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>No Bukti Fisik</label><br>
                                        <input type="text" class="form-control" name="no_nota" id="no_nota" size="45">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Periode</label><br>
                                        <!-- <input type="text" class="form-control" name="periode" id="periode" size="25"> -->
                                        <select class="form-control" style="width:120px;" data-show-subtext="true" data-live-search="true" name="periode" id="periode">
                                            <!-- <option value="" selected="selected">- Periode -</option> -->
                                        </select>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Tgl Donasi</label><br>
                                        <div class='input-group date' id="datetimepicker1">
                                            <input type='text' class="form-control" id="tgl_donasi" size="40" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Metode</label><br>
                                            <select class="form-control" style="width:150px;" name="metode" id="metode">
                                                <option value="NON TUNAI">NON TUNAI</option>
                                            </select>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Kode Program</label><br>
                                        <input type="text" placeholder="Kode" 
                                        name="kode_program" id="kode_program" 
                                        class="form-control" size="10" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Program</label><br>
                                        <input type="text" placeholder="Program" 
                                        name="program" id="program" class="form-control"
                                        size="35" readonly="true">
                                        <input type="hidden"
                                        name="akun_debit" id="akun_debit" 
                                        class="form-control">
                                        <input type="hidden"
                                        name="akun_debit" id="akun_debit_bank" 
                                        class="form-control">
                                        <input type="hidden"
                                        name="akun_kredit" id="akun_kredit" 
                                        class="form-control">
                                        <input type="hidden"
                                        name="akun_kredit_bank" id="akun_kredit_bank" 
                                        class="form-control">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#programModal">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>Jumlah</label><br>
                                        <input type="text" placeholder="Jumlah" 
                                        name="jml_donasi" id="jml_donasi" 
                                        class="form-control" size="15">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>No Rekening</label><br>
                                        <input type="text" class="form-control" 
                                        name="no_rekening" id="no_rekening" size="40" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <label>BANK</label><br>
                                        <input type="text" class="form-control" 
                                        name="nama_bank" id="nama_bank" size="80" readonly="true">
                                        <input type="hidden" class="form-control" 
                                        name="saldo_bank" id="saldo_bank" size="10" readonly="true">
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <br>
                                        <button type="button" class="btn btn-info" data-toggle="modal" 
                                        data-target="#bankModal">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
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
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <table border="0" class="table">
                                <tr>
                                    <td>
                                        <label>No Donasi</label><br>
                                        <input type="text" class="form-control" 
                                        name="no_donasi" id="no_donasi" 
                                        size="10" readonly="true">
                                        <button type="submit" id="batal" class="btn btn-sm btn-success">
                                            Batal
                                        </button>
                                        <button type="submit" id="reprint" class="btn btn-sm btn-primary">
                                            Cetak
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="col-md-10">
                            <table id="tabelbatal" class="display" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Donasi</th>
                                        <th>NPWZ</th>
                                        <th>Nama Donatur</th>
                                        <th>Tanggal</th>
                                        <th>No Rekening</th>
                                        <th>Program</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="tab_qurban" class="tab-pane fade">
                    <div class="row container-fluid">
                        <div class="row clearfix">
                        </div> <!-- ./End Container form -->
                        <br>
                        <div class="row clearfix">
                            <!-- Datagrid Place -->
                            <div class="col-md-12 column">
                            </div>
                        </div><!-- ./End Datagrid-->
                    </div>
                </div>
		    </div>
        </div> 
	</div>
</body>
</html>
<?php } ?>