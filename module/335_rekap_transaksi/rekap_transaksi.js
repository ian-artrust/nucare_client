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

	$('#lookup_program').DataTable( {
		"ajax": urlAPI+"/app/lib/lookup_program.php",
		"columns": [
			{"data": "kode_prg_pnr" },
			{"data": "program" },
			{"data": "kategori" },
		]
	});

	$('#lookup_program tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_program').DataTable();
        var data = table.row( this ).data();
        $('#kode_program').val(data["kode_prg_pnr"]);
        $('#nama_program').val(data["program"]);
        $('.close').click();
    });


	$("#load_transaksi").click(function(){
        loadTransaksi();
	});

	$("#load_detail").click(function(){
        loadDetail();
	});

	$("#load_penerimaan").click(function(){
        loadPenerimaan();
	});

	$("#load_program").click(function(){
        loadPenerimaanProgram();
	});

	$("#load_bank").click(function(){
        loadViaBank();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadTransaksi(){
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_transaksi/load_transaksi.php',
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
            url:urlAPI+'/app/module/rekap_transaksi/load_detail.php',
            type:'POST',
            data:{dari_detail:dari_detail, sampai_detail:sampai_detail},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPenerimaan(){
		var dari_tgl = $('#dari_detail').val();
		var sampai_tgl = $('#sampai_detail').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_transaksi/load_penerimaan.php',
            type:'POST',
            data:{dari_tgl:dari_tgl, sampai_tgl:sampai_tgl},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPenerimaanProgram(){
		var dari_prog = $('#dari_detail').val();
		var sampai_prog = $('#sampai_detail').val();
		var program = $('#kode_program').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_transaksi/load_penerimaan_program.php',
            type:'POST',
            data:{dari_prog:dari_prog, sampai_prog:sampai_prog, program:program},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadViaBank(){
		var dari_bank = $('#dari_detail').val();
		var sampai_bank = $('#sampai_detail').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_transaksi/load_penerimaan_bank.php',
            type:'POST',
            data:{dari_bank:dari_bank, sampai_bank:sampai_bank},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

});