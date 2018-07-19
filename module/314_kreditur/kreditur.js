$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelkreditur').DataTable( {
		"ajax": urlAPI+"/app/module/kreditur/get_kreditur.php",
		"columns": [
			{"data": "kode_kreditur" },
          	{"data": "nama_kreditur" },
          	{"data": "no_hp" },
		]
	});

	$('#tabelkreditur tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#kode_kreditur').val(data["kode_kreditur"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#kode_kreditur').focus();
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    	
    });

    /* SAVE */
    $('#save').click(function(){
    	saveUser();
    	resetForm();
    	$('.konten').load('314_kreditur/kreditur.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateUser();
		resetForm();
    	$('.konten').load('314_kreditur/kreditur.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteUser();
		resetForm();
		$('.konten').load('314_kreditur/kreditur.php');
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
		var kode_kreditur = $('#kode_kreditur').val();
		$.getJSON(urlAPI+'/app/module/kreditur/kreditur_load.php', {aksi:aksi, kode_kreditur:kode_kreditur}, function(json) {
			$('#nama_kreditur').val(json.nama_kreditur);
			$('#alamat').val(json.alamat);
			$('#no_hp').val(json.no_hp);
		});
	}

	function saveUser(){
		var nama_kreditur = $('#nama_kreditur').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		$.ajax({
			url:  urlAPI+"/app/module/kreditur/kreditur_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'nama_kreditur':nama_kreditur,
				'alamat':alamat,
				'no_hp':no_hp
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updateUser(){
		var kode_kreditur = $('#kode_kreditur').val();
		var nama_kreditur = $('#nama_kreditur').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		$.ajax({
			url:  urlAPI+"/app/module/kreditur/kreditur_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'kode_kreditur':kode_kreditur,
				'nama_kreditur':nama_kreditur,
				'alamat':alamat,
				'no_hp':no_hp
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteUser(){
		var kode_kreditur = $('#kode_kreditur').val();
		$.ajax({
			url:  urlAPI+"/app/module/kreditur/kreditur_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'kode_kreditur':kode_kreditur
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