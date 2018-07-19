$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	  
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelbank').DataTable( {
		"ajax": urlAPI+"/app/module/bank/get_bank.php",
		"columns": [
			{"data": "no_rekening" },
          	{"data": "nama_bank" },
          	{"data": "akun" },
		]
	});

	$('#tabelbank tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#no_rekening').val(data["no_rekening"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_rekening').focus();
	});

	$('#lookup_akun').DataTable( {
		"ajax": urlAPI+"/app/module/bank/lookup_akun.php",
		"columns": [
			{"data": "kode_akun" },
			{"data": "akun" },
			{"data": "jenis" },
		]
	});

    $('#lookup_akun tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_akun').DataTable();
        var data = table.row( this ).data();
        $('#kode_akun').val(data["kode_akun"]);
        $('#akun').val(data["akun"]);
        $('.close').click();
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    	
    });

    /* SAVE */
    $('#save').click(function(){
    	saveBank();
    	resetForm();
    	$('.konten').load('311_bank/bank.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateBank();
		resetForm();
    	$('.konten').load('311_bank/bank.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteBank();
		resetForm();
		$('.konten').load('311_bank/bank.php');
	});

    /* CUSTOM FUNCTION */
	function resetForm()
	{
		$('#save').removeAttr('disabled');
		$('#update').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('input[type=text]').each(function(){
			$(this).val("");
		});
	}

	function loadData(){
		var aksi = "load";
		var no_rekening = $('#no_rekening').val();
		$.getJSON(urlAPI+'/app/module/bank/bank_load.php', {aksi:aksi, no_rekening:no_rekening}, function(json) {
			$('#nama_bank').val(json.nama_bank);
			$('#kode_akun').val(json.kode_akun);
			$('#akun').val(json.akun);
		});
	}

	function saveBank(){
		var no_rekening = $('#no_rekening').val();
		var nama_bank = $('#nama_bank').val();
		var status = $('#status').val();
		var kode_akun = $('#kode_akun').val();
		$.ajax({
			url:  urlAPI+"/app/module/bank/bank_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'no_rekening':no_rekening,
				'nama_bank':nama_bank,
				'status':status,
				'kode_akun':kode_akun
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updateBank(){
		var no_rekening = $('#no_rekening').val();
		var nama_bank = $('#nama_bank').val();
		var status = $('#status').val();
		var kode_akun = $('#kode_akun').val();
		$.ajax({
			url:  urlAPI+"/app/module/bank/bank_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'no_rekening':no_rekening,
				'nama_bank':nama_bank,
				'status':status,
				'kode_akun':kode_akun
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteBank(){
		var no_rekening = $('#no_rekening').val();
		$.ajax({
			url:  urlAPI+"/app/module/bank/bank_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'no_rekening':no_rekening
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});

	}
});