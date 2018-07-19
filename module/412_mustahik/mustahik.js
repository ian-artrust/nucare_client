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
		"ajax": urlAPI+"/app/module/mustahik/lookup_provinsi.php",
		"columns": [
			{"data": "id_prov" },
			  {"data": "provinsi" },
		]
	});

	$('#lk_kabkota').click(function(){

		$('#lookup_kabkota').DataTable( {
			"ajax": {
				"url"	: urlAPI + "/app/module/mustahik/lookup_kabkota.php",
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
				"url":urlAPI+"/app/module/mustahik/lookup_kec.php",
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
				"url":urlAPI+"/app/module/mustahik/lookup_desa.php",
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
		"ajax": urlAPI+"/app/module/mustahik/get_mustahik.php",
		"lengthMenu": [[5, 7, 9, -1], [5, 7, 9, "All"]],
		"pagingType": "numbers",
		"columns": [
			{"data": "no_registrasi" },
          	{"data": "nama_mustahik" },
          	{"data": "nik" },
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
    	$('.konten').load('412_mustahik/mustahik.php');
    });

    /* SAVE */
    $('#save').click(function(){
    	saveMustahik();
    	resetForm();
    	$('.konten').load('412_mustahik/mustahik.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
		updateMustahik();
    	$('.konten').load('412_mustahik/mustahik.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteMustahik();
		$('.konten').load('412_mustahik/mustahik.php');
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
		$.getJSON(urlAPI+'/app/module/mustahik/mustahik_load.php', {aksi:aksi, no_registrasi:no_registrasi}, function(json) {
			$('#nama_mustahik').val(json.nama_mustahik);
			$('#no_kk').val(json.no_kk);
			$('#nik').val(json.nik);
			$('#tmp_lahir').val(json.tmp_lahir);
			$('#tgl_lahir').val(json.tgl_lahir);
			$('#agama').val(json.agama);
			$('#no_hp').val(json.no_hp);
			$('#alamat').val(json.alamat);
			$('#prov').val(json.prov);
			$('#kab_kota').val(json.kab_kota);
			$('#kec').val(json.kec);
			$('#desa').val(json.desa);
			$('#nama_prov').val(json.nama_prov);
			$('#nama_kab_kota').val(json.nama_kab_kota);
			$('#nama_kec').val(json.nama_kec);
			$('#nama_desa').val(json.nama_desa);

		});
	}

	function saveMustahik(){
		var nama_mustahik = $('#nama_mustahik').val();
		var no_kk = $('#no_kk').val();
		var nik = $('#nik').val();
		var tmp_lahir = $('#tmp_lahir').val();
		var tgl_lahir = $('#tgl_lahir').val();
		var agama = $('#agama').val();
		var no_hp = $('#no_hp').val();
		var alamat = $('#alamat').val();
		var prov = $('#prov').val();
		var kab_kota = $('#kab_kota').val();
		var kec = $('#kec').val();
		var desa = $('#desa').val();
		$.ajax({
			url:  urlAPI+"/app/module/mustahik/mustahik_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				nama_mustahik:nama_mustahik,
				no_kk:no_kk,
				nik:nik,
				tmp_lahir:tmp_lahir,
				tgl_lahir:tgl_lahir,
				agama:agama,
				no_hp:no_hp,
				alamat:alamat,
				prov:prov,
				kab_kota:kab_kota,
				kec:kec,
				desa:desa
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
		var nama_mustahik = $('#nama_mustahik').val();
		var no_kk = $('#no_kk').val();
		var nik = $('#nik').val();
		var tmp_lahir = $('#tmp_lahir').val();
		var tgl_lahir = $('#tgl_lahir').val();
		var agama = $('#agama').val();
		var no_hp = $('#no_hp').val();
		var alamat = $('#alamat').val();
		var prov = $('#prov').val();
		var kab_kota = $('#kab_kota').val();
		var kec = $('#kec').val();
		var desa = $('#desa').val();
		$.ajax({
			url:  urlAPI+"/app/module/mustahik/mustahik_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'update',
				no_registrasi:no_registrasi,
				nama_mustahik:nama_mustahik,
				no_kk:no_kk,
				nik:nik,
				tmp_lahir:tmp_lahir,
				tgl_lahir:tgl_lahir,
				agama:agama,
				no_hp:no_hp,
				alamat:alamat,
				prov:prov,
				kab_kota:kab_kota,
				kec:kec,
				desa:desa
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
			url:  urlAPI+"/app/module/mustahik/mustahik_delete.php",
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