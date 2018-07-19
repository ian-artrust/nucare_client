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
	<script src="../module/423_rekomendasi/rekomendasi.js" type="text/javascript"></script>

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
			<legend>REKOMENDASI PENGAJUAN</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0" class="table">
                            <tr>
                                <td>
                                    <label>No Pengajuan</label><br>
                                    <input type="text" class="form-control" 
                                    name="no_pengajuan" id="no_pengajuan" 
                                    size="20" readonly="true">
                                </td>
                                <td>
                                    <label>Nama Mustahik</label><br>
                                    <input type="text" class="form-control" 
                                    name="nama_mustahik" id="nama_mustahik" 
                                    size="25" readonly="true">
                                </td>
                                <td>
                                    <label>Pengajuan</label><br>
                                    <input type="text" class="form-control" 
                                    name="nama_master" id="nama_master" 
                                    size="35" readonly="true">
                                </td>
                                <td>
                                    <label>Poin Asesmen</label><br>
                                    <input type="number" class="form-control" 
                                    name="poin_penilaian" id="poin_penilaian" 
                                    size="10">
                                </td>
                                <td>
                                    <label>Rekomendasi</label><br>
                                    <input type="text" class="form-control" 
                                    size="45" name="rekomendasi" id="rekomendasi">
                                </td>
                                <td>
                                    <label>Asnaf</label><br>
                                    <select class="form-control" width="300px" name="asnaf" id="asnaf">
                                    <option value="Fakir-Miskin">Fakir-Miskin</option>
                                    <option value="Mualaf">Mualaf</option>
                                    <option value="Riqab">Riqab</option>
                                    <option value="Ghorimin">Ghorimin</option>
                                    <option value="Fisabilillah">Fisabilillah</option>
                                    <option value="Ibnu Sabil">Ibnu Sabil</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button type="submit" id="save" name="save" value="save" class="btn btn-sm btn-success">Rekomendasi</button>
                <button type="button" id="delete" name="delete" class="btn btn-sm btn-danger">Delete</button>	
                <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
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
                    <table id="tabelrekomendasi" width='100%' class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Jml Pengajuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div id="tab_rek_entitas" class="tab-pane fade in">

                    <table id="tabelrekomendasi_entitas" width='100%' class="display" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No Disposisi</th>
                                <th>No Pengajuan</th>
                                <th>Mustahik</th>
                                <th>Pengajuan</th>
                                <th>Tgl Pengajuan</th>
                                <th>Jml Pengajuan</th>
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