$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode.php';

    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format:'YYYY-MM-DD'
        });

        /** Combobox Periode Ajax */
        $.getJSON(urlGetCombo,function(json){
            $('#periode').html('');
            $.each(json, function(index, row) {
                $('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $('#lookup_kas').DataTable( {
		    "ajax": urlAPI+"/app/module/kas/lookup_kas.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
		    ]
        });

        $('#grid_trs').DataTable({
            // "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
            "paging":   false
        });

        $('#tabelbatal').DataTable({
            // "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
        });

        $('#lookup_akun').DataTable( {
		    "ajax": urlAPI+"/app/module/kas/lookup_akun.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_muzaki_target').DataTable( {
		    "ajax": urlAPI+"/app/module/donasi/lookup_muzaki.php",
		    "columns": [
			    {"data": "npwz" },
                {"data": "nama_donatur" },
                {"data": "alamat" },
		    ]
        });

        $('#lookup_muzaki_sumber').DataTable( {
		    "ajax": urlAPI+"/app/module/donasi/lookup_muzaki.php",
		    "columns": [
			    {"data": "npwz" },
                {"data": "nama_donatur" },
                {"data": "alamat" },
		    ]
        });

        $('#tabelbatal tbody').on('click', 'tr', function (e) {
            var table = $('#tabelbatal').DataTable();
            var data = table.row( this ).data();
            $('#no_jurnal').val(data["no_jurnal"]);
            $('.close').click();
        });

        $('#lookup_kas tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kas').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun').val(data["kode_akun"]);
            $('#akun').val(data["akun"]);
            $('#txt_periode').val(data["periode"]);
            loadSaldo();
            loadGridTransaksi();
            loadGridBatalTransaksi()
            $('.close').click();
        });

        $('#lookup_akun tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun').DataTable();
            var data = table.row( this ).data();
            $('#akun_counter').val(data["kode_akun"]);
            $('#akun_trs').val(data["akun"]);
            $('.close').click();
        });

        $('#lookup_muzaki_target tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_muzaki_target').DataTable();
            var data = table.row( this ).data();
            $('#npwz_target').val(data["npwz"]);
            $('#muzaki_target').val(data["nama_donatur"]);
            $('.close').click();
        });

        $('#lookup_muzaki_sumber tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_muzaki_sumber').DataTable();
            var data = table.row( this ).data();
            $('#npwz_sumber').val(data["npwz"]);
            $('#muzaki_sumber').val(data["nama_donatur"]);
            $('.close').click();
        });

        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#jml_transaksi').on('input', function() {
            $('#format_jml').html(moneyFormat.to(parseInt($(this).val())));
        });
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
        saveTransaksi();
    	resetForm();
    });
    
    /* BATAL TRANSAKSI */
    $('#batal').click(function(){
        batalTransaksi();
        resetForm();
    });

    $('#rev_donasi').click(function(){
        rubahDonasi();
        $('.konten').load('322_kas/kas.php');
    });

    $('#reset_rev').click(function(){
        $('.konten').load('322_kas/kas.php');
    });

    function loadSaldo(){
        var kode_akun = $('#kode_akun').val();
        var periode = $('#txt_periode').val();
		$.getJSON(urlAPI+'/app/module/kas/saldo_load.php', {kode_akun:kode_akun, periode:periode}, function(json) {
			$('#saldo').val(json.saldo_berjalan);
		});
    }

    function loadGridTransaksi(){
        var kode_akun = $('#kode_akun').val();
        var periode = $('#txt_periode').val();
        $.ajax({
            url: urlAPI+'/app/module/kas/grid_transaksi.php',
            method: 'POST',
            data: {kode_akun:kode_akun, periode:periode},
            success:function(data){
                $('#grid_transaksi').html(data);
            }
        });
    }

    function loadGridBatalTransaksi(){
        var kode_akun = $('#kode_akun').val();
        var periode = $('#txt_periode').val();
        $.ajax({
            url: urlAPI+'/app/module/kas/grid_batal_transaksi.php',
            method: 'POST',
            data: {kode_akun:kode_akun, periode:periode},
            success:function(data){
                $('#grid_batal_transaksi').html(data);
            }
        });
    }

    function saveTransaksi(){
        var saldo = $('#saldo').val();
        var kode_akun = $('#kode_akun').val();
		var periode = $('#periode').val();
		var tgl_transaksi = $('#tgl_transaksi').val();
        var akun_counter = $('#akun_counter').val();
        var jml_transaksi = $('#jml_transaksi').val();
		var jenis = $('#jenis').val();
        var keterangan = $('#keterangan').val();
		$.ajax({
			url:  urlAPI+"/app/module/kas/kas_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
				'saldo':saldo,
				'kode_akun':kode_akun,
				'periode':periode,
				'tgl_transaksi':tgl_transaksi,
				'akun_counter':akun_counter,
				'jml_transaksi':jml_transaksi,
				'jenis':jenis,
				'keterangan':keterangan
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalTransaksi(){
        var no_jurnal = $('#no_jurnal').val();
		$.ajax({
			url:  urlAPI+"/app/module/kas/batal_kas.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_jurnal:no_jurnal
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function rubahDonasi(){
        var npwz_target = $('#npwz_target').val();
        var npwz_sumber = $('#npwz_sumber').val();
		$.ajax({
			url:  urlAPI+"/app/module/kas/rubah_donasi.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'npwz_target':npwz_target,
                'npwz_sumber':npwz_sumber
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function resetForm(){
        $('.konten').load('322_kas/kas.php');
    }

});