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
    <script src="../module/227_donasi_kl/struk_donasi_kl.js" type="text/javascript"></script>
<body>
<?php
    $no_donasi = $_GET['no_donasi'];
?>

    <div class="row col-md-2"></div>
    <div class="row col-md-8" id="cetak" onload="window.print();">
        <table border="0" width="100%">
        <tr style="border-bottom:2px solid;">
            <td><h3 id="field_no_donasi"></h3></td>
            <td><h2 align="right">KUITANSI</h2></td>
        </tr>
        </table>
        
        <input type="hidden" class="form-control" size="25" name="no_donasi" id="no_donasi" value="<?php echo $no_donasi; ?>">
        <table width="100%" cellspacing="5" cellpadding="5">
            <tr>
                <td width="20"></td>
                <td>NIK</td>
                <td>:</td>
                <td id="nik"></td>
                <td align="right" rowspan="4">
                    <img src="../lib/img/lazis.png" width="135" alt="">
                </td>
            </tr>
            <tr>
                <td width="20"></td>
                <td>NPWZ</td>
                <td>:</td>
                <td id="field_npwz"></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td>MUZAKI</td>
                <td>:</td>
                <td id="field_donatur"></td>
            </tr>
            <tr>
                <td width="20"></td>
                <td>ALAMAT</td>
                <td>:</td>
                <td id="alamat"></td>
            </tr>
        </table>
        <table class="table" border="0" width="100%" cellspacing="15" cellpadding="15">
            <thead>
                <tr style="border-top:2px solid; border-bottom:2px solid;">
                    <th width="373">PROGRAM</th>
                    <th width="10"></th>
                    <th width="162">JUMLAH</th>
                </tr>
            </thead>
            <tbody id="data-here">
            <tfoot>
                <tr style="border-top:2px solid;">
                    <td>&nbsp;</td>
                    <td align="right"><b>Total:</b></td>
                    <td><b><span id="total_donasi"></span></b></td>
                </tr>
            </tfoot>
            </tbody>	
        </table>
        <h5 align="left" id="field_tanggal"></h5>
        <table width="100%">
            <tr>
                <td valign="top">
                    <br>
                    <h5 align="left" id="field_tanggal"></h5>
                    <table width="75%" cellspacing="10">
                        <tr>
                            <td>Penerima</td>
                            <td></td>
                            <td>Muzaki</td>
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
                            <td id="nama_petugas"></td>
                            <td>&nbsp;</td>
                            <td id="nama_donatur"></td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td valign="top" align="right">
                    <table width="25%">
                        <tr style="border:none;">
                            <td colspan='3' align='left' style="border:none;">Keterangan</td>
                        </tr>
                        <tr>
                            <td id="kanan" valign="top">
                                <table width="100%" class="table table-bordered table-condensed">
                                    <tr rowspan='5'>
                                        <td colspan='2' style="border:1px solid; font-size:10px;" contenteditable='true'></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="font-size:9px; border-top:1px solid;">
            <b>
            Lembaga Amil Zakat Nasional | SK. Menteri Agama RI No. 737 Tahun 2016  
            </b>
        </div>
    </div>
    <div align="center" class="row col-md-2">
        <button class="btn btn-warning" id="btn-cetak">Cetak</button>
    </div>

</body>
</html>