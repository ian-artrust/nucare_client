$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
	
	var urlGetCombo     = urlAPI+'/app/lib/combo_periode_kas.php';
	var urlGetComboAkun = urlAPI+'/app/lib/combo_akun.php';

	$(function () {        
		$.getJSON(urlGetCombo,function(json){
			$('#periode').html('');
			$.each(json, function(index, row) {
				$('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
			});
		});

		$.getJSON(urlGetCombo,function(json){
			$('#periode_bb').html('');
			$.each(json, function(index, row) {
				$('#periode_bb').append('<option value='+row.periode+'>'+row.periode+'</option>');
			});
		});

		$.getJSON(urlGetComboAkun,function(json){
			$('#akun').html('');
			$.each(json, function(index, row) {
				$('#akun').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
			});
		});
	});

	$("#load_bb").click(function(){
        loadBB();
	});

	$("#load_all_bb").click(function(){
        loadAllBB();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadBB(){
		var periode = $('#periode').val();
		var akun 	= $('#akun').val();
		$.ajax({
            url:urlAPI+'/app/module/buku_besar/bb.php',
            type:'POST',
            data:{periode:periode, akun:akun},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadAllBB(){
		var periode_bb = $('#periode_bb').val();
		var akun 	= $('#akun').val();
		$.ajax({
            url:urlAPI+'/app/module/buku_besar/all_bb.php',
            type:'POST',
            data:{periode_bb:periode_bb},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});