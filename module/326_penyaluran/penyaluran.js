$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;

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

	});
	/* LOAD DATA TABLES LIBRARY */
    table = $('#tabel_individu').DataTable( {
        "ajax": urlAPI+"/app/module/penyaluran/get_penyaluran.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_pengajuan" },
			{"data": "nama_mustahik" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_realisasi" },
			{"data": "status" },
		]
    });

	$('#tabel_individu tbody').on('click', 'tr', function () {
		var data = table.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#nama_mustahik').val(data["nama_mustahik"]);
		$('#nama_master').val(data["nama_master"]);
		$('#keterangan').val(data["keterangan"]);
		$('#jml_realisasi').val(data["jml_realisasi"]);
		$('#asnaf').val(data["asnaf"]);
		$('#sumber_dana').val(data["sumber_dana"]);
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	table_ent = $('#tabel_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/penyaluran/get_penyaluran_entitas.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_pengajuan" },
			{"data": "nama_lembaga" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_realisasi" },
			{"data": "status" },
		]
    });

	$('#tabel_entitas tbody').on('click', 'tr', function () {
		var data = table_ent.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#nama_mustahik').val(data["nama_lembaga"]);
		$('#nama_master').val(data["nama_master"]);
		$('#keterangan').val(data["keterangan"]);
		$('#jml_realisasi').val(data["jml_realisasi"]);
		$('#asnaf').val(data["asnaf"]);
		$('#sumber_dana').val(data["sumber_dana"]);
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	$('#lookup_akun_debit').DataTable( {
		"ajax": urlAPI+"/app/lib/lookup_akun_debit.php",
		"columns": [
			{"data": "kode_akun" },
			{"data": "akun" },
			{"data": "kategori" },
		]
	});

	$('#lookup_akun_kredit').DataTable( {
		"ajax": urlAPI+"/app/lib/lookup_akun_kredit.php",
		"columns": [
			{"data": "kode_akun" },
			{"data": "akun" },
			{"data": "kategori" },
		]
	});

	$('#lookup_bank').DataTable( {
		"ajax": urlAPI+"/app/lib/lookup_bank.php",
		"columns": [
			{"data": "no_rekening" },
			{"data": "nama_bank" },
		]
	});

	$('#lookup_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_bank').DataTable();
        var data = table.row( this ).data();
        $('#no_rekening').val(data["no_rekening"]);
        $('#nama_bank').val(data["nama_bank"]);
        $('.close').click();
    });

	$('#lookup_akun_debit tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_akun_debit').DataTable();
		var data = table.row( this ).data();
		$('#kode_akun_debit').val(data["kode_akun"]);
		$('#akun_debit').val(data["akun"]);
		$('.close').click();
	});

	$('#lookup_akun_kredit tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_akun_kredit').DataTable();
		var data = table.row( this ).data();
		$('#kode_akun_kredit').val(data["kode_akun"]);
		$('#akun_kredit').val(data["akun"]);
		$('.close').click();
	});

	/* BUTTON EVENT */
	
    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
    	savePenyaluran();
    	resetForm();
    	$('.konten').load('326_penyaluran/penyaluran.php');
	});
	
    /* CUSTOM FUNCTION */
	function resetForm()
	{
		// $('#save').removeAttr('disabled');
		$('#update').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('input[type=text]').each(function(){
			$(this).val("");
		});
	}

	function savePenyaluran(){
		var no_rekening = $('#no_rekening').val();
		var no_pengajuan = $('#no_pengajuan').val();
		var periode = $('#periode').val();
		var tgl_penyaluran = $('#tgl_penyaluran').val();
		var jml_realisasi = $('#jml_realisasi').val();
		var keterangan = $('#keterangan').val();
		var kode_akun_debit = $('#kode_akun_debit').val();
		var kode_akun_kredit = $('#kode_akun_kredit').val();
		$.ajax({
			url:  urlAPI+"/app/module/penyaluran/penyaluran_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'no_rekening':no_rekening,
				'no_pengajuan':no_pengajuan,
				'periode':periode,
                'tgl_penyaluran':tgl_penyaluran,
				'jml_realisasi':jml_realisasi,
				'keterangan':keterangan,
				'kode_akun_debit':kode_akun_debit,
				'kode_akun_kredit':kode_akun_kredit
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