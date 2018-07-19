$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode_kas.php';

	$(function () {        
		$.getJSON(urlGetCombo,function(json){
			$('#periode').html('');
			$.each(json, function(index, row) {
				$('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
			});
		});
	});

	$("#load_lpk").click(function(){
        loadLPK();
	});

	$("#load_lpd").click(function(){
        loadLPD();
	});

	$("#load_lak").click(function(){
        loadLAK();
    });
    
    $("#load_lakl").click(function(){
        loadLAKL();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadLPK(){
        var periode = $('#periode').val();
		$.ajax({
            url:urlAPI+'/app/module/lpk/lpk.php',
            type:'POST',
            data:{periode:periode},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadLPD(){
        var periode = $('#periode').val();
		$.ajax({
            url:urlAPI+'/app/module/lpd/lpd.php',
            type:'POST',
            data:{periode:periode},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadLAK(){
        var periode = $('#periode').val();
		$.ajax({
            url:urlAPI+'/app/module/lak/lak.php',
            type:'POST',
            data:{periode:periode},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }
    
    function loadLAKL(){
        var periode = $('#periode').val();
		$.ajax({
            url:urlAPI+'/app/module/lakl/lakl.php',
            type:'POST',
            data:{periode:periode},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});