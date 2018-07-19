$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelkantor').DataTable( {
		"ajax": urlAPI+"/app/module/kl/get_kl.php",
		"lengthMenu": [[5, 7, 9, -1], [5, 7, 9, "All"]],
		"columns": [
			{"data": "no_kantor" },
          	{"data": "nama_kantor" },
			{"data": "phone" },
			{"data": "pimpinan" },
		]
	});

	$('#tabelkantor tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#no_kantor').val(data["no_kantor"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_kantor').focus();
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
		resetForm();
		$('.konten').load('114_kl/kantor_layanan.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveKantorLayanan();
    	resetForm();
    	$('.konten').load('114_kl/kantor_layanan.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateKantorLayanan();
		resetForm();
    	$('.konten').load('114_kl/kantor_layanan.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteKantorLayanan();
		resetForm();
		$('.konten').load('114_kl/kantor_layanan.php');
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

		$('input[type=password]').each(function(){
			$(this).val("");
		});
	}

	function loadData(){
		var aksi = "load";
		var no_kantor = $('#no_kantor').val();
		$.getJSON(urlAPI+'/app/module/kl/kl_load.php', {aksi:aksi, no_kantor:no_kantor}, function(json) {
			$('#nama_kantor').val(json.nama_kantor);
			$('#no_hp').val(json.phone);
			$('#pimpinan').val(json.pimpinan);
			$('#alamat').val(json.alamat);
		});
	}

	function saveKantorLayanan(){
		var nama_kantor = $('#nama_kantor').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var pimpinan = $('#pimpinan').val();
		$.ajax({
			url:  urlAPI+"/app/module/kl/kl_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'nama_kantor':nama_kantor,
				'alamat':alamat,
				'no_hp':no_hp,
				'pimpinan':pimpinan
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updateKantorLayanan(){
		var no_kantor = $('#no_kantor').val();
		var nama_kantor = $('#nama_kantor').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var pimpinan = $('#pimpinan').val();
		$.ajax({
			url:  urlAPI+"/app/module/kl/kl_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'no_kantor':no_kantor,
				'nama_kantor':nama_kantor,
				'alamat':alamat,
				'no_hp':no_hp,
				'pimpinan':pimpinan
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteKantorLayanan(){
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/kl/kl_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
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
});