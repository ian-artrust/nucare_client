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

        $('#lookup_muzaki').DataTable( {
            "ajax": urlAPI+"/app/module/donasi/lookup_muzaki.php",
            "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		    "columns": [
			    {"data": "npwz" },
                {"data": "nama_donatur" },
                {"data": "alamat" },
		    ]
        });

        $('#lookup_program').DataTable( {
		    "ajax": urlAPI+"/app/lib/lookup_program.php",
		    "columns": [
			    {"data": "kode_prg_pnr" },
                {"data": "program" },
                {"data": "kategori" },
                {"data": "akun_debit" },
                {"data": "akun_debit_bank" },
                {"data": "akun_kredit" },
                {"data": "akun_kredit_bank" },
		    ]
        });

        $('#lookup_bank').DataTable( {
		    "ajax": urlAPI+"/app/lib/lookup_bank.php",
		    "columns": [
			    {"data": "no_rekening" },
                {"data": "nama_bank" },
		    ]
        });


        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#jml_donasi').on('input', function() {
            $('#format_mata_uang').html(moneyFormat.to(parseInt($(this).val())));
        });

        totalDonasi();

        $('#jml_donasi').change(function() {
            totalDonasi();
        });

        $('#total_donasi').change(function() {
            totalDonasi();
            $('#total_format').html(moneyFormat.to(parseInt($(this).val())));
        });  
    });

    table = $('#tabelbatal').DataTable( {
        "ajax": urlAPI+"/app/module/donasi/get_donasi.php",
        "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
		"columns": [
			{"data": "no_donasi" },
          	{"data": "npwz" },
            {"data": "nama_donatur" },
            {"data": "tgl_donasi" },
            {"data": "norek_bank" },
			{"data": "program" },
			{"data": "jml_donasi" },
		]
    });

    $('#tabelbatal tbody').on('click', 'tr', function () {
		var data = table.row(this).data();
		$('#no_donasi').val(data["no_donasi"]);
	});

    function totalDonasi(){
        var sum = 0;
        $('tbody#itemlist tr').each(function(){
            var subtotal = $(this).find('#jml_donasi').val();
            var total = parseFloat(sum) + parseFloat(subtotal)
            sum = total;
        });        
        $('#total_donasi').val(sum);
    }

    $('#lookup_muzaki tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_muzaki').DataTable();
        var data = table.row( this ).data();
        $('#npwz').val(data["npwz"]);
        $('#muzaki').val(data["nama_donatur"]);
        $('.close').click();
    });

    $('#lookup_program tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_program').DataTable();
        var data = table.row( this ).data();
        $('#kode_program').val(data["kode_prg_pnr"]);
        $('#program').val(data["program"]);
        $('#akun_debit').val(data["akun_debit"]);
        $('#akun_debit_bank').val(data["akun_debit_bank"]);
        $('#akun_kredit').val(data["akun_kredit"]);
        $('#akun_kredit_bank').val(data["akun_kredit_bank"]);
        $('.close').click();
    });

    $('#lookup_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_bank').DataTable();
        var data = table.row( this ).data();
        $('#no_rekening').val(data["no_rekening"]);
        $('#nama_bank').val(data["nama_bank"]);
        loadSaldoBank();
        $('.close').click();
    });

    function loadSaldoBank(){
        var aksi = "load";
		var no_rekening = $('#no_rekening').val();
		$.getJSON(urlAPI+'/app/module/trsbank/trsbank_load.php', {aksi:aksi, no_rekening:no_rekening}, function(json) {
			if(json.saldo==""){
				$('#saldo_bank').val('0');
			}else{
				$('#saldo_bank').val(json.saldo);
			}
		});
    }

    function cetak(){
        var npwz = $('#npwz').val();
        var muzaki = $('#muzaki').val();
		var periode = $('#periode').val();
		var no_nota = $('#no_nota').val();
        var tgl_donasi = $('#tgl_donasi').val();
        var jml_donasi = $('#jml_donasi').val();
        var metode = $('#metode').val();
        var no_rekening = $('#no_rekening').val();
        var saldo_bank = $('#saldo_bank').val();
        var kode_program = $('#kode_program').val();
        var program = $('#program').val();
        var akun_debit = $('#akun_debit').val();
        var akun_debit_bank = $('#akun_debit_bank').val();
        var akun_kredit = $('#akun_kredit').val();
        var akun_kredit_bank = $('#akun_kredit_bank').val();

		$.ajax({
			url:  urlAPI+"/app/module/donasi/donasi_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				aksi:'save',
                npwz:npwz,
                muzaki:muzaki,
				periode:periode,
				no_nota:no_nota,
                tgl_donasi:tgl_donasi,
                jml_donasi:jml_donasi,
                metode:metode,
                no_rekening:no_rekening,
                saldo_bank:saldo_bank,
                kode_program:kode_program,
                program:program,
                akun_debit,
                akun_debit_bank,
                akun_kredit,
                akun_kredit_bank
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('221_donasi/struk_donasi.php','no_donasi='+data.no_donasi);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function reprint(){
        var no_donasi = $('#no_donasi').val();
        $('.konten').load('221_donasi/struk_donasi.php','no_donasi='+no_donasi);
    }

    function batalDonasi(){
		var no_donasi = $('#no_donasi').val();
		$.ajax({
			url:  urlAPI+"/app/module/donasi/donasi_reject.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'reject',
				'no_donasi':no_donasi
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});

	}

    function clear() {
        $("#kode_kategori").val("");
        $("#kode_program").val("");
		$("#program").val("");
		$("#jml_donasi").val("");
    }

    $('#new_donatur').click(function(){
        $('.konten').load('211_muzaki/muzaki.php');
    });

    $('#reset').click(function(){
        $('.konten').load('221_donasi/donasi.php');
    });

    $('#cetak').click(function(){
        cetak();
    });

    $('#reprint').click(function(){

        var no_donasi = $('#no_donasi').val();
        // alert(no_donasi);
        if(no_donasi==''){
            alert("Pilih Donasi Yang Akan Dibatalkan");
        }else{
            reprint();
        }
    });

    $('#batal').click(function(){
		batalDonasi();
		$('.konten').load('221_donasi/donasi.php');
	});

});