$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        }); 
    });

    function cetak(){
        var tgl_donasi = $('#tgl_donasi').val();
        $('.konten').load('225_setoran_zisr/print_zisr.php','tgl_donasi='+tgl_donasi);
    }

    $('#reset').click(function(){
        $('.konten').load('225_setoran_zisr/setoran_zisr.php');
    });

    $('#cetak').click(function(){
        cetak();
    });

});