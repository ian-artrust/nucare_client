$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode.php';
    var urlGetProgram   = urlAPI+'/app/lib/combo_program.php';
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
		    "ajax": urlAPI+"/app/module/donasi_kl/lookup_muzaki.php",
		    "columns": [
			    {"data": "npwz" },
                {"data": "nama_donatur" },
                {"data": "nama_petugas" },
                {"data": "nama_kantor" },
                {"data": "no_kantor" },
            ],
            "columnDefs": [
                {
                    "targets": [ 4 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

        $('#lookup_program').DataTable( {
		    "ajax": urlAPI+"/app/lib/lookup_program.php",
		    "columns": [
			    {"data": "kode_prg_pnr" },
                {"data": "program" },
                {"data": "akun_debit" },
                {"data": "akun_kredit" },
		    ]
        });

        $('#lookup_bank').DataTable( {
		    "ajax": urlAPI+"/app/lib/lookup_bank_kl.php",
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
        "ajax": urlAPI+"/app/module/donasi_kl/get_donasi_kl.php",
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
		$('#no_donasi_kl').val(data["no_donasi"]);
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
        $('#akun_kredit').val(data["akun_kredit"]);
        $('.close').click();
    });

    $('#lookup_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_bank').DataTable();
        var data = table.row( this ).data();
        $('#no_rekening').val(data["no_rekening"]);
        $('#nama_bank').val(data["nama_bank"]);
        $('.close').click();
    });

    function cetak(){
        var npwz = $('#npwz').val();
        var muzaki = $('#muzaki').val();
		var periode = $('#periode').val();
		var no_nota = $('#no_nota').val();
        var tgl_donasi = $('#tgl_donasi').val();
        var jml_donasi = $('#jml_donasi').val();
        var metode = $('#metode').val();
        var no_rekening = $('#no_rekening').val();
        var kode_program = $('#kode_program').val();
        var program = $('#program').val();
        var akun_debit = $('#akun_debit').val();
        var akun_kredit = $('#akun_kredit').val();

		$.ajax({
			url:  urlAPI+"/app/module/donasi_kl/donasi_save_kl.php",
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
                kode_program:kode_program,
                program:program,
                akun_debit,
                akun_kredit
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('227_donasi_kl/struk_donasi_kl.php','no_donasi='+data.no_donasi);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function reprint(){
        var no_donasi = $('#no_donasi_kl').val();
        $('.konten').load('227_donasi_kl/struk_donasi_kl.php','no_donasi='+no_donasi);
    }

    function batalDonasi(){
		var no_donasi_kl = $('#no_donasi_kl').val();
		$.ajax({
			url:  urlAPI+"/app/module/donasi_kl/donasi_kl_reject.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'reject',
				'no_donasi_kl':no_donasi_kl
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

    $('#reset').click(function(){
        $('.konten').load('227_donasi_kl/donasi_kl.php');
    });

    $('#cetak').click(function(){
        cetak();
    });

    $('#reprint').click(function(){
        var no_donasi = $('#no_donasi_kl').val();
        if(no_donasi==''){
            alert("Pilih Donasi Yang Akan Dibatalkan");
        }else{
            reprint();
        }
    });

    $('#batal').click(function(){
		batalDonasi();
		$('.konten').load('227_donasi_kl/donasi_kl.php');
	});

});