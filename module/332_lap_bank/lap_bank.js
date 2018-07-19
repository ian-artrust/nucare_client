$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
	
    var urlGetCombo     = urlAPI+'/app/lib/combo_bank.php';

	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#datetimepicker2').datetimepicker({
			format:'YYYY-MM-DD'
        });
        
		/** Combobox Periode Ajax */      
        $.getJSON(urlGetCombo,function(json){
			$('#bank').html('');
			$.each(json, function(index, row) {
				$('#bank').append('<option value='+row.no_rekening+'>'+row.nama_bank+'</option>');
			});
        });
	});

	$("#load_bank").click(function(){
        loadBank();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadBank(){
		var dari_tgl = $('#dari').val();
        var sampai_tgl = $('#sampai').val();
        var no_rekening = $('#bank').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_bank/load_bank.php',
            type:'POST',
            data:{dari_tgl:dari_tgl, sampai_tgl:sampai_tgl, no_rekening:no_rekening},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});