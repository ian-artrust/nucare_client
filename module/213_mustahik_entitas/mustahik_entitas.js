$(document).ready(function() {
	var table;
	var server = $('#server').val();
	var urlAPI = server;

	$(function () {
        $('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	});

	$('#lookup_provinsi').DataTable( {
		"ajax": urlAPI+"/app/module/mustahik_entitas/lookup_provinsi.php",
		"columns": [
			{"data": "id_prov" },
			  {"data": "provinsi" },
		]
	});

	$('#lk_kabkota').click(function(){

		$('#lookup_kabkota').DataTable( {
			"ajax": {
				"url"	: urlAPI + "/app/module/mustahik_entitas/lookup_kabkota.php",
				"type"	: 'POST',
				"data"	: function ( d ) {
					d.prov = $('#prov').val();
				}
			},
			"columns": [
				{"data": "id_kab" },
				{"data": "kab_kota" },
			]
		});

	});
	
	$('#lk_kec').click(function(){

		$('#lookup_kec').DataTable( {
			"ajax": {
				"url":urlAPI+"/app/module/mustahik_entitas/lookup_kec.php",
				"type"	: 'POST',
				"data"	: function ( d ) {
					d.kab_kota = $('#kab_kota').val();
				}
			},
			"columns": [
				{"data": "id_kec" },
				{"data": "kecamatan" },
			]
		});

	});

	$('#lk_desa').click(function(){

		$('#lookup_desa').DataTable( {
			"ajax": {
				"url":urlAPI+"/app/module/mustahik_entitas/lookup_desa.php",
				"type"	: 'POST',
				"data"	: function ( d ) {
					d.kec = $('#kec').val();
				}
			},
			"columns": [
				{"data": "id_desa" },
				{"data": "desa" },
			]
		});

	});

	$('#lookup_provinsi tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_provinsi').DataTable();
        var data = table.row( this ).data();
        $('#prov').val(data["id_prov"]);
        $('#nama_prov').val(data["provinsi"]);
        $('.close').click();
	});
	
	$('#lookup_kabkota tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_kabkota').DataTable();
        var data = table.row( this ).data();
        $('#kab_kota').val(data["id_kab"]);
        $('#nama_kab_kota').val(data["kab_kota"]);
        $('.close').click();
	});
	
	$('#lookup_kec tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_kec').DataTable();
        var data = table.row( this ).data();
        $('#kec').val(data["id_kec"]);
        $('#nama_kec').val(data["kecamatan"]);
        $('.close').click();
	});
	
	$('#lookup_desa tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_desa').DataTable();
        var data = table.row( this ).data();
        $('#desa').val(data["id_desa"]);
        $('#nama_desa').val(data["desa"]);
        $('.close').click();
    });

	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelmustahik').DataTable( {
		"ajax": urlAPI+"/app/module/mustahik_entitas/get_mustahik_entitas.php",
		"lengthMenu": [[5, 7, 9, -1], [5, 7, 9, "All"]],
		"columns": [
			{"data": "no_registrasi" },
          	{"data": "nama_lembaga" },
          	{"data": "no_hp" },
		]
	});

	$('#tabelmustahik tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#no_registrasi').val(data["no_registrasi"]);
		loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    	$('.konten').load('213_mustahik_entitas/mustahik_entitas.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveMustahik();
    	resetForm();
    	$('.konten').load('213_mustahik_entitas/mustahik_entitas.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
		updateMustahik();
    	$('.konten').load('213_mustahik_entitas/mustahik_entitas.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteMustahik();
		$('.konten').load('213_mustahik_entitas/mustahik_entitas.php');
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
		var no_registrasi = $('#no_registrasi').val();
		$.getJSON(urlAPI+'/app/module/mustahik_entitas/mustahik_entitas_load.php', {aksi:aksi, no_registrasi:no_registrasi}, function(json) {
			$('#nama_lembaga').val(json.nama_lembaga);
			$('#no_hp').val(json.no_hp);
			$('#no_sk').val(json.no_sk);
			$('#alamat').val(json.alamat);

		});
	}

	function saveMustahik(){
		var nama_lembaga = $('#nama_lembaga').val();
		var no_hp = $('#no_hp').val();
		var no_sk = $('#no_sk').val();
		var alamat = $('#alamat').val();
		$.ajax({
			url:  urlAPI+"/app/module/mustahik_entitas/mustahik_entitas_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				nama_lembaga:nama_lembaga,
				no_hp:no_hp,
				no_sk:no_sk,
				alamat:alamat
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updateMustahik(){
		var no_registrasi = $('#no_registrasi').val();
		var nama_lembaga = $('#nama_lembaga').val();
		var no_hp = $('#no_hp').val();
		var no_sk = $('#no_sk').val();
		var alamat = $('#alamat').val();
		$.ajax({
			url:  urlAPI+"/app/module/mustahik_entitas/mustahik_entitas_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				no_registrasi:no_registrasi,
				nama_lembaga:nama_lembaga,
				no_hp:no_hp,
				no_sk:no_sk,
				alamat:alamat
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteMustahik(){
		var no_registrasi = $('#no_registrasi').val();
		$.ajax({
			url:  urlAPI+"/app/module/mustahik_entitas/mustahik_entitas_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'no_registrasi':no_registrasi
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