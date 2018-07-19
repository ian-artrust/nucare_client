$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelkatasset').DataTable( {
		"ajax": urlAPI+"/app/module/kat_asset/get_kat_asset.php",
		"columns": [
			{"data": "kode_kat_asset" },
          	{"data": "kategori" },
		]
	});

	$('#tabelkatasset tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#kode_kat_asset').val(data["kode_kat_asset"]);
        $('#kategori').val(data["kategori"]);
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#kode_kat_asset').focus();
	});
	
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    	$('.konten').load('113_kat_asset/kat_asset.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveKatAsset();
    	resetForm();
    	$('.konten').load('113_kat_asset/kat_asset.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updateKatAsset();
		resetForm();
    	$('.konten').load('113_kat_asset/kat_asset.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteKatAsset();
		resetForm();
		$('.konten').load('113_kat_asset/kat_asset.php');
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

	function saveKatAsset(){
		var kategori = $('#kategori').val();
		$.ajax({
			url:  urlAPI+"/app/module/kat_asset/kat_asset_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'kategori':kategori
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updateKatAsset(){
		var kode_kat_asset = $('#kode_kat_asset').val();
		var kategori = $('#kategori').val();
		$.ajax({
			url:  urlAPI+"/app/module/kat_asset/kat_asset_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				'kode_kat_asset':kode_kat_asset,
				'kategori':kategori
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteKatAsset(){
		var kode_kat_asset = $('#kode_kat_asset').val();
		$.ajax({
			url:  urlAPI+"/app/module/kat_asset/kat_asset_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'kode_kat_asset':kode_kat_asset
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