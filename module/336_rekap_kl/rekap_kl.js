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

        $('#lookup_kantor').DataTable( {
            "ajax": urlAPI+"/app/module/rekap_kl/lookup_kantor.php",
            "columns": [
                {"data": "no_kantor" },
                  {"data": "nama_kantor" },
                  {"data": "pimpinan" },
            ]
        });

        $('#lookup_kantor tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kantor').DataTable();
            var data = table.row( this ).data();
            $('#no_kantor').val(data["no_kantor"]);
            $('#nama_kantor').val(data["nama_kantor"]);
            $('.close').click();
        });
	});

	$("#load_penerimaan").click(function(){
        loadPenerimaan();
	});

	$("#load_kl").click(function(){
        loadKantorLayanan();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadPenerimaan(){
		var dari_tgl = $('#dari').val();
        var sampai_tgl = $('#sampai').val();
        var no_kantor = $('#no_kantor').val();
        var nama_kantor = $('#nama_kantor').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_kl/load_penerimaan_kl.php',
            type:'POST',
            data:{dari_tgl:dari_tgl, sampai_tgl:sampai_tgl,no_kantor:no_kantor,nama_kantor:nama_kantor},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }
    
    function loadKantorLayanan(){
		$.ajax({
            url:urlAPI+'/app/module/rekap_kl/load_kl.php',
            type:'POST',
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}

	function loadPenerimaanProgram(){
		var dari_prog_tgl = $('#dari_prog').val();
		var sampai_prog_tgl = $('#sampai_prog').val();
		var program = $('#program').val();
		$.ajax({
            url:urlAPI+'/app/module/rekap_kl/load_penerimaan_program.php',
            type:'POST',
            data:{dari_prog_tgl:dari_prog_tgl, sampai_prog_tgl:sampai_prog_tgl,program:program},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}


});