$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode_kas.php';
    var urlGetComboKas     = urlAPI+'/app/module/lap_kas/combo_kas.php';

	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#datetimepicker2').datetimepicker({
			format:'YYYY-MM-DD'
        });
        
		/** Combobox Periode Ajax */
		$.getJSON(urlGetCombo,function(json){
			$('#periode_kas').html('');
			$.each(json, function(index, row) {
				$('#periode_kas').append('<option value='+row.periode+'>'+row.periode+'</option>');
			});
        });
        
        $.getJSON(urlGetComboKas,function(json){
			$('#kas_tgl').html('');
			$.each(json, function(index, row) {
				$('#kas_tgl').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
			});
        });
        
        $.getJSON(urlGetComboKas,function(json){
			$('#kas').html('');
			$.each(json, function(index, row) {
				$('#kas').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
			});
		});
	});

	$("#load_kas_harian").click(function(){
        loadKasHarian();
	});

	$("#load_kas_periode").click(function(){
        loadKasPeriode();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadKasHarian(){
		var dari_tgl = $('#dari').val();
        var sampai_tgl = $('#sampai').val();
        var kas_tgl = $('#kas_tgl').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_kas/load_kas_harian.php',
            type:'POST',
            data:{dari_tgl:dari_tgl, sampai_tgl:sampai_tgl, kas_tgl:kas_tgl},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadKasPeriode(){
		var periode_kas = $('#periode_kas').val();
        var kas = $('#kas').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_kas/load_kas_periode.php',
            type:'POST',
            data:{periode_kas:periode_kas, kas:kas},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});