$(document).ready(function() {
	resetForm();
	var table;

	var server = $('#server').val();
	var urlAPI = server;
	table = $('#tabelpetugas').DataTable( {
		"ajax": urlAPI+"/app/module/petugas/get_petugas.php",
		"columns": [
			{"data": "kode_petugas" },
          	{"data": "nama_petugas" },
          	{"data": "nama_kantor" },
          	{"data": "no_hp" },
		]
	});

	$('#tabelpetugas tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#kode_petugas').val(data["kode_petugas"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#kode_petugas').focus();
	});

	$('#lookup_kantor').DataTable( {
		"ajax": urlAPI+"/app/module/petugas/lookup_kantor.php",
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
    	saveUser();
    	resetForm();
    	$('.konten').load('112_petugas/petugas.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateUser();
		resetForm();
    	$('.konten').load('112_petugas/petugas.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deleteUser();
			resetForm();
			$('.konten').load('112_petugas/petugas.php');
		}else{
			return false;
		}

	});

    /* CUSTOM FUNCTION */
	function resetForm()
	{
		$('#save').removeAttr('disabled');
		$('#password').removeAttr('disabled');
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
		$('#password').attr('disabled', 'disabled');
		$.getJSON(urlAPI+'/app/module/petugas/petugas_load.php', {aksi:aksi, kode_petugas:kode_petugas}, function(json) {
			$('#nama_petugas').val(json.nama_petugas);
			$('#alamat').val(json.alamat);
			$('#no_hp').val(json.no_hp);
            $('#level').val(json.level);
            $('#email').val(json.email);
			$('#username').val(json.username);
			$('#password').val(json.password);
			$('#no_kantor').val(json.no_kantor);
			$('#nama_kantor').val(json.nama_kantor);
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
		var no_kantor = $('#no_kantor').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/petugas/petugas_save.php",
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

	function updateUser(){
		var kode_petugas = $('#kode_petugas').val();
		var nama_petugas = $('#nama_petugas').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
        var level = $('#level').val();
        var email = $('#email').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var no_kantor = $('#no_kantor').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/petugas/petugas_update.php",
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

	function deleteUser(){
		var kode_petugas = $('#kode_petugas').val();
		$.ajax({
			url:  urlAPI+"/app/module/petugas/petugas_delete.php",
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