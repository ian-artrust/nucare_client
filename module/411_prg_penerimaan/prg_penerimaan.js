$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    var table;

    var urlGetComboAD     = urlAPI+'/app/module/prg_penerimaan/combo_ad.php';
    var urlGetComboAK     = urlAPI+'/app/module/prg_penerimaan/combo_ak.php';
    var urlGetComboBAD    = urlAPI+'/app/module/prg_penerimaan/combo_bad.php';
    var urlGetComboBAK    = urlAPI+'/app/module/prg_penerimaan/combo_bak.php';
    var urlGetComboKategori = urlAPI+'/app/lib/combo_kategori.php';
    $(function () {

        /** Combobox Akun Debit Ajax */
        $.getJSON(urlGetComboAD,function(json){
            $('#akun_debit').html('');
            $.each(json, function(index, row) {
                $('#akun_debit').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
            });
        });

        $.getJSON(urlGetComboAK,function(json){
            $('#akun_kredit').html('');
            $.each(json, function(index, row) {
                $('#akun_kredit').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
            });
        });

        $.getJSON(urlGetComboBAD,function(json){
            $('#akun_debit_bank').html('');
            $.each(json, function(index, row) {
                $('#akun_debit_bank').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
            });
        });

        $.getJSON(urlGetComboBAK,function(json){
            $('#akun_kredit_bank').html('');
            $.each(json, function(index, row) {
                $('#akun_kredit_bank').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
            });
        });

        $.getJSON(urlGetComboKategori,function(json){
            $('#kode_kategori').html('');
            $.each(json, function(index, row) {
                $('#kode_kategori').append('<option value='+row.kode_kategori+'>'+row.kategori+'</option>');
            });
        });

        table = $('#tabelprogram').DataTable( {
		    "ajax": urlAPI+"/app/module/prg_penerimaan/get_prg_penerimaan.php",
		    "columns": [
                {"data": "kode_prg_pnr" },
                {"data": "program" },
          	    {"data": "kategori" },
		    ]
        });

        $('#tabelprogram tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $('#kode_prg_pnr').val(data["kode_prg_pnr"]);
            loadData();
            $('#save').attr('disabled', 'disabled');
            $('#update').removeAttr('disabled');
            $('#delete').removeAttr('disabled');
            $('#program').focus();
        });
    });

    function loadData(){
		var aksi = "load";
		var kode_prg_pnr = $('#kode_prg_pnr').val();
		$.getJSON(urlAPI+'/app/module/prg_penerimaan/prg_penerimaan_load.php', {aksi:aksi, kode_prg_pnr:kode_prg_pnr}, function(json) {
			$('#program').val(json.program);
			$('#akun_debit').val(json.akun_debit);
			$('#akun_kredit').val(json.akun_kredit);
            $('#akun_debit_bank').val(json.akun_debit_bank);
            $('#akun_kredit_bank').val(json.akun_kredit_bank);
            $('#kode_kategori').val(json.kode_kategori);
            $('#status').val(json.status);
		});
	}


    function saveProgram(){
        var program = $('#program').val()
        var kode_kategori = $('#kode_kategori').val();
		var status = $('#status').val();
        var akun_debit = $('#akun_debit').val();
        var akun_debit_bank = $('#akun_debit_bank').val();
        var akun_kredit = $('#akun_kredit').val();
        var akun_kredit_bank = $('#akun_kredit_bank').val();

		$.ajax({
			url:  urlAPI+"/app/module/prg_penerimaan/prg_penerimaan_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                aksi:'save',
                program:program,
                kode_kategori:kode_kategori,
				status:status,
				akun_debit:akun_debit,
                akun_debit_bank:akun_debit_bank,
                akun_kredit:akun_kredit,
                akun_kredit_bank:akun_kredit_bank
			},
			success : function(data){
                alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function updateProgram(){
		var kode_prg_pnr = $('#kode_prg_pnr').val();
		var program = $('#program').val()
        var kode_kategori = $('#kode_kategori').val();
		var status = $('#status').val();
        var akun_debit = $('#akun_debit').val();
        var akun_debit_bank = $('#akun_debit_bank').val();
        var akun_kredit = $('#akun_kredit').val();
        var akun_kredit_bank = $('#akun_kredit_bank').val();
		$.ajax({
			url:  urlAPI+"/app/module/prg_penerimaan/prg_penerimaan_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'update',
                kode_prg_pnr:kode_prg_pnr,
				program:program,
                kode_kategori:kode_kategori,
				status:status,
				akun_debit:akun_debit,
                akun_debit_bank:akun_debit_bank,
                akun_kredit:akun_kredit,
                akun_kredit_bank:akun_kredit_bank
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteProgram(){
		var kode_prg_pnr = $('#kode_prg_pnr').val();
		$.ajax({
			url:  urlAPI+"/app/module/prg_penerimaan/prg_penerimaan_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'kode_prg_pnr':kode_prg_pnr
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});

	}

    function clear() {
        $("#kode_prg_pnr").val("");
		$("#program").val("");
    }

    $('#reset').click(function(){
        $('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
    });

    $('#save').click(function(){
        saveProgram();
        $('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
    });

    /* UPDATE */
    $('#update').click(function(){
    	updateProgram();
    	$('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteProgram();
		$('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
	});

});