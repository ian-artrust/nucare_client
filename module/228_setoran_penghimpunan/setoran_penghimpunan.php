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
	<script src="../module/228_setoran_penghimpunan/setoran_penghimpunan.js" type="text/javascript"></script>

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
                                <!-- <th>Kode Akun</th> -->
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
			<legend>SETORAN ZIS KANTOR LAYANAN</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>No Setoran</label><br>
                                    <input type="text" class="form-control" 
                                    name="no_setoran" id="no_setoran" size="40" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Penyetor</label><br>
                                    <input type="text" class="form-control" 
                                    name="penyetor" id="penyetor" size="80">
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
                                <td>
                                    <label>Tgl Donasi</label><br>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' class="form-control" id="tgl_setoran" size="40" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Rekening</label><br>
                                    <input type="hidden" name="kode_akun" id="kode_akun">
                                    <input type="text" class="form-control" 
                                    name="no_rekening" id="no_rekening" size="40" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Bank</label><br>
                                    <input type="text" class="form-control" 
                                    name="nama_bank" id="nama_bank" size="80" readonly="true">
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
                        <table>
                            <tr>
                                <td>
                                    <label>Jumlah</label><br>
                                    <input type="text" placeholder="Jumlah" 
                                    name="jml_setoran" id="jml_setoran" 
                                    class="form-control" size="15">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Jenis</label><br>
                                    <select class="form-control" style="width:200px;" 
                                    data-show-subtext="true" data-live-search="true" 
                                    name="jenis" id="jenis">
                                        <option value="Setoran Zakat">Setoran Zakat</option>
                                        <option value="Setoran Infak Sedekah">Setoran Infak Sedekah</option>
                                        <option value="Setoran Infak Terikat">Setoran Infak Terikat</option>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Bukti</label><br>
                                    <input type="text" placeholder="No Bukti" 
                                    name="no_bukti" id="no_bukti" 
                                    class="form-control" size="25">
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
            </div>
        </fieldset>
	</div>
    <div class="container-fluid">
        <div class="modal-body">
            <table id="tabel_setoran" width="100%" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No Setoran</th>
                        <th>Tgl Setoran</th>
                        <th>Penyetor</th>
                        <th>Jumlah</th>
                        <th>Bank</th>
                        <th>Status</th>
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