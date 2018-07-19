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
	<script src="../module/322_kas/kas.js" type="text/javascript"></script>

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
   
    <!-- Modal Lookup Kas -->
	<div class="modal fade" id="kasModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Kas</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_kas" width="100%" class="table table-bordered table-hover table-striped">
	                    <thead>
	                        <tr>
                                <th>Kode Akun</th>
                                <th>Akun</th>
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

    <!-- Modal Lookup Akun Pemasukan -->
	<div class="modal fade" id="akunModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog" style="width:800px">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                	<span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">Lookup Data Akun</h4>
	            </div>
	            <div class="modal-body">
	                <table id="lookup_akun" width="100%" class="table table-bordered table-hover table-striped">
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
<br>
	<div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_kas">Kas</a></li>
            <li><a data-toggle="tab" href="#tab_revisi">Revisi Donasi</a></li>
        </ul>
        <div class="tab-content">
            <br>
            <div id="tab_kas" class="tab-pane fade in active">
                <fieldset>
                    <legend>TRANSAKASI KAS</legend>
                    <div class="form-group">
                        <!-- Header Transaksi -->
                        <div class="row" id="header">
                            <!-- Column 1 -->
                            <div class="col-md-12">
                                <table border="0" cellspacing="2" cellpadding="2">
                                    <tr>
                                        <td>
                                            <label>Kode Akun</label><br>
                                            <input type="text" class="form-control" size="15" 
                                            name="kode_akun" id="kode_akun" readonly="true">
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label>Akun</label><br>
                                            <input type="text" class="form-control" size="55" 
                                            name="akun" id="akun" readonly="true">
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label>Periode</label><br>
                                            <input type="text" class="form-control" size="15" 
                                            name="txt_periode" id="txt_periode" readonly="true">
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label>Saldo</label><br>
                                            <input type="text" class="form-control" size="20" 
                                            name="saldo" id="saldo" readonly="true">
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <br>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#kasModal">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label>Periode</label><br>
                                            <select class="form-control" style="width:120px;" data-show-subtext="true" data-live-search="true" name="periode" id="periode">
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>
                                            <label>Tgl Transaksi</label><br>
                                            <div class='input-group date' id="datetimepicker1">
                                                <input type='text' class="form-control" id="tgl_transaksi"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <div class="row col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#transaksi">Detail Transaksi</a></li>
                        <li><a data-toggle="tab" href="#batal_transaksi">Batal Transaksi</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Menu Pemasukan -->
                        <br>
                        <div id="transaksi" class="tab-pane fade in active">
                            <div class="row container-fluid">
                                <div class="col-md-5">
                                    <table border="0" cellspacing="2" cellpadding="2">
                                        <tr>
                                            <td>
                                                <label>Akun Counter</label><br>
                                                <input type="text" class="form-control" size="15" 
                                                name="akun_counter" id="akun_counter" readonly="true">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <label>Akun</label><br>
                                                <input type="text" class="form-control" 
                                                name="akun_trs" id="akun_trs" readonly="true" size="35">
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Jumlah</label><br>
                                                <input type="text" class="form-control" 
                                                name="jml_transaksi" id="jml_transaksi">
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <label>Jenis</label><br>
                                                <select name="jenis" id="jenis" class="form-control">
                                                    <option value="Pemasukan">Pemasukan</option>
                                                    <option value="Pengeluaran">Pengeluaran</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <label>Keterangan</label><br>
                                                <input type="text" class="form-control" 
                                                name="keterangan" id="keterangan">
                                            </td>
                                        </tr>
                                    </table>
                                    <button type="button" class="btn btn-info" data-toggle="modal" 
                                    data-target="#akunModal">
                                        <span class="glyphicon glyphicon-search"></span>
                                        Load Akun
                                    </button>

                                    <button class="btn btn-success" id="save">
                                        <span class="glyphicon glyphicon-disk"></span>
                                        Simpan
                                    </button>

                                    <button class="btn btn-primary" id="reset">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                        Reset
                                    </button>
                                    <br><br>
                                    Format: 
                                    <br>
                                    <div id="format_jml"></div>
                                </div>
                                <div class="col-md-7">
                                    <table id="grid_trs" class="table">
                                        <thead>
                                        <tr>
                                            <td>No Jurnal</td>
                                            <td>Tanggal</td>
                                            <td>Keterangan</td>
                                            <td>Debit</td>
                                            <td>Kredit</td>
                                        </tr>
                                        </thead>
                                        <tbody id="grid_transaksi">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="batal_transaksi" class="tab-pane">
                            <div class="row container-fluid">
                                <div class="col-md-3">
                                    <table border="0" class="table">
                                        <tr>
                                            <td>
                                                <label>No Jurnal</label><br>
                                                <input type="text" class="form-control" 
                                                name="no_jurnal" id="no_jurnal" 
                                                size="10">
                                                <button type="submit" id="batal" class="btn btn-sm btn-success">
                                                    Batal
                                                </button>
                                                <button type="submit" id="reset" class="btn btn-sm btn-primary">
                                                    Reset
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-9">
                                    <table id="tabelbatal" class="display" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No Jurnal</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="grid_batal_transaksi">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
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