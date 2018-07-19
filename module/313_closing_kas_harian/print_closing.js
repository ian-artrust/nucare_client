$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;

    $(function(){       
        var tgl_donasi = $('#tgl_donasi').val();

        loadFooter();
        loadTotal();
        loadTotalNT();

        $.ajax({
            url:urlAPI+'/app/module/closing_kas_harian/rekap_kasir_struk.php',
            type:'POST',
            data:{tgl_donasi:tgl_donasi},
            success:function(data){
                $('#data-here').html(data);
            }
        });

        $.ajax({
            url:urlAPI+'/app/module/closing_kas_harian/rekap_kasir_struk_nt.php',
            type:'POST',
            data:{tgl_donasi:tgl_donasi},
            success:function(data){
                $('#data-here-nt').html(data);
            }
        });

    });

    function loadTotal(){
        var tgl_donasi = $('#tgl_donasi').val();
        $.getJSON(urlAPI+'/app/module/closing_kas_harian/total_load.php',{tgl_donasi:tgl_donasi}, function(json) {
			$('#total_penerimaan').text(formatMataUang(json.total));
		});
    }

    function loadTotalNT(){
        var tgl_donasi = $('#tgl_donasi').val();
        $.getJSON(urlAPI+'/app/module/closing_kas_harian/total_load_nt.php',{tgl_donasi:tgl_donasi}, function(json) {
			$('#total_penerimaan_nt').text(formatMataUang(json.total));
		});
    }

    function loadFooter(){
        $.getJSON(urlAPI+'/app/module/closing_kas_harian/footer_load.php', function(json) {
			$('#kasir').text(json.nama_petugas);
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