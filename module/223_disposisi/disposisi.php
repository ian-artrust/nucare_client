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
	<script src="../module/223_disposisi/disposisi.js" type="text/javascript"></script>

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
   <br>
	<div class="container-fluid">
        <fieldset>
			<legend>DISPOSISI DOKUMEN / BARANG</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>No Diposisi</label><br>
                                    <input type="text" class="form-control" name="no_disposisi" id="no_disposisi" size="25" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Agenda</label><br>
                                    <input type="text" class="form-control" 
                                    name="no_agenda" id="no_agenda" size="15">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Pengirim</label><br>
                                    <input type="text" class="form-control" name="pengirim" id="pengirim" size="65">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>No Surat</label><br>
                                    <input type="text" class="form-control" name="no_surat" id="no_surat" size="35">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Tgl Surat</label><br>
                                    <div class='input-group date' id="datetimepicker1">
                                        <input type='text' class="form-control" id="tgl_surat" size="25" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Tertanggal</label><br>
                                    <div class='input-group date' id="datetimepicker2">
                                        <input type='text' class="form-control" id="tertanggal_surat" size="25" />
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
                <div class="row">
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>
                                    <label>Tujuan: </label><br>
                                    <select class="form-control" name="deliver_to" id="deliver_to" width="350px">
                                        <option value="Direktur">Direktur</option>
                                        <option value="Keuangan">Keuangan</option>
                                        <option value="Program">Program</option>
                                        <option value="Umum">Umum</option>
                                    </select>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Perihal</label><br>
                                    <input type="text" class="form-control" size="55" 
                                    name="perihal" id="perihal">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Catatan Penerima</label>
                                    <input type="text" class="form-control" 
                                    name="catatan_penerima" id="catatan_penerima" size="55">
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </div>                             
                </div>
            </div>
		
            <button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Save</button>
            <button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>	
            <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
        </fieldset> 
	</div>
    <br>
    <div class="container-fluid">
        <div class="row-md-10">
            <table id="tabeldisposisi" class="display" cellspacing="0">
                <thead>
                    <tr>
                        <th>No Disposisi</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Tanggal</th>
                        <th>No Surat</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>