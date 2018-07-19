$(document).ready(function() {
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	  
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelbank').DataTable( {
		"ajax": urlAPI+"/app/module/bank_kl/get_bank_kl.php",
		"columns": [
			{"data": "no_rekening" },
          	{"data": "nama_bank" },
          	{"data": "phone" },
		]
	});

	$('#tabelbank tbody').on('click', 'tr', function () {
		var data = table.row(this).data();
        $('#no_rekening').val(data["no_rekening"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_rekening').focus();
	});

	$('#lookup_kantor').DataTable( {
		"ajax": urlAPI+"/app/module/bank_kl/lookup_kantor.php",
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

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
    	saveBank();
    	resetForm();
    	$('.konten').load('312_bank_kl/bank_kl.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateBank();
		resetForm();
    	$('.konten').load('312_bank_kl/bank_kl.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteBank();
		resetForm();
		$('.konten').load('312_bank_kl/bank_kl.php');
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
		$('.konten').load('312_bank_kl/bank_kl.php');
	}

	function loadData(){
		var aksi = "load";
		var no_rekening = $('#no_rekening').val();
		$.getJSON(urlAPI+'/app/module/bank_kl/bank_load_kl.php', {aksi:aksi, no_rekening:no_rekening}, function(json) {
			$('#nama_bank').val(json.nama_bank);
			$('#no_kantor').val(json.no_kantor);
			$('#nama_kantor').val(json.nama_kantor);
		});
	}

	function saveBank(){
		var no_rekening = $('#no_rekening').val();
		var nama_bank = $('#nama_bank').val();
		var no_kantor = $('#no_kantor').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/bank_kl/bank_save_kl.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'no_rekening':no_rekening,
				'nama_bank':nama_bank,
				'no_kantor':no_kantor,
				'status':status
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
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/bank_kl/bank_update_kl.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'no_rekening':no_rekening,
				'nama_bank':nama_bank,
				'status':status,
				'no_kantor':no_kantor
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
			url:  urlAPI+"/app/module/bank_kl/bank_delete_kl.php",
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