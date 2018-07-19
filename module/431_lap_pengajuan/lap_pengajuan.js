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

		$('#dtpj_lbg1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtpj_lbg2').datetimepicker({
			format:'YYYY-MM-DD'
		});
	});

	$("#load_pengajuan").click(function(){
        loadPengajuan();
	});

	$("#load_pengajuan_lbg").click(function(){
        loadPengajuanLembaga();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadPengajuan(){
		var dari_pj = $('#dari_pj').val();
		var sampai_pj = $('#sampai_pj').val();
		var status_pengajuan = $('#status_pengajuan').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_pengajuan/load_pengajuan.php',
            type:'POST',
            data:{dari_pj:dari_pj, sampai_pj:sampai_pj, status_pengajuan:status_pengajuan},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPengajuanLembaga(){
		var dari_pj_lbg = $('#dari_pj_lbg').val();
		var sampai_pj_lbg = $('#sampai_pj_lbg').val();
		var status_pengajuan_lbg = $('#status_pengajuan_lbg').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_pengajuan/load_pengajuan_lbg.php',
            type:'POST',
            data:{dari_pj_lbg:dari_pj_lbg, sampai_pj_lbg:sampai_pj_lbg, status_pengajuan_lbg:status_pengajuan_lbg},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}


});