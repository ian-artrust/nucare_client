$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        }); 
    });

    /* LOAD DATA TABLES LIBRARY */
    table = $('#tabelpengajuan').DataTable( {
        "ajax": urlAPI+"/app/module/jadwal_survey/get_pengajuan.php",
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
		var data = table.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

	table_ent = $('#tabelpengajuan_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/jadwal_survey/get_pengajuan_entitas.php",
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
		var data = table_ent.row(this).data();
        $('#no_pengajuan').val(data["no_pengajuan"]);
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_pengajuan').focus();
	});

    $('#reset').click(function(){
        $('.konten').load('421_jadwal_survey/jadwal_survey.php');
    });

    $('#survey').click(function(){
        survey();
        $('.konten').load('421_jadwal_survey/jadwal_survey.php');
    });

    function survey(){
        var no_pengajuan = $('#no_pengajuan').val();
        var tgl_survey = $('#tgl_survey').val();
		$.ajax({
			url:  urlAPI+"/app/module/jadwal_survey/pengajuan_survey.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'survey',
                'no_pengajuan':no_pengajuan,
                'tgl_survey':tgl_survey
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