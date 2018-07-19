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
			{"data": "no_hp" },
			{"data": "nama_petugas" },
			{"data": "nama_kantor" },
			{"data": "no_kantor" },
		],
		"columnDefs": [
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            }
        ]
	});

	$('#tabelmuzaki tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
		$('#npwz').val(data["npwz"]);
		$('#no_kantor').val(data["no_kantor"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#npwz').focus();
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
    	$('.konten').load('211_muzaki_kl/muzaki_kl.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveMuzaki();
    	resetForm();
    	$('.konten').load('211_muzaki_kl/muzaki_kl.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateMuzaki();
		resetForm();
    	$('.konten').load('211_muzaki_kl/muzaki_kl.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deleteMuzaki();
			resetForm();
			$('.konten').load('211_muzaki_kl/muzaki_kl.php');
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
		});
	}

	function saveMuzaki(){
		var nama_donatur = $('#nama_donatur').val();
		var nik = $('#nik').val();
		var alamat = $('#alamat').val();
		var no_hp = $('#no_hp').val();
		var kategori = $('#kategori').val();
		var status = $('#status').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_save_kl.php",
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
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_update_kl.php",
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
				'no_kantor':no_kantor,
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
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/muzaki/muzaki_delete_kl.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'npwz':npwz,
				'no_kantor':no_kantor,
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