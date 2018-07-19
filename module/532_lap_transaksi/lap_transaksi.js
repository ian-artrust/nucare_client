$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;

	$(function () {
		$('#dtpj1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtpj2').datetimepicker({
			format:'YYYY-MM-DD'
		});

		$('#dtpj1_detail').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtpj2_detail').datetimepicker({
			format:'YYYY-MM-DD'
		});
	});

	$("#load_transaksi").click(function(){
        loadTransaksi();
	});

	$("#load_detail").click(function(){
        loadDetail();
	});

	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadTransaksi(){
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_transaksi/load_transaksi.php',
            type:'POST',
            data:{dari:dari, sampai:sampai},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadDetail(){
		var dari_detail = $('#dari_detail').val();
		var sampai_detail = $('#sampai_detail').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_transaksi/load_detail.php',
            type:'POST',
            data:{dari_detail:dari_detail, sampai_detail:sampai_detail},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});