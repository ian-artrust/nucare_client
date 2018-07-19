$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabeluser').DataTable( {
		"ajax": urlAPI+"/app/module/user/get_user.php",
		"columns": [
			{"data": "kode_petugas" },
          	{"data": "nama_petugas" },
          	{"data": "nama_daerah" }
		]
	});

	$('#tabeluser tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#kode_petugas').val(data["kode_petugas"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#kode_petugas').focus();
	});

	$('#lookup_daerah').DataTable( {
		"ajax": urlAPI+"/app/module/user/lookup_daerah.php",
		"columns": [
			{"data": "kode_daerah" },
          	{"data": "nama_daerah" },
		]
	});

    $('#lookup_daerah tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_daerah').DataTable();
        var data = table.row( this ).data();
        $('#kode_daerah').val(data["kode_daerah"]);
        $('#nama_daerah').val(data["nama_daerah"]);
        $('.close').click();
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
    	$('.konten').load('111_user/user.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateUser();
		resetForm();
    	$('.konten').load('111_user/user.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deleteUser();
			resetForm();
			$('.konten').load('111_user/user.php');
		}else{
			return false;
		}

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
		var kode_petugas = $('#kode_petugas').val();
		$.getJSON(urlAPI+'/app/module/user/user_load.php', {aksi:aksi, kode_petugas:kode_petugas}, function(json) {
			$('#nama_petugas').val(json.nama_petugas);
			$('#alamat').val(json.alamat);
			$('#no_hp').val(json.no_hp);
			$('#level').val(json.level);
			$('#email').val(json.email);
			$('#username').val(json.username);
			$('#password').val(json.password);
			$('#no_kantor').val(json.no_kantor);
			$('#nama_kantor').val(json.nama_kantor);
			$('#kode_daerah').val(json.kode_daerah);
			$('#nama_daerah').val(json.nama_daerah);
		});
	}

	function saveUser(){
		var nama_petugas = $('#nama_petugas').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var level = $('#level').val();
		var email = $('#email').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var kode_daerah = $('#kode_daerah').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/user/user_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'nama_petugas':nama_petugas,
				'alamat':alamat,
				'no_hp':no_hp,
				'level':level,
				'email':email,
				'username':username,
				'password':password,
				'kode_daerah':kode_daerah,
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

	function updateUser(){
		var kode_petugas = $('#kode_petugas').val();
		var nama_petugas = $('#nama_petugas').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var level = $('#level').val();
		var email = $('#email').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var kode_daerah = $('#kode_daerah').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/user/user_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'kode_petugas':kode_petugas,
				'nama_petugas':nama_petugas,
				'alamat':alamat,
				'no_hp':no_hp,
				'level':level,
				'email':email,
				'username':username,
				'password':password,
				'kode_daerah':kode_daerah,
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

	function deleteUser(){
		var kode_petugas = $('#kode_petugas').val();
		$.ajax({
			url:  urlAPI+"/app/module/user/user_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'kode_petugas':kode_petugas
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