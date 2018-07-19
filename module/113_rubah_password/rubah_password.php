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
	<script src="../module/113_rubah_password/rubah_password.js" type="text/javascript"></script>

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
			<legend>RUBAH PASSWORD</legend>
            <div class="form-group">
                <!-- Header Transaksi -->
                <div class="row" id="header">
                    <!-- Column 1 -->
                    <div class="col-md-12">
                        <table border="0" cellspacing="2" cellpadding="2">
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Kode Petugas</label><br>
                                    <input type="text" class="form-control" size="15" 
                                    name="kode_petugas" id="kode_petugas" 
                                    value="<?php echo $_SESSION['kode_petugas']; ?>" readonly="true">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Nama Petugas</label><br>
                                    <input type="text" class="form-control" size="25" 
                                    name="nama_petugas" id="nama_petugas">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Username</label><br>
                                    <input type="text" class="form-control" size="25" 
                                    name="username" id="username">
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <label>Password Baru</label><br>
                                    <input type="password" class="form-control" 
                                    name="new_password" id="new_password" size="35">
                                </td>
                                <td>&nbsp;</td>

                            </tr>
                        </table>
                        <br>
                        <button type="submit" id="update" name="update" class="btn btn-sm btn-info">Update</button>	
                        <button type="reset" id="reset" class="btn btn-sm btn-primary">Reset</button>
                    </div>
                </div>
            </div>
        </fieldset> 
	</div>
</div>
</body>
</html>
<?php } ?>