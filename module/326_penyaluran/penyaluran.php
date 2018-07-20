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
	<script src="../module/326_penyaluran/penyaluran.js" type="text/javascript"></script>

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
<div class="modal fade" id="akunModalDebit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <th>Akun</th>
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

    <!-- Modal Lookup Akun Kredit -->
	<div class="modal fade" id="akunModalKredit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <th>Akun</th>
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

    <!-- Modal Lookup Rekening -->
	<div class="modal fade" id="rekeningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Bank Piutang</h4>
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
        <fieldset>
			<legend>PENYALURAN DANA</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0">
                            <tr>
                                <td>
                                    <label>No Pengajuan</label><br>
                                    <input type="text" class="form-control" 
                                    name="no_pengajuan" id="no_pengajuan" 
                                    readonly="true" size="20">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Nama Mustahik</label><br>
                                    <input type="text" class="form-control" 
                                    name="nama_mustahik" id="nama_mustahik" 
                                    readonly="true" size="35">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Pengajuan</label><br>
                                    <input type="text" class="form-control" 
                                    name="nama_master" id="nama_master" 
                                    size="45" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Keterangan</label><br>
                                    <input type="text" class="form-control" 
                                    name="keterangan" id="keterangan" 
                                    size="60" readonly="true">
                                </td>
                            </tr>
                        </table>
                        <table border='0'>
                            <tr>
                                <td>
                                    <label>Jumlah</label><br>
                                    <input type="text" class="form-control" 
                                    name="jml_realisasi" id="jml_realisasi" 
                                    size="20" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Asnaf</label><br>
                                    <input type="text" class="form-control" 
                                    name="asnaf" id="asnaf" 
                                    size="45" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Sumber Dana</label><br>
                                    <input type="text" class="form-control" 
                                    name="sumber_dana" id="sumber_dana" 
                                    size="45" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Periode</label><br>
                                    <select class="form-control" style="width:120px;" data-show-subtext="true" data-live-search="true" name="periode" id="periode">
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Tgl Penyaluran</label><br>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' class="form-control" id="tgl_penyaluran"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Debit</label><br>
                                    <div class="input-group">
                                        <input type="hidden" name="kode_akun_debit" id="kode_akun_debit">
                                        <input type="text" class="form-control" 
                                        name="akun_debit" id="akun_debit" readonly="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" data-toggle="modal" 
                                            data-target="#akunModalDebit" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Kredit</label><br>
                                    <div class="input-group">
                                        <input type="hidden" name="kode_akun_kredit" id="kode_akun_kredit">
                                        <input type="text" class="form-control" 
                                        name="akun_kredit" id="akun_kredit" readonly="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-info" data-toggle="modal" 
                                            data-target="#akunModalKredit" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Rekening</label><br>
                                    <input type="text" class="form-control"  
                                    name="no_rekening" id="no_rekening" 
                                    readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Bank</label><br>
                                    <div class="input-group">
                                        <input type="text" class="form-control" 
                                        name="nama_bank" id="nama_bank" readonly="true">
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#rekeningModal" type="button">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Simpan</button>
                                    <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </fieldset> 
	</div>
    <br>
    <div class="container-fluid">
        <div class="row-md-10">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_rek_individu">Individu</a></li>
                <li><a data-toggle="tab" href="#tab_rek_entitas">Entitas</a></li>
            </ul>
            <div class="tab-content">
                <br>
                <div id="tab_rek_individu" class="tab-pane fade in active">
                    <table id="tabel_individu" class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Realisasi</th>
                                <th>Jml Realisasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div id="tab_rek_entitas" class="tab-pane fade in">

                    <table id="tabel_entitas" width='100%' class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Jml Realisasi</th>
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