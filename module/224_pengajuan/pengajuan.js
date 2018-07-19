$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	var urlGetComboPengajuan = urlAPI+'/app/lib/combo_pengajuan.php';
	var urlGetCombo     = urlAPI+'/app/lib/combo_periode.php';

	$(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        });

         /** Combobox Periode Ajax */
         $.getJSON(urlGetCombo,function(json){
            $('#periode').html('');
            $.each(json, function(index, row) {
                $('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $.getJSON(urlGetComboPengajuan,function(json){
            $('#no_master').html('');
            $.each(json, function(index, row) {
                $('#no_master').append('<option value='+row.no_master+'>'+row.nama_master+'</option>');
            });
        });

		var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#jml_pengajuan').on('input', function() {
            $('#format_jml').html(moneyFormat.to(parseInt($(this).val())));
        });
	});
	/* LOAD DATA TABLES LIBRARY */
    table = $('#tabelpengajuan').DataTable( {
        "ajax": urlAPI+"/app/module/pengajuan/get_pengajuan.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_disposisi" },
			{"data": "no_pengajuan" },
			{"data": "nama_mustahik" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_pengajuan" },
			{"data": "status" },
		]
    });

	$('#tabelpengajuan tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	table_ent = $('#tabelpengajuan_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/pengajuan/get_pengajuan_entitas.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_disposisi" },
			{"data": "no_pengajuan" },
			{"data": "nama_lembaga" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_pengajuan" },
			{"data": "status" },
		]
    });

	$('#tabelpengajuan_entitas tbody').on('click', 'tr', function () {
		resetForm();
		var data = table_ent.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	$('#lookup_mustahik').DataTable({
		"ajax": urlAPI+"/app/module/mustahik/get_mustahik.php",
		"columns": [
			{"data": "no_registrasi" },
			{"data": "nama_mustahik" },
			{"data": "nik" },
		]
	});

	$('#lookup_mustahik tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_mustahik').DataTable();
        var data = table.row( this ).data();
        $('#no_registrasi').val(data["no_registrasi"]);
        $('#nama_mustahik').val(data["nama_mustahik"]);
        $('.close').click();
	});

	$('#lookup_entitas').DataTable({
		"ajax": urlAPI+"/app/module/mustahik_entitas/get_mustahik_entitas.php",
		"columns": [
			{"data": "no_registrasi" },
			{"data": "nama_lembaga" },
			{"data": "no_hp" },
		]
	});

	$('#lookup_entitas tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_entitas').DataTable();
        var data = table.row( this ).data();
        $('#no_registrasi').val(data["no_registrasi"]);
        $('#nama_mustahik').val(data["nama_lembaga"]);
        $('.close').click();
	});

	$('#lookup_disposisi').DataTable({
		"ajax": urlAPI+"/app/module/pengajuan/get_disposisi.php",
		"columns": [
			{"data": "no_disposisi" },
			{"data": "pengirim" },
			{"data": "perihal" },
		]
	});

	$('#lookup_disposisi tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_disposisi').DataTable();
        var data = table.row( this ).data();
        $('#no_disposisi').val(data["no_disposisi"]);
        $('#perihal').val(data["perihal"]);
        $('.close').click();
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
    	savePengajuan();
    	resetForm();
    	$('.konten').load('224_pengajuan/pengajuan.php');
	});

	/* UPDATE */
	$('#update').click(function(){
		updatePengajuan();
		resetForm();
		$('.konten').load('224_pengajuan/pengajuan.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deletePengajuan();
			resetForm();
			$('.konten').load('224_pengajuan/pengajuan.php');
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
	}

	function loadData(){
		var aksi = "load";
		var no_pengajuan = $('#no_pengajuan').val();
		$.getJSON(urlAPI+'/app/module/pengajuan/pengajuan_load.php', {aksi:aksi, no_pengajuan:no_pengajuan}, function(json) {
			$('#kegiatan').val(json.kegiatan);
			$('#jml_pengajuan').val(json.jml_pengajuan);
			$('#jenis').val(json.jenis);
            $('#status').val(json.status);
		});
	}

	function savePengajuan(){
		var no_disposisi = $('#no_disposisi').val();
		var no_kantor = $('#no_kantor').val();
		var no_registrasi = $('#no_registrasi').val();
		var no_master = $('#no_master').val();
		var keterangan = $('#keterangan').val();
        var periode = $('#periode').val();
		var tgl_pengajuan = $('#tgl_pengajuan').val();
		var jml_pengajuan = $('#jml_pengajuan').val();
		$.ajax({
			url:  urlAPI+"/app/module/pengajuan/pengajuan_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				no_disposisi:no_disposisi,
				no_kantor:no_kantor,
				no_registrasi:no_registrasi,
				no_master:no_master,
				keterangan:keterangan,
                periode:periode,
				tgl_pengajuan:tgl_pengajuan,
				jml_pengajuan:jml_pengajuan
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updatePengajuan(){
		var no_pengajuan = $('#no_pengajuan').val();
		var no_kantor = $('#no_kantor').val();
		$.ajax({
			url:  urlAPI+"/app/module/pengajuan/pengajuan_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				no_disposisi:no_disposisi,
				no_kantor:no_kantor
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deletePengajuan(){
		var no_pengajuan = $('#no_pengajuan').val();
		$.ajax({
			url:  urlAPI+"/app/module/pengajuan/pengajuan_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'no_pengajuan':no_pengajuan
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