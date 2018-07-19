$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
	
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode_kas.php';

	$(function () {        
		/** Combobox Periode Ajax */
		    $.getJSON(urlGetCombo,function(json){
			$('#periode_pyi').html('');
			$.each(json, function(index, row) {
				$('#periode_pyi').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
            
            $.getJSON(urlGetCombo,function(json){
                $('#periode_jp').html('');
                $.each(json, function(index, row) {
                    $('#periode_jp').append('<option value='+row.periode+'>'+row.periode+'</option>');
                });
            });
        });
	});

	$("#load_pyis").click(function(){
        loadIndividu();
    });
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadIndividu(){
        var periode_pyi = $('#periode_pyi').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_penyaluran/lap_pyl_individu.php',
            type:'POST',
            data:{periode_pyi:periode_pyi},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }
    
    function loadLembaga(){
        var periode_jp = $('#periode_jp').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_penyaluran/lap_pyl_lembaga.php',
            type:'POST',
            data:{periode_jp:periode_jp},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});