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
	<script src="../module/325_asset/asset.js" type="text/javascript"></script>

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
   
    <!-- Modal Lookup Kategori Asset -->
	<div class="modal fade" id="akunKategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Asset</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kategori" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>Kode</th>
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

    <!-- Modal Lookup Asset -->
	<div class="modal fade" id="akunAsset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Asset</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_asset" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>Kode</th>
                                <th>Asset</th>
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
	                    <tbody>
        		</tbody>
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
        <div class="row col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab_asset">Asset</a></li>
                <li><a data-toggle="tab" href="#tab_Penyusutan">Penyusutan</a></li>
            </ul>

            <div class="tab-content">
                <br>
                <div id="tab_asset" class="tab-pane fade in active">
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <label>Asset</label><br>
                            <input type="hidden" name="no_asset" id="no_asset">
                            <input type="text" class="form-control" 
                            name="asset" id="asset" placeholder="Asset ...">
                        </div>
                        <div class="col-md-2">
                            <label>Kategori</label><br>
                            <div class="input-group">
                                <input type="hidden" name="kode_kat_asset" id="kode_kat_asset">
                                <input type="text" class="form-control" 
                                name="kat_asset" id="kat_asset" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#akunKategori" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label>Periode</label>
                            <select class="form-control" style="width:105px;" data-show-subtext="true" data-live-search="true" name="periode" id="periode">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Tanggal</label>
                            <div class='input-group date' id="datetimepicker1">
                                <input type='text' size="15" class="form-control" 
                                id="tgl_perolehan"/>
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
                        <div class="col-md-3">
                            <label>Alokasi</label><br>
                            <select class="form-control" data-show-subtext="true" 
                            data-live-search="true" name="pos_dana" id="pos_dana">
                            </select>    
                        </div>
                    </div>
                    <div class="row container-fluid">
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
                        <div class="col-md-1">
                            <Label>Usia</Label><br>
                            <input type="text" class="form-control"
                            name="umur_ekonomis" id="umur_ekonomis"
                            placeholder="Umur">
                        </div>
                        <div class="col-md-2">
                            <label>Waktu</label><br>
                            <select name="satuan" id="satuan" class="form-control" width="15">
                                <option value="Bulan">Bulan</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Perolehan</label><br>
                            <input type="text" class="form-control" size="15"
                            name="harga_perolehan" id="harga_perolehan"
                            placeholder="Perolehan...">
                        </div>
                        <div class="col-md-1">
                            <label>Residu</label><br>
                            <input type="text" class="form-control" size="15"
                            name="nilai_residu" id="nilai_residu"
                            placeholder="Residu...">
                        </div>
                        <div class="col-md-2">
                            <label>Penyusutan</label><br>
                            <input type="text" class="form-control" size="15"
                            name="nilai_penyusutan" id="nilai_penyusutan"
                            placeholder="Penyusutan...">
                        </div>
                    </div>
                    <div class="row container-fluid">
                        <div class="col-md-2">
                            <label>Akun Kategori</label><br>
                            <div class="input-group">
                                <input type="hidden" name="kode_akun_asset" id="kode_akun_asset">
                                <input type="text" class="form-control" 
                                name="akun_asset" id="akun_asset" readonly="true">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning" data-toggle="modal" 
                                    data-target="#akunAsset" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Debit</label><br>
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
                        <div class="col-md-4">
                            <br>
                            <button type="button" class="btn btn-success" id="save">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                            </button>
                            <button type="button" class="btn btn-info" id="reset">
                                <span class="glyphicon glyphicon-refresh"></span> Reset
                            </button>
                            Format: <label id="format_jml"></label> <br>*Jika perolehan diambil dari bank maka rekening wajib dipilih
                        </div>
                    </div>
                    <hr>
                    <div class="row container-fluid">
                        <div class="col-md-3">
                            <input type="text" name="no_batal_asset" id="no_batal_asset" 
                            class="form-control" placeholder="No Asset...">
                            <button class="btn btn-danger" id="batal_asset">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                Batal Asset
                            </button>
                            <br>
                            *Copy No Asset pada datagrid dan paste didalam textbox batal asset
                        </div>
                        <div class="col-md-9">
                            <table id="tabel_asset" width="100%" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No Asset</th>
                                        <th>Asset</th>
                                        <th>Kategori</th>
                                        <th>Nilai</th>
                                        <th>Umur</th>
                                        <th>Penyusutan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>

                <div id="tab_Penyusutan" class="tab-pane fade">
                    <div class="row container-fluid">
                        <div class="col-md-12">
                            <table class="table" id="tabel_penyusutan" border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" size="25" 
                                        name="no_asset_pny" id="no_asset_pny" readonly="true"
                                        placeholder="No Asset ...">
                                        <input type="hidden" name="akun_dua" id="akun_dua">
                                        <input type="hidden" name="akun_tiga" id="akun_tiga">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="50"
                                        name="asset_pny" id="asset_pny" readonly="true"
                                        placeholder="Asset ...">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="40" 
                                        name="kat_asset_pny" id="kat_asset_pny" readonly="true"
                                        placeholder="Kategori ..." >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" size="25"
                                        name="nilai_pny" id="nilai_pny" readonly="true"
                                        placeholder="Nilai Penyusutan...">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" 
                                        data-target="#akunTransaksi">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width:150px;" 
                                        data-show-subtext="true" data-live-search="true" 
                                        name="periode_pny" id="periode_pny">
                                        </select>
                                    </td>
                                    <td>
                                        <div class='input-group date' id="datetimepicker2">
                                            <input type='text' size="35" class="form-control" 
                                            id="tgl_penyusutan"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-success" id="save_pny">
                                <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
                            </button>
                            <button type="button" class="btn btn-info" id="reset_pny">
                                <span class="glyphicon glyphicon-refresh"></span> Reset
                            </button>
                        </div>
                    </div>
                    &nbsp;
                    <div class="row container-fluid">
                        <div class="col-md-3">
                            <input type="text" name="no_batal_penyusutan" id="no_batal_penyusutan" 
                            class="form-control" placeholder="No Penyusutan...">
                            <button class="btn btn-danger" id="batal_penyusutan">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                Batal Penyusutan
                            </button>
                            <br>
                            *Copy No Penyusutan pada datagrid dan paste didalam textbox batal penyusutan
                        </div>
                        <div class="col-md-9">
                            <table id="tabel_transaksi" width="100%" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No Penyusutan</th>
                                        <th>No Asset</th>
                                        <th>Asset</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Penyusutan</th>
                                    </tr>
                                </thead>
                                <tbody id="grid_transaksi">
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
		    </div>
        </div> 
	</div>
</body>
</html>
<?php } ?>