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
	<script src="../module/324_piutang/piutang.js" type="text/javascript"></script>

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
   
    <!-- Modal Lookup Kreditur -->
	<div class="modal fade" id="krediturModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Kreditur</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kreditur" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>Kode Kreditur</th>
                                <th>Nama Kreditur</th>
                                <th>Phone</th>
	                        </tr>
	                    </thead>
	                    <tbody>
        		</tbody>
	                </table>  
	            </div>
	        </div>
	    </div>
	</div>

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

     <!-- Modal Lookup Angsuran Debit -->
	<div class="modal fade" id="akunDebitAngsuran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Angsuran Debit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_angsuran_debit" width="100%" class="table table-bordered table-hover table-striped">
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

    <!-- Modal Lookup Angsuran Kredit -->
	<div class="modal fade" id="akunKreditAngsuran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Angsuran Kredit</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun_angsuran_kredit" width="100%" class="table table-bordered table-hover table-striped">
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

    <!-- Modal Lookup Rekening -->
    <div class="modal fade" id="rekAngsuranModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Bank Angsuran</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_bank_angsuran" width="100%" class="table table-bordered table-hover table-striped">
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
        <br>
        <div class="row col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#piutang">Piutang</a></li>
                <li><a data-toggle="tab" href="#angsuran_piutang">Angsuran Piutang</a></li>
            </ul>

            <div class="tab-content">
                <!-- Menu Pemasukan -->
                <br>
                <div id="piutang" class="tab-pane fade in active">
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <label>Kode</label><br>
                            <input type="text" class="form-control" 
                            name="kode_kreditur" id="kode_kreditur" readonly="true">
                        </div>
                        <div class="col-md-3">
                            <label>Kreditur</label><br>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_kreditur" id="nama_kreditur" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#krediturModal" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label>Periode</label><br>
                            <select class="form-control" style="width:105px;"
                            data-show-subtext="true" data-live-search="true" 
                            name="periode" id="periode">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Tgl Piutang</label><br>
                            <div class='input-group date' id="datetimepicker1">
                                <input type='text' class="form-control" id="tgl_piutang"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Sumber Dana</label><br>
                            <select name="sumber_dana" id="sumber_dana" class="form-control">
                                <option value="Dana Zakat">Dana Zakat</option>
                                <option value="Dana Infak Sedekah">Dana Infak Sedekah</option>
                                <option value="Dana Amil">Dana Amil</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Jumlah: </label><label id="format_jml"></label><br>
                            <input type="text" class="form-control" 
                            name="jml_piutang" id="jml_piutang">
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-3">
                            <label>Akun Debit</label><br>
                            <div class="input-group">
                                <input type="hidden" class="form-control"  
                                name="kode_akun_debit" id="kode_akun_debit" 
                                readonly="true">
                                <input type="text" class="form-control" 
                                name="akun_debit" id="akun_debit" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#akunModalDebit" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Akun Kredit</label><br>
                            <div class="input-group">
                                <input type="hidden" class="form-control"  
                                name="kode_akun_kredit" id="kode_akun_kredit" 
                                readonly="true">
                                <input type="text" class="form-control" 
                                name="akun_kredit" id="akun_kredit" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#akunModalKredit" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>No Rekening</label><br>
                            <input type="text" class="form-control"  
                            name="no_rekening" id="no_rekening" 
                            readonly="true">
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-success" id="save">
                                <span class="glyphicon glyphicon-disk"></span>
                                Simpan
                            </button>

                            <button class="btn btn-primary" id="reset">
                                <span class="glyphicon glyphicon-refresh"></span>
                                Reset
                            </button>
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-8">
                            *Jika Piutang Kreditnya adalah Bank maka rekening bank Wajib Dipilih, jika kas kosongkan saja
                        </div>
                    </div>
                    <hr>
                    <div class="row container-fluid">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>No Piutang</label><br>
                                    <input type="text" name="no_batal_piutang" 
                                    id="no_batal_piutang" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-danger" id="batal_piutang">
                                        <span class="glyphicon glyphicon-remove-sign"></span>
                                        Batal Piutang
                                    </button>                                    
                                </div>
                            </div>
                            <div class="row">
                                *Copy No Piutang pada datagrid dan paste didalam textbox batal piutang
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table id="tabel_piutang" class="table">
                                <thead>
                                <tr>
                                    <td>No Piutang</td>
                                    <td>Kreditur</td>
                                    <td>Tanggal</td>
                                    <td>Jumlah</td>
                                </tr>
                                </thead>
                                <tbody id="grid_transaksi">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="angsuran_piutang" class="tab-pane">
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <label>Kreditur</label><br>
                            <input type="text" class="form-control" 
                            name="nama_kreditur_ang" id="nama_kreditur_ang" readonly="true">
                            <!-- <label>No Piutang</label><br> -->
                            <input type="hidden" class="form-control" 
                            name="no_angsuran" id="no_angsuran" readonly="true">
                            <input type="hidden" class="form-control" 
                            name="no_piutang_ang" id="no_piutang_ang" readonly="true">
                        </div>
                        <div class="col-md-2">
                            <label>Jml Piutang</label><br>
                            <input type="text" class="form-control"
                            name="jumlah_piutang" id="jumlah_piutang" readonly="true">
                        </div>
                        <div class="col-md-2">
                            <label>Sisa</label><br>
                            <input type="text" class="form-control" 
                            name="sisa_piutang" id="sisa_piutang" readonly="true">
                        </div>
                        <div class="col-md-2">
                            <label>Sumber Dana</label><br>
                            <div class="input-group">
                                <input type="text" class="form-control" 
                                name="sumber_dana_ang" id="sumber_dana_ang" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#krediturAngsuranModal" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Periode</label><br>
                            <select class="form-control" width="175"
                            data-show-subtext="true" data-live-search="true" 
                            name="periode_angsuran" id="periode_angsuran">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Tgl Angsuran</label><br>
                            <div class='input-group date' id="datetimepicker2">
                                <input type='text' class="form-control" id="tgl_angsuran"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <label>Jumlah: </label><label id="format_jml_angsuran"></label><br>
                            <input type="text" class="form-control" 
                            name="jml_angsuran" id="jml_angsuran">
                        </div>
                        <div class="col-md-3">
                            <label>Debit</label><br>
                            <div class="input-group">
                                <input type="hidden" name="kode_debit_angsuran" id="kode_debit_angsuran">
                                <input type="text" class="form-control" 
                                name="akun_debit_angsuran" id="akun_debit_angsuran" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#akunDebitAngsuran" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Kredit</label><br>
                            <div class="input-group">
                                <input type="hidden" name="kode_kredit_angsuran" id="kode_kredit_angsuran">
                                <input type="text" class="form-control" 
                                name="akun_kredit_angsuran" id="akun_kredit_angsuran" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#akunKreditAngsuran" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>No Rekening</label><br>
                            <input type="text" class="form-control"  
                            name="no_rek_angsuran" id="no_rek_angsuran" 
                            readonly="true">
                        </div>
                        <div class="col-md-2">
                            <label>Bank</label><br>
                            <div class="input-group">
                                <input type="text" class="form-control" 
                                name="nama_bank_angsuran" id="nama_bank_angsuran" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#rekAngsuranModal" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-1">
                            <br>
                            <button class="btn btn-success" id="save_angsuran">
                                <span class="glyphicon glyphicon-disk"></span>
                                Simpan
                            </button>
                        </div>
                        <div class="col-md-7">
                        <br>
                            *Jika angsuran debitnya adalah Bank maka rekening bank Wajib Dipilih, jika kas kosongkan saja
                        </div>
                    </div>
                    <hr>
                    <div class="row container-fluid">
                        <div class="col-md-3">
                            <input type="text" name="no_batal_angsuran" id="no_batal_angsuran" 
                            class="form-control" placeholder="No Angsuran...">
                            <button class="btn btn-danger" id="batal_angsuran">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                Batal Angsuran
                            </button>
                            <br>
                            *Copy No Angsuran pada datagrid dan paste didalam textbox batal angsuran
                        </div>
                        <div class="col-md-9">
                            <table id="tabel_angsuran" width="100%" class="display" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Angsuran</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="grid_angsuran">
                                </tbody>
                            </table>
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