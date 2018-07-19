$(document).ready(function() {
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
        "ajax": urlAPI+"/app/module/pengajuan/get_pengajuan_kl.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_pengajuan" },
			{"data": "nama_mustahik" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_pengajuan" },
			{"data": "status" },
		]
    });

	table_ent = $('#tabelpengajuan_entitas').DataTable( {
        "ajax": urlAPI+"/app/module/pengajuan/get_pengajuan_entitas_kl.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_pengajuan" },
			{"data": "nama_lembaga" },
			{"data": "nama_master" },
			{"data": "tgl_pengajuan" },
			{"data": "jml_pengajuan" },
			{"data": "status" },
		]
    });

});