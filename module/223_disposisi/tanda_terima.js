$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;

    $(function(){
        loadHeaderDisposisi();
    });

    function loadHeaderDisposisi(){
        var no_disposisi = $('#no_disposisi').val();
        $.getJSON(urlAPI+'/app/module/disposisi/disposisi_load.php', {no_disposisi:no_disposisi}, function(json) {
            $('#field_no_disposisi').text(json.no_disposisi);
            $('#field_pengirim').text(json.pengirim);
            $('#field_deliver_to').text(json.deliver_to);
            $('#field_tgl_surat').text(json.tgl_surat);
            $('#field_no_surat').text(json.no_surat);
            $('#field_perihal').text(json.perihal);
		});
    }

    $("#btn-cetak").click(function(){
        $('#cetak').printArea();
    });
});