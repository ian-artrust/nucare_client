$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;

    $(function(){       
        var npwz = $('#npwz').val();

        loadMuzaki();
        loadTotalZakat();
        loadTotalInfaq();

        $.ajax({
            url:urlAPI+'/app/module/rekap_kasir/print_kartu.php',
            type:'POST',
            data:{npwz:npwz},
            success:function(data){
                $('#data-zakat').html(data);
            }
        });

        $.ajax({
            url:urlAPI+'/app/module/rekap_kasir/print_kartu_infaq.php',
            type:'POST',
            data:{npwz:npwz},
            success:function(data){
                $('#data-infaq').html(data);
            }
        });

    });

    function loadTotalZakat(){
        var npwz = $('#npwz').val();
        $.getJSON(urlAPI+'/app/module/rekap_kasir/total_zakat_load.php',{npwz:npwz}, function(json) {
			$('#total_zakat').text(formatMataUang(json.total));
		});
    }

    function loadTotalInfaq(){
        var npwz = $('#npwz').val();
        $.getJSON(urlAPI+'/app/module/rekap_kasir/total_infaq_load.php',{npwz:npwz}, function(json) {
			$('#total_infaq').text(formatMataUang(json.total));
		});
    }

    function loadMuzaki(){
        var npwz = $('#npwz').val();
        $.getJSON(urlAPI+'/app/module/rekap_kasir/muzaki_load.php', {npwz:npwz}, function(json) {
			$('#nama_muzaki').text(json.nama_donatur);
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