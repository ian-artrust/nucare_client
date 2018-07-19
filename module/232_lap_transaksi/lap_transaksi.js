$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
	var urlGetCombo     = urlAPI+'/app/lib/combo_program.php';

	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#datetimepicker2').datetimepicker({
			format:'YYYY-MM-DD'
		});

		$('#dtbank1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtbank2').datetimepicker({
			format:'YYYY-MM-DD'
		});

		$('#dtprog1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtprog2').datetimepicker({
			format:'YYYY-MM-DD'
		});

			/** Combobox Periode Ajax */
		$.getJSON(urlGetCombo,function(json){
			$('#program').html('');
			$.each(json, function(index, row) {
				$('#program').append('<option value='+row.kode_prg_pnr+'>'+row.program+'</option>');
			});
		});
	});

	$("#load_penerimaan").click(function(){
        loadPenerimaan();
	});

	$("#load_penerimaan_bank").click(function(){
        loadPenerimaanBank();
	});

	$("#load_penerimaan_program").click(function(){
        loadPenerimaanProgram();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadPenerimaan(){
		var dari_tgl = $('#dari').val();
		var sampai_tgl = $('#sampai').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_transaksi/load_penerimaan.php',
            type:'POST',
            data:{dari_tgl:dari_tgl, sampai_tgl:sampai_tgl},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPenerimaanBank(){
		var dari_bank_tgl = $('#dari_bank').val();
		var sampai_bank_tgl = $('#sampai_bank').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_transaksi/load_penerimaan_bank.php',
            type:'POST',
            data:{dari_bank_tgl:dari_bank_tgl, sampai_bank_tgl:sampai_bank_tgl},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPenerimaanProgram(){
		var dari_prog = $('#dari_prog').val();
		var sampai_prog = $('#sampai_prog').val();
		var program = $('#program').val();
		$.ajax({
            url:urlAPI+'/app/module/lap_transaksi/load_penerimaan_program.php',
            type:'POST',
            data:{dari_prog:dari_prog, sampai_prog:sampai_prog, program:program},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}


});