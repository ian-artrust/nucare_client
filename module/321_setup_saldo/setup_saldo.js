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

        $('#lookup_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/setup_saldo/get_akun_debit.php",
		    "columns": [
			    {"data": "kode_akun" },
          	    {"data": "akun" },
		    ]
        });

        $('#lookup_bank').DataTable( {
		    "ajax": urlAPI+"/app/lib/lookup_bank.php",
		    "columns": [
			    {"data": "no_rekening" },
                {"data": "nama_bank" },
                {"data": "kode_akun" },
		    ]
        });

        $('#lookup_debit_bank').DataTable( {
		    "ajax": urlAPI+"/app/module/setup_saldo/get_akun_debit_bank.php",
		    "columns": [
			    {"data": "kode_akun" },
          	    {"data": "akun" },
		    ]
        });

        $('#lookup_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/setup_saldo/get_akun_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
          	    {"data": "akun" },
		    ]
        });

        $('#lookup_kredit_bank').DataTable( {
		    "ajax": urlAPI+"/app/module/setup_saldo/get_akun_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
          	    {"data": "akun" },
		    ]
        });

        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#jml_setup').on('input', function() {
            $('#format_mata_uang').html(moneyFormat.to(parseInt($(this).val())));
        });

        $('#jml_setup_bank').on('input', function() {
            $('#format_mata_uang_bank').html(moneyFormat.to(parseInt($(this).val())));
        });

        $('#tabelsaldo').DataTable( {
            "ajax": urlAPI+"/app/module/setup_saldo/get_saldo.php",
            "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
            "columns": [
                {"data": "ref_number" },
                {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "periode" },
                {"data": "tgl_setup" },
                {"data": "jml_setup" },
                {"data": "no_rekening" },
            ]
        });
 
    });

    $('#lookup_debit tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_debit').DataTable();
        var data = table.row( this ).data();
        $('#kode_akun_debit').val(data["kode_akun"]);
        $('#akun_debit').val(data["akun"]);
        $('.close').click();
    });

    $('#lookup_debit_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_debit_bank').DataTable();
        var data = table.row( this ).data();
        $('#kode_akun_debit_bank').val(data["kode_akun"]);
        $('#akun_debit_bank').val(data["akun"]);
        $('.close').click();
    });

    $('#lookup_kredit tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_kredit').DataTable();
        var data = table.row( this ).data();
        $('#kode_akun_kredit').val(data["kode_akun"]);
        $('#akun_kredit').val(data["akun"]);
        $('.close').click();
    });

    $('#lookup_kredit_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_kredit_bank').DataTable();
        var data = table.row( this ).data();
        $('#kode_akun_kredit_bank').val(data["kode_akun"]);
        $('#akun_kredit_bank').val(data["akun"]);
        $('.close').click();
    });

    $('#lookup_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_bank').DataTable();
        var data = table.row( this ).data();
        $('#no_rekening').val(data["no_rekening"]);
        $('#nama_bank').val(data["nama_bank"]);
        $('.close').click();
    });

    $('#tabelsaldo tbody').on('click', 'tr', function (e) {
		var table = $('#tabelsaldo').DataTable();
        var data = table.row( this ).data();
        $('#no_jurnal').val(data["ref_number"]);
        $('.close').click();
    });

    function cetak(){
        var kode_akun_debit = $('#kode_akun_debit').val();
        var akun_debit = $('#akun_debit').val();
		var kode_akun_kredit = $('#kode_akun_kredit').val();
        var akun_kredit = $('#akun_kredit').val();
        var periode = $('#periode').val();
        var tgl_setup = $('#tgl_setup').val();
        var jml_setup = $('#jml_setup').val();

		$.ajax({
			url:  urlAPI+"/app/module/setup_saldo/setup_saldo_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				aksi:'save',
                kode_akun_debit:kode_akun_debit,
                akun_debit:akun_debit,
				kode_akun_kredit:kode_akun_kredit,
                akun_kredit:akun_kredit,
                periode:periode,
                tgl_setup:tgl_setup,
                jml_setup:jml_setup
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('321_setup_saldo/setup_saldo.php');
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function cetakBank(){
        var kode_akun_debit = $('#kode_akun_debit_bank').val();
        var akun_debit = $('#akun_debit_bank').val();
		var kode_akun_kredit = $('#kode_akun_kredit_bank').val();
        var akun_kredit = $('#akun_kredit_bank').val();
        var periode = $('#periode_bank').val();
        var tgl_setup = $('#tgl_setup_bank').val();
        var jml_setup = $('#jml_setup_bank').val();
        var no_rekening = $('#no_rekening').val();
        var nama_bank = $('#nama_bank').val();

		$.ajax({
			url:  urlAPI+"/app/module/setup_saldo/setup_saldo_save_bank.php",
			type: 'POST',
			dataType: 'json',
			data: {
				aksi:'save',
                kode_akun_debit:kode_akun_debit,
                akun_debit:akun_debit,
				kode_akun_kredit:kode_akun_kredit,
                akun_kredit:akun_kredit,
                periode:periode,
                tgl_setup:tgl_setup,
                jml_setup:jml_setup,
                no_rekening:no_rekening,
                nama_bank:nama_bank
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('321_setup_saldo/setup_saldo.php');
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalSetup() {
        var ref_number = $("#no_jurnal").val();
        $.ajax({
			url:  urlAPI+"/app/module/setup_saldo/batal_setup.php",
			type: 'POST',
			dataType: 'json',
			data: {
                ref_number:ref_number
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('321_setup_saldo/setup_saldo.php');
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    $('#reset').click(function(){
        $('.konten').load('321_setup_saldo/setup_saldo.php');
    });

    $('#cetak').click(function(){
        cetak();
    });

    $('#reset_bank').click(function(){
        $('.konten').load('321_setup_saldo/setup_saldo.php');
    });

    $('#cetak_bank').click(function(){
        cetakBank();
    });

    $('#reset_batal').click(function(){
        $('.konten').load('321_setup_saldo/setup_saldo.php');
    });

    $('#setup_batal').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Setup Saldo...?');
        if (tanya==true) {
            batalSetup();
            $('.konten').load('321_setup_saldo/setup_saldo.php');
        }else{
            return false;
        }

    });

});