$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
	
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode_kas.php';

	$(function () {        
		/** Combobox Periode Ajax */
		    $.getJSON(urlGetCombo,function(json){
			$('#periode_ju').html('');
			$.each(json, function(index, row) {
				$('#periode_ju').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
            
            $.getJSON(urlGetCombo,function(json){
                $('#periode_jp').html('');
                $.each(json, function(index, row) {
                    $('#periode_jp').append('<option value='+row.periode+'>'+row.periode+'</option>');
                });
            });
        });
	});

	$("#load_ju").click(function(){
        loadJU();
    });
    
    $("#load_jp").click(function(){
        loadJP();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadJU(){
        var periode_ju = $('#periode_ju').val();
		$.ajax({
            url:urlAPI+'/app/module/jurnal/ju.php',
            type:'POST',
            data:{periode_ju:periode_ju},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }
    
    function loadJP(){
        var periode_jp = $('#periode_jp').val();
		$.ajax({
            url:urlAPI+'/app/module/jurnal/jp.php',
            type:'POST',
            data:{periode_jp:periode_jp},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});