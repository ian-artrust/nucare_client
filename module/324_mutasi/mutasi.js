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

        $.getJSON(urlGetCombo,function(json){
            $('#periode_bank').html('');
            $.each(json, function(index, row) {
                $('#periode_bank').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $('#lookup_kas_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/mutasi/lookup_kas.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
		    ]
        });

        $('#lookup_kas_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/mutasi/lookup_kas.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
		    ]
        });

        $('#lookup_kas_debit2').DataTable( {
		    "ajax": urlAPI+"/app/module/mutasi/lookup_kas.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
		    ]
        });

        $('#lookup_kas_kredit2').DataTable( {
		    "ajax": urlAPI+"/app/module/mutasi/lookup_kas.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
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

        $('#lookup_kas_debit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kas_debit').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_debit').val(data["kode_akun"]);
            $('#akun_kas_debit').val(data["akun"]);
            $('#txt_periode_debit').val(data["periode"]);
            loadSaldoDebit();
            $('.close').click();
        });

        $('#lookup_kas_kredit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kas_kredit').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_kredit').val(data["kode_akun"]);
            $('#akun_kas_kredit').val(data["akun"]);
            $('#txt_periode_kredit').val(data["periode"]);
            loadSaldoKredit();
            $('.close').click();
        });

        $('#lookup_kas_debit2 tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kas_debit2').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_debit2').val(data["kode_akun"]);
            $('#akun_kas_debit2').val(data["akun"]);
            $('#txt_periode_debit2').val(data["periode"]);
            loadSaldoDebit2();
            $('.close').click();
        });

        $('#lookup_kas_kredit2 tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kas_kredit2').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_kredit2').val(data["kode_akun"]);
            $('#akun_kas_kredit2').val(data["akun"]);
            $('#txt_periode_kredit2').val(data["periode"]);
            loadSaldoKredit2();
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

        $('#jml_mutasi').on('input', function() {
            $('#format_jml').html(moneyFormat.to(parseInt($(this).val())));
        });
    });

    
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
        $('.konten').load('324_mutasi/mutasi.php');
    });

    $('#reset_rev').click(function(){
        $('.konten').load('324_mutasi/mutasi.php');
    });

    /* SAVE */
    $('#save').click(function(){
        saveKas();
    	resetForm();
    });

    $('#save_bank').click(function(){
        saveBank();
    	resetForm();
    });

    $('#rev_donasi').click(function(){
        rubahDonasi();
        $('.konten').load('324_mutasi/mutasi.php');
    });

    function loadSaldoDebit(){
        var kode_akun = $('#kode_akun_debit').val();
        var periode = $('#txt_periode_debit').val();
		$.getJSON(urlAPI+'/app/module/mutasi/saldo_load_debit.php', {kode_akun:kode_akun, periode:periode}, function(json) {
			$('#saldo_debit').val(json.saldo_berjalan);
		});
    }

    function loadSaldoKredit(){
        var kode_akun = $('#kode_akun_kredit').val();
        var periode = $('#txt_periode_kredit').val();
		$.getJSON(urlAPI+'/app/module/mutasi/saldo_load_kredit.php', {kode_akun:kode_akun, periode:periode}, function(json) {
			$('#saldo_kredit').val(json.saldo_berjalan);
		});
    }

    function loadSaldoDebit2(){
        var kode_akun = $('#kode_akun_debit2').val();
        var periode = $('#txt_periode_debit2').val();
		$.getJSON(urlAPI+'/app/module/mutasi/saldo_load_debit.php', {kode_akun:kode_akun, periode:periode}, function(json) {
			$('#saldo_debit').val(json.saldo_berjalan);
		});
    }

    function loadSaldoKredit2(){
        var kode_akun = $('#kode_akun_kredit2').val();
        var periode = $('#txt_periode_kredit2').val();
		$.getJSON(urlAPI+'/app/module/mutasi/saldo_load_kredit.php', {kode_akun:kode_akun, periode:periode}, function(json) {
			$('#saldo_kredit').val(json.saldo_berjalan);
		});
    }

    function saveKas(){
        var kode_akun_debit = $('#kode_akun_debit').val();
        var akun_kas_debit = $('#akun_kas_debit').val();
        var saldo_debit = $('#saldo_debit').val();
        var kode_akun_kredit = $('#kode_akun_kredit').val();
        var akun_kas_kredit = $('#akun_kas_kredit').val();
        var saldo_kredit = $('#saldo_kredit').val();
        var jml_mutasi = $('#jml_mutasi').val();
        var keterangan = $('#keterangan').val();
		var periode = $('#periode').val();
		var tgl_transaksi = $('#tgl_transaksi').val();
		$.ajax({
			url:  urlAPI+"/app/module/mutasi/kas_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                'kode_akun_debit':kode_akun_debit,
                'akun_kas_debit':akun_kas_debit,
                'saldo_debit':saldo_debit,
                'kode_akun_kredit':kode_akun_kredit,
                'akun_kas_kredit':akun_kas_kredit,
                'saldo_kredit':saldo_kredit,
                'jml_mutasi':jml_mutasi,
                'keterangan':keterangan,
                'periode':periode,
                'tgl_transaksi':tgl_transaksi
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function saveBank(){
        var kode_akun_bank_debit = $('#kode_akun_bank_debit').val();
        var no_rekening_debit = $('#no_rekening_debit').val();
        var nama_bank_debit = $('#nama_bank_debit').val();
        var saldo_bank_debit = $('#saldo_bank_debit').val();
        var kode_akun_bank_kredit = $('#kode_akun_bank_kredit').val();
        var no_rekening_kredit = $('#no_rekening_kredit').val();
        var nama_bank_kredit = $('#nama_bank_kredit').val();
        var saldo_bank_kredit = $('#saldo_bank_kredit').val();
        var jml_mutasi_bank = $('#jml_mutasi_bank').val();
        var keterangan_bank = $('#keterangan_bank').val();
		var periode_bank = $('#periode_bank').val();
		var tgl_transaksi_bank = $('#tgl_transaksi_bank').val();
		$.ajax({
			url:  urlAPI+"/app/module/mutasi/bank_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                'kode_akun_bank_debit':kode_akun_bank_debit,
                'no_rekening_debit':no_rekening_debit,
                'nama_bank_debit':nama_bank_debit,
                'saldo_bank_debit':saldo_bank_debit,
                'kode_akun_bank_kredit':kode_akun_bank_kredit,
                'no_rekening_kredit':no_rekening_kredit,
                'nama_bank_kredit':nama_bank_kredit,
                'saldo_bank_kredit':saldo_bank_kredit,
                'jml_mutasi_bank':jml_mutasi_bank,
                'keterangan_bank':keterangan_bank,
                'periode_bank':periode_bank,
                'tgl_transaksi_bank':tgl_transaksi_bank
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
			url:  urlAPI+"/app/module/mutasi/rubah_donasi.php",
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
        $('.konten').load('324_mutasi/mutasi.php');
    }

});