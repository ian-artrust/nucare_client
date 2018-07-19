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
    table = $('#tabel_muzaki').DataTable( {
        "ajax": urlAPI+"/app/module/lap_muzaki/get_muzaki.php",
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		"columns": [
			{"data": "npwz" },
			{"data": "nama_donatur" },
			{"data": "kategori" },
			{"data": "alamat" },
			{"data": "no_hp" },
		]
    });

    table_ma = $('#tabel_muzaki_aktif').DataTable( {
        "ajax": urlAPI+"/app/module/lap_muzaki/get_muzaki_aktif.php",
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		"columns": [
			{"data": "npwz" },
            {"data": "muzaki" },
            {"data": "kategori" },
			{"data": "total_donasi" },
		]
    });

    table_mna = $('#tabel_muzaki_nonaktif').DataTable( {
        "ajax": urlAPI+"/app/module/lap_muzaki/get_muzaki_nonaktif.php",
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		"columns": [
			{"data": "npwz" },
			{"data": "nama_donatur" },
		]
    });

});