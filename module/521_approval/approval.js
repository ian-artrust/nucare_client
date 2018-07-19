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
    /* LOAD DATA TABLES LIBRARY */
    table = $('#tabelapproval').DataTable( {
        "ajax": urlAPI+"/app/module/approval/get_approval.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
        "columns": [
			{"data": "no_disposisi" },
			{"data": "no_pengajuan" },
            {"data": "nama_mustahik" },
            {"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "tgl_survey" },
            {"data": "jml_pengajuan" },
            {"data": "status" },
        ]
    });

    $('#tabelapproval tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        loadData();
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});
	
	table_ent = $('#tabelapproval_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/approval/get_approval_entitas.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
        "columns": [
			{"data": "no_disposisi" },
            {"data": "no_pengajuan" },
            {"data": "nama_lembaga" },
            {"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "tgl_survey" },
            {"data": "jml_pengajuan" },
            {"data": "status" },
        ]
    });

    $('#tabelapproval_entitas tbody').on('click', 'tr', function () {
        var data = table_ent.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        loadDataEntitas();
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
    	saveApproval();
    	resetForm();
    	$('.konten').load('521_approval/approval.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deleteApproval();
		resetForm();
		$('.konten').load('521_approval/approval.php');
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
		$.getJSON(urlAPI+'/app/module/approval/approval_load.php', {aksi:aksi, no_pengajuan:no_pengajuan}, function(json) {
            $('#nama_mustahik').val(json.nama_mustahik);
            $('#nama_master').val(json.nama_master);
			$('#asnaf').val(json.asnaf);
			$('#jml_pengajuan').val(json.jml_pengajuan);
			$('#poin_penilaian').val(json.poin_penilaian);
			$('#rekomendasi').val(json.rekomendasi);
		});
	}

	function loadDataEntitas(){
		var aksi = "load";
		var no_pengajuan = $('#no_pengajuan').val();
		$.getJSON(urlAPI+'/app/module/approval/approval_load_entitas.php', {aksi:aksi, no_pengajuan:no_pengajuan}, function(json) {
            $('#nama_mustahik').val(json.nama_lembaga);
            $('#nama_master').val(json.nama_master);
			$('#asnaf').val(json.asnaf);
			$('#jml_pengajuan').val(json.jml_pengajuan);
			$('#poin_penilaian').val(json.poin_penilaian);
			$('#rekomendasi').val(json.rekomendasi);
		});
	}

	function saveApproval(){
        var no_pengajuan = $('#no_pengajuan').val();
        var status = $('#status').val();
        var jml_realisasi = $('#jml_realisasi').val();
        var tgl_realisasi = $('#tgl_realisasi').val();
		var sumber_dana = $('#sumber_dana').val();
		var catatan_direktur = $('#catatan_direktur').val();
		$.ajax({
			url:  urlAPI+"/app/module/approval/approval_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
                'no_pengajuan':no_pengajuan,
                'status':status,
                'jml_realisasi':jml_realisasi,
				'tgl_realisasi':tgl_realisasi,
				'catatan_direktur':catatan_direktur,
				'sumber_dana':sumber_dana
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteApproval(){
		var no_pengajuan = $('#no_pengajuan').val();
		$.ajax({
			url:  urlAPI+"/app/module/approval/approval_delete.php",
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