$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelmuzaki').DataTable( {
		"ajax": urlAPI+"/app/module/muzaki/get_muzaki.php",
		"lengthMenu": [[5, 7, 9, -1], [5, 7, 9, "All"]],
		"columns": [
			{"data": "npwz" },
          	{"data": "nama_donatur" },
          	{"data": "nik" },
			{"data": "alamat" },
			{"data": "nama_petugas" },
		]
	});

	$('#tabelmuzaki tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#npwz').val(data["npwz"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#npwz').focus();
	});

	$('#lookup_kantor').DataTable( {
		"ajax": urlAPI+"/app/module/muzaki/lookup_kantor.php",
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
	
	$('#lookup_petugas').DataTable( {
		"ajax": urlAPI+"/app/module/muzaki/lookup_petugas.php",
		"columns": [
			{"data": "kode_petugas" },
          	{"data": "nama_petugas" },
          	{"data": "no_hp" },
		]
	});

    $('#lookup_petugas tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_petugas').DataTable();
        var data = table.row( this ).data();
        $('#kode_petugas').val(data["kode_petugas"]);
        $('#nama_petugas').val(data["nama_petugas"]);
        $('.close').click();
    });

  	/* EVENT KEY ENTER */
  	$('#nama_petugas').keydown(function(e){
	    if(e.keyCode == 13){
	    	$('#alamat').focus();
	    }
	});

	$('#alamat').keydown(function(e){
	    if(e.keyCode == 13){
	    	$('#no_hp').focus();
	    }
	});

	$('#no_hp').keydown(function(e){
	    if(e.keyCode == 13){
	    	$('#kategori').focus();
	    }
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    	$('.konten').load('211_muzaki/muzaki.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveMuzaki();
    	resetForm();
    	$('.konten').load('211_muzaki/muzaki.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateMuzaki();
		resetForm();
    	$('.konten').load('211_muzaki/muzaki.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deleteMuzaki();
			resetForm();
			$('.konten').load('211_muzaki/muzaki.php');
		} else {
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
		var npwz = $('#npwz').val();
		$.getJSON(urlAPI+'/app/module/muzaki/muzaki_load.php', {aksi:aksi, npwz:npwz}, function(json) {
			$('#nama_donatur').val(json.nama_donatur);
			$('#nik').val(json.nik);
			$('#alamat').val(json.alamat);
			$('#no_hp').val(json.no_hp);
			$('#kategori').val(json.kategori);
			$('#kode_petugas').val(json.kode_petugas);
			$('#nama_petugas').val(json.nama_petugas);
			$('#no_kantor').val(json.no_kantor);
			$('#nama_kantor').val(json.nama_kantor);
			$('#kode_daerah').val(json.kode_daerah);
		});
	}

	function saveMuzaki(){
		var nama_donatur = $('#nama_donatur').val();
		var nik = $('#nik').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var kategori = $('#kategori').val();
		var status = $('#status').val();
		var kode_petugas = $('#kode_petugas').val();
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'nama_donatur':nama_donatur,
				'nik':nik,
				'alamat':alamat,
				'no_hp':no_hp,
				'kategori':kategori,
				'status':status,
				'kode_petugas':kode_petugas,
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

	function updateMuzaki(){
		var npwz = $('#npwz').val();
		var nama_donatur = $('#nama_donatur').val();
		var nik = $('#nik').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var kategori = $('#kategori').val();
		var status = $('#status').val();
		var kode_petugas = $('#kode_petugas').val();
		var no_kantor = $('#no_kantor').val();
		var kode_daerah = $('#kode_daerah').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'npwz':npwz,
				'nik':nik,
				'nama_donatur':nama_donatur,
				'alamat':alamat,
				'no_hp':no_hp,
				'kategori':kategori,
				'status':status,
				'kode_petugas':kode_petugas,
				'no_kantor':no_kantor,
				'kode_daerah':kode_daerah
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteMuzaki(){
		var npwz = $('#npwz').val();
		var kode_daerah = $('#kode_daerah').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'npwz':npwz,
				'kode_daerah':kode_daerah

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