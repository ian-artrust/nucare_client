<html>
<head>
    <title>Cetak Struk</title>
    <style>
        @font-face{
            font-family: "sqr";
            src: url('../lib/fonts/square721.ttf');
        }

        @media print {
            html, body {
                font-family: "sqr";
            }
        
            /* @page {
              size: 21.49cm 13.97cm;
            }
        
            .logo {
              width: 30%;
            } */
        
        }

        .table th { 
            border: none !important;
        }

    </style>
</head>
    <!-- Call JQuery Library -->
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
    
    <!-- Call DataTables Library -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../bower_components/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="../bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../bower_components/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
    <script src="../bower_components/wnumb/wNumb.js" type="text/javascript"></script>
    <script src="../bower_components/Jquery-Price-Format/jquery.priceformat.min.js" type="text/javascript"></script>
    <script src="../bower_components/PrintArea/demo/jquery.PrintArea.js" type="text/javascript"></script>

    <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/chosen/chosen.min.css"> -->

    <!-- Call Custom Library -->
    <script src="../module/223_disposisi/tanda_terima.js" type="text/javascript"></script>
<body>
<?php
    $no_disposisi = $_GET['no_disposisi'];
?>

    <div class="row col-md-2"></div>
    <div class="row col-md-8" id="cetak" onload="window.print();">
        <table border="0" width="100%">
        <tr>
            <td rowspan="3"><img src="../lib/img/logo_login.png" width="145" alt=""></td>
        </tr>
        <tr>
            <td><h2 align="right">TANDA TERIMA</h2></td>    
        </tr>
        <tr>
            <td><h3 align="right" id="field_no_disposisi"></h3></td>
        </tr>
        </table>
        <input type="hidden" class="form-control" size="25" 
        name="no_disposisi" id="no_disposisi" 
        value="<?php echo $no_disposisi; ?>">
        <table width="100%" class="table" cellspacing="35" cellpadding="35">
            <tr style="border-top:1px solid;">
                <td width="100">Pengirim</td>
                <td>:</td>
                <td colspan="3" id="field_pengirim"></td>
            </tr>
            <tr style="border-top:1px solid;">
                <td>Jenis</td>
                <td>:</td>
                <td><input type="checkbox" id="barang">Barang</td>
                <td><input type="checkbox" id="dokumen">Dokumen</td>
                <td><input type="checkbox" id="lainnya">Lainnya(...........................................................)</td>
            </tr>
            <tr style="border-top:1px solid;">
                <td width="100">Tujuan</td>
                <td>:</td>
                <td colspan="3" id="field_deliver_to"></td>
            </tr>
            <tr style="border-top:1px solid;">
                <td width="100">Tanggal</td>
                <td>:</td>
                <td colspan="3" id="field_tgl_surat"></td>
            </tr>
            <tr style="border-top:1px solid;">
                <td width="100">No Surat</td>
                <td>:</td>
                <td colspan="3" id="field_no_surat"></td>
            </tr>
            <tr style="border-top:1px solid;">
                <td width="100">Perihal</td>
                <td>:</td>
                <td colspan="3" id="field_perihal"></td>
            </tr>
            <tr style="border-top:1px solid;">
                <td width="100">Telepon</td>
                <td>:</td>
                <td colspan="3" id="phone" contenteditable="true"></td>
            </tr>
        </table>
        <br><br>
        <h5 align="left" id="field_tanggal"></h5>
        <table width="65%" cellspacing="10">
            <tr>
                <td>Pengirim</td>
                <td></td>
                <td>Penerima</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td id="pengirim" style="border-bottom:1px solid;" contenteditable="true" ></td>
                <td>&nbsp;</td>
                <td id="penerima" style="border-bottom:1px solid;" contenteditable="true"></td>
            </tr>
        </table>
    </div>
    <div align="center" class="row col-md-2">
        <button class="btn btn-warning" id="btn-cetak">Cetak</button>
    </div>

</body>
</html>