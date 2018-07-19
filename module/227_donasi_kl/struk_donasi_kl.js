$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;

    $(function(){
        var no_donasi = $('#no_donasi').val();
        
        loadHeaderDonasi();

        $.ajax({
            url:urlAPI+'/app/module/donasi_kl/donasi_struk_kl.php',
            type:'POST',
            data:{no_donasi:no_donasi},
            success:function(data){
                $('#data-here').html(data);
            }
        });

    });

    function loadHeaderDonasi(){
        var no_donasi = $('#no_donasi').val();
        $.getJSON(urlAPI+'/app/module/donasi_kl/donasi_load_kl.php', {no_donasi:no_donasi}, function(json) {
			$('#field_no_donasi').text(json.no_donasi);
            $('#field_npwz').text(json.npwz);
            $('#nik').text(json.nik);
            $('#field_donatur').text(json.nama_donatur);
            $('#alamat').text(json.alamat);
            $('#nama_petugas').text(json.nama_petugas);
            $('#nama_donatur').text(json.nama_donatur);
			$('#field_tanggal').text("Banyumas, "+json.tgl_donasi);
			$('#total_donasi').text(formatMataUang(json.jml_donasi));
		});
    }

    function formatMataUang(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    $("#btn-cetak").click(function(){
        $('#cetak').printArea();
    });
});