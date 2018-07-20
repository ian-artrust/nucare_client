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
	<script src="../module/327_hak_amil/hak_amil.js" type="text/javascript"></script>

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

        <!-- Modal Lookup Akun Debit 2 -->
	<div class="modal fade" id="akunDebit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Akun Debit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_debit2" width="100%" class="table table-bordered table-hover table-striped">
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

    <!-- Modal Lookup Akun Kredit 2 -->
	<div class="modal fade" id="akunKredit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Akun Kredit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_kredit2" width="100%" class="table table-bordered table-hover table-striped">
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

    <!-- Modal Lookup Rekening -->
	<div class="modal fade" id="rekeningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Bank Jurnal 1</h4>
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

    <div class="modal fade" id="rekeningDuaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Bank Jurnal 2</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_bank_dua" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
	                            <th>No Rekening</th>
	                            <th>Nama Bank</th>
								<th>Kode Akun</th>
	                        </tr>
	                    </thead>
	                    <tbody></tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>
<br>
	<div class="container-fluid">
        <div class="row container-fluid">
            <div class="col-md-12">
                <table class="table table-condensed" border="0" cellspacing="2" cellpadding="2">
                    <tr>

                        <td>
                            <input type="text" class="form-control" size="15" 
                            name="jml_penerimaan" id="jml_penerimaan" readonly="true"
                            placeholder="Jumlah Penerimaan...">
                        </td>
                        <td>
                            <input type="text" class="form-control" size="3" 
                            name="alokasi" id="alokasi" placeholder="{%...}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" id="load_pnr">
                                <span class="glyphicon glyphicon-refresh"></span>&nbsp;Load
                            </button>
                        </td>
                        <td>
                            <input type="text" class="form-control" size="15"
                            name="jml_alokasi" id="jml_alokasi" placeholder="Alokasi Amil...">
                        </td>
                        <td width="50">
                            <select class="form-control" style="width:120px;" 
                            data-show-subtext="true" data-live-search="true" 
                            name="periode" id="periode">
                            </select>
                        </td>
                        <td>
                            <select class="form-control" 
                            data-show-subtext="true" data-live-search="true" 
                            name="jenis" id="jenis">
                                <option value="Penerimaan Zakat">Penerimaan Zakat</option>
                                <option value="Penerimaan Infak Tidak Terikat">Penerimaan Infak Tidak Terikat</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" id="hitung">
                                <span class="glyphicon glyphicon-equalizer"></span>&nbsp;Hitung
                            </button>
                        </td> 
                        <td width="200">
                            <div class='input-group date' id="datetimepicker1">
                                <input type='text' class="form-control" 
                                id="tgl_alokasi"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Jurnal 1 -->
        <div class="row container-fluid">
            <div class="col-md-4">
                <label>Jurnal 1 |Debit</label><br>
                <div class="input-group">
                    <input type="hidden" name="kode_akun_debit" id="kode_akun_debit">
                    <input type="text" class="form-control" 
                    name="akun_debit" id="akun_debit" readonly="true">
                    <span class="input-group-btn">
                        <button class="btn btn-success" data-toggle="modal" 
                        data-target="#akunDebit" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <label>Kredit</label><br>
                <div class="input-group">
                    <input type="hidden" name="kode_akun_kredit" id="kode_akun_kredit">
                    <input type="text" class="form-control" 
                    name="akun_kredit" id="akun_kredit" readonly="true">
                    <span class="input-group-btn">
                        <button class="btn btn-info" data-toggle="modal" 
                        data-target="#akunKredit" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <label>No Rek Jurnal 1</label><br>
                <input type="text" class="form-control"  
                name="no_rekening" id="no_rekening" 
                readonly="true">
            </div>
            <div class="col-md-3">
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
            </div>
        </div>
        <!-- Jurnal 2 -->
        <div class="row container-fluid">
            <div class="col-md-3">
                <label>Jurnal 2 | Debit</label><br>
                <div class="input-group">
                    <input type="hidden" name="kda_debit" id="kda_debit">
                    <input type="text" class="form-control" 
                    name="a_debit" id="a_debit" readonly="true">
                    <span class="input-group-btn">
                        <button class="btn btn-success" data-toggle="modal" 
                        data-target="#akunDebit2" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <label>Kredit</label><br>
                <div class="input-group">
                    <input type="hidden" name="kda_kredit" id="kda_kredit">
                    <input type="text" class="form-control" 
                    name="a_kredit" id="a_kredit" readonly="true">
                    <span class="input-group-btn">
                        <button class="btn btn-info" data-toggle="modal" 
                        data-target="#akunKredit2" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <label>No Rek Jurnal 2</label><br>
                <input type="text" class="form-control"  
                name="no_rekening_dua" id="no_rekening_dua" 
                readonly="true">
            </div>
            <div class="col-md-3">
                <label>Bank</label><br>
                <div class="input-group">
                    <input type="text" class="form-control" 
                    name="nama_bank_dua" id="nama_bank_dua" readonly="true">
                    <span class="input-group-btn">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#rekeningDuaModal" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <!-- Button -->
        <div class="row container-fluid">
            <div class="col-md-2">
                <button type="button" class="btn btn-success" id="save">
                    <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                </button>
                <button type="button" class="btn btn-info" id="reset">
                    <span class="glyphicon glyphicon-refresh"></span> Reset
                </button>
            </div>
            <div class="col-md-6">
                Jika Akun Bank Maka Rekening Wajib Dipilih, 
                Jika Bukan Kosongkan Saja 
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-md-12">
                <table id="tabel_alokasi" width="100%" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No Jurnal</th>
                            <th>Akun</th>
                            <th>Keterangan</th>
                            <th>Periode</th>
                            <th>Tanggal</th>
                            <th>Jml Alokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>  
            </div>        
        </div>
	</div>
</body>
</html>
<?php } ?>