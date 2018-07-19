$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;

	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#datetimepicker2').datetimepicker({
			format:'YYYY-MM-DD'
		});
	});
	/* LOAD DATA TABLES LIBRARY */
    table = $('#tabelrekomendasi').DataTable( {
        "ajax": urlAPI+"/app/module/rekomendasi/get_rekomendasi.php",
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

	$('#tabelrekomendasi tbody').on('click', 'tr', function () {
		var data = table.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#nama_mustahik').val(data["nama_mustahik"]);
        $('#nama_master').val(data["nama_master"]);
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	table_ent = $('#tabelrekomendasi_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/rekomendasi/get_rekomendasi_entitas.php",
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

	$('#tabelrekomendasi_entitas tbody').on('click', 'tr', function () {
		var data = table_ent.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#nama_mustahik').val(data["nama_lembaga"]);
        $('#nama_master').val(data["nama_master"]);
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	/* BUTTON EVENT */
	
    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
    	saveRekomendasi();
    	resetForm();
    	$('.konten').load('423_rekomendasi/rekomendasi.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteRekomendasi();
		resetForm();
		$('.konten').load('423_rekomendasi/rekomendasi.php');
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

	function saveRekomendasi(){
		var no_pengajuan = $('#no_pengajuan').val();
		var poin_penilaian = $('#poin_penilaian').val();
        var rekomendasi = $('#rekomendasi').val();
        var asnaf = $('#asnaf').val();
		$.ajax({
			url:  urlAPI+"/app/module/rekomendasi/rekomendasi_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'no_pengajuan':no_pengajuan,
                'poin_penilaian':poin_penilaian,
                'rekomendasi':rekomendasi,
                'asnaf':asnaf
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteRekomendasi(){
		var no_pengajuan = $('#no_pengajuan').val();
		$.ajax({
			url:  urlAPI+"/app/module/rekomendasi/rekomendasi_delete.php",
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