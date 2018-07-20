$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	
	var urlGetCombo = urlAPI+'/app/lib/combo_periode.php';
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
		  
		/* LOAD DATA TABLES LIBRARY */
		$('#tabelbank').DataTable({
			"lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		});

		table = $('#tabel_setoran').DataTable( {
			"ajax": urlAPI+"/app/module/trsbank/get_setoran.php",
			"lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
			"columns": [
				{"data": "no_setoran" },
				{"data": "tgl_setoran" },
				{"data": "penyetor" },
				{"data": "jml_setoran" },
				{"data": "nama_bank" },
				{"data": "status" },
			]
		});
	
		$('#lookup_bank').DataTable( {
			"ajax": urlAPI+"/app/module/trsbank/lookup_rekening.php",
			"columns": [
				{"data": "no_rekening" },
				{"data": "nama_bank" },
				{"data": "kode_akun" },
			]
		});

		$('#lookup_akun').DataTable( {
			"ajax": urlAPI+"/app/module/trsbank/lookup_akun.php",
			"columns": [
				{"data": "kode_akun" },
				{"data": "akun" },
				{"data": "kategori" },
			]
		});

		$('#lookup_akun tbody').on('click', 'tr', function (e) {
			var table = $('#lookup_akun').DataTable();
			var data = table.row( this ).data();
			$('#kode_akun_counter').val(data["kode_akun"]);
			$('#akun_counter').val(data["akun"]);
			$('.close').click();
		});
	
		$('#lookup_bank tbody').on('click', 'tr', function (e) {
			var table = $('#lookup_bank').DataTable();
			var data = table.row( this ).data();
			$('#no_rekening').val(data["no_rekening"]);
			$('#nama_bank').val(data["nama_bank"]);
			$('#kode_akun').val(data["kode_akun"]);
			loadSaldo();
			loadGridTransaksi();
			$('.close').click();
		});

		$('#lookup_akun tbody').on('click', 'tr', function (e) {
			var table = $('#lookup_akun').DataTable();
			var data = table.row( this ).data();
			$('#kode_akun_counter').val(data["kode_akun"]);
			$('#akun_counter').val(data["akun"]);
			$('.close').click();
		});
	
		 /** Combobox Periode Ajax */
		 $.getJSON(urlGetCombo,function(json){
			$('#periode').html('');
			$.each(json, function(index, row) {
				$('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
			});
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
		$('.konten').load('323_trsbank/trsbank.php');
    });

    /* SAVE */
    $('#save').click(function(){
		saveTransaksi();
		$('.konten').load('323_trsbank/trsbank.php');
	});

	$('#batal_bank').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Transaksi...?');
        if(tanya==true){
			batalBank();
			$('.konten').load('323_trsbank/trsbank.php');
        }else{
            return false;
        }
    });

    /* CUSTOM FUNCTION */
	function resetForm()
	{
		$('input[type=text]').each(function(){
			$(this).val("");
		});
	}

	function loadSaldo(){
		var aksi = "load";
		var no_rekening = $('#no_rekening').val();
		$.getJSON(urlAPI+'/app/module/trsbank/trsbank_load.php', {aksi:aksi, no_rekening:no_rekening}, function(json) {
			if(json.saldo==""){
				$('#saldo').val('0');
			}else{
				$('#saldo').val(json.saldo);
			}
		});
	}

	function loadGridTransaksi(){
        var no_rekening = $('#no_rekening').val();
        $.ajax({
            url: urlAPI+'/app/module/trsbank/grid_trsbank.php',
            method: 'POST',
            data: {no_rekening:no_rekening},
            success:function(data){
                $('#grid_transaksi').html(data);
            }
        });
	}
	
	function saveTransaksi(){
        var no_rekening = $('#no_rekening').val();
        var kode_akun = $('#kode_akun').val();
		var periode = $('#periode').val();
		var tgl_transaksi = $('#tgl_transaksi').val();
		var saldo = $('#saldo').val();
        var kode_transaksi = $('#kode_transaksi').val();
        var jml_transaksi = $('#jml_transaksi').val();
		var keterangan = $('#keterangan').val();
		var kode_akun_counter = $('#kode_akun_counter').val();
		var akun_counter = $('#akun_counter').val();
		$.ajax({
			url:  urlAPI+"/app/module/trsbank/trsbank_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                'no_rekening':no_rekening,
				'kode_akun':kode_akun,
				'periode':periode,
				'tgl_transaksi':tgl_transaksi,
				'saldo':saldo,
				'kode_transaksi':kode_transaksi,
				'jml_transaksi':jml_transaksi,
				'keterangan':keterangan,
				'kode_akun_counter':kode_akun_counter,
				'akun_counter':akun_counter
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}
	
	function batalBank(){
        var no_batal_bank = $('#no_batal_bank').val();
		$.ajax({
			url:  urlAPI+"/app/module/trsbank/batal_bank.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_batal_bank:no_batal_bank
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