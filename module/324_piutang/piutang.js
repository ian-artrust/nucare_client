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
            $('#periode_angsuran').html('');
            $.each(json, function(index, row) {
                $('#periode_angsuran').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $('#tabel_piutang').DataTable({
            "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
            "ajax": urlAPI+"/app/module/piutang/get_piutang.php",
            "columns": [
			    {"data": "no_piutang" },
                {"data": "nama_kreditur" },
                {"data": "tgl_piutang" },
                {"data": "jml_piutang" },
		    ]
        });

        $('#tabel_piutang tbody').on('click', 'tr', function (e) {
            var table = $('#tabel_piutang').DataTable();
            var data = table.row( this ).data();
            $('#no_batal_piutang').val(data["no_batal_piutang"]);
            $('.close').click();
        });

        $('#tabel_angsuran').DataTable({
            // "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
            "paging":   false,
            "searching": false
        });

        $('#lookup_kreditur').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_kreditur.php",
		    "columns": [
			    {"data": "kode_kreditur" },
                {"data": "nama_kreditur" },
                {"data": "no_hp" },
		    ]
        });

        $('#lookup_kreditur_angsuran').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_kreditur_angsuran.php",
		    "columns": [
			    {"data": "no_piutang" },
                {"data": "nama_kreditur" },
                {"data": "jml_piutang" },
                {"data": "sumber_dana" },
		    ]
        });

        $('#lookup_akun_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_akun_debit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_akun_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_angsuran_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_akun_angsuran_debit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_angsuran_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/piutang/lookup_akun_angsuran_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#tabelbatal tbody').on('click', 'tr', function (e) {
            var table = $('#tabelbatal').DataTable();
            var data = table.row( this ).data();
            $('#no_jurnal').val(data["no_jurnal"]);
            $('.close').click();
        });

        $('#lookup_kreditur tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kreditur').DataTable();
            var data = table.row( this ).data();
            $('#kode_kreditur').val(data["kode_kreditur"]);
            $('#nama_kreditur').val(data["nama_kreditur"]);
            $('.close').click();
        });

        $('#lookup_kreditur_angsuran tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kreditur_angsuran').DataTable();
            var data = table.row( this ).data();
            $('#no_piutang_ang').val(data["no_piutang"]);
            $('#nama_kreditur_ang').val(data["nama_kreditur"]);
            $('#jumlah_piutang').val(data["jml_piutang"]);
            $('#sumber_dana_ang').val(data["sumber_dana"]);
            loadSisaPiutang();
            loadGridAngsuran();
            $('.close').click();
        });

        $('#lookup_akun_debit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun_debit').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_debit').val(data["kode_akun"]);
            $('#akun_debit').val(data["akun"]);
            $('.close').click();
        });

        $('#lookup_akun_kredit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun_kredit').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_kredit').val(data["kode_akun"]);
            $('#akun_kredit').val(data["akun"]);
            $('.close').click();
        });

        $('#lookup_akun_angsuran_debit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun_angsuran_debit').DataTable();
            var data = table.row( this ).data();
            $('#kode_debit_angsuran').val(data["kode_akun"]);
            $('#akun_debit_angsuran').val(data["akun"]);
            $('.close').click();
        });

        $('#lookup_akun_angsuran_kredit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun_angsuran_kredit').DataTable();
            var data = table.row( this ).data();
            $('#kode_kredit_angsuran').val(data["kode_akun"]);
            $('#akun_kredit_angsuran').val(data["akun"]);
            $('.close').click();
        });

        $('#lookup_akun_angsuran_kredit tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_akun_angsuran_kredit').DataTable();
            var data = table.row( this ).data();
            $('#kode_kredit_angsuran').val(data["kode_akun"]);
            $('#akun_kredit_angsuran').val(data["akun"]);
            $('.close').click();
        });


        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#jml_piutang').on('input', function() {
            $('#format_jml').html(moneyFormat.to(parseInt($(this).val())));
        });

        $('#jml_angsuran').on('input', function() {
            $('#format_jml_angsuran').html(moneyFormat.to(parseInt($(this).val())));
        });
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
        savePiutang();
    	resetForm();
    });

    $('#save_angsuran').click(function(){
        saveAngsuran();
    	resetForm();
    });
    
    /* BATAL TRANSAKSI */
    $('#batal_piutang').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Transaksi...?');
        if(tanya==true){
            batalPiutang();
            resetForm();
        }else{
            return false;
        }
    });

    $('#batal_angsuran').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Angsuran...?');
        if(tanya==true){
            batalAngsuran();
            resetForm();
        }else{
            return false;
        }
    });

    function loadSisaPiutang(){
        var no_piutang_ang = $('#no_piutang_ang').val();
		$.getJSON(urlAPI+'/app/module/piutang/sisa_piutang_load.php', {no_piutang_ang:no_piutang_ang}, function(json) {
            if(json.sisa_piutang==null){
                json.sisa_piutang=0;
                $('#sisa_piutang').val(json.sisa_piutang);
            }else{
                $('#sisa_piutang').val(json.sisa_piutang);
            }
            
		});
    }

    function loadGridAngsuran(){
        var no_piutang_ang = $('#no_piutang_ang').val();
        $.ajax({
            url: urlAPI+'/app/module/piutang/grid_angsuran.php',
            method: 'POST',
            data: {no_piutang_ang:no_piutang_ang},
            success:function(data){
                $('#grid_angsuran').html(data);
            }
        });
    }

    function savePiutang(){
        var kode_kreditur = $('#kode_kreditur').val();
        var nama_kreditur = $('#nama_kreditur').val();
		var periode = $('#periode').val();
		var tgl_piutang = $('#tgl_piutang').val();
        var sumber_dana = $('#sumber_dana').val();
        var jml_piutang = $('#jml_piutang').val();
		var kode_akun_debit = $('#kode_akun_debit').val();
        var akun_debit = $('#akun_debit').val();
        var kode_akun_kredit = $('#kode_akun_kredit').val();
        var akun_kredit = $('#akun_kredit').val();
		$.ajax({
			url:  urlAPI+"/app/module/piutang/piutang_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
				kode_kreditur:kode_kreditur,
                nama_kreditur:nama_kreditur,
                periode:periode, 
                tgl_piutang:tgl_piutang, 
                sumber_dana:sumber_dana, 
                jml_piutang:jml_piutang, 
                kode_akun_debit:kode_akun_debit,
                akun_debit:akun_debit, 
                kode_akun_kredit:kode_akun_kredit, 
                akun_kredit:akun_kredit
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function saveAngsuran(){
        var no_piutang_ang = $('#no_piutang_ang').val();
        var nama_kreditur_ang = $('#nama_kreditur_ang').val();
        var jml_angsuran = $('#jml_angsuran').val();
		var periode_angsuran = $('#periode_angsuran').val();
		var tgl_angsuran = $('#tgl_angsuran').val();
        var kode_debit_angsuran = $('#kode_debit_angsuran').val();
        var akun_debit_angsuran = $('#akun_debit_angsuran').val();
        var kode_kredit_angsuran = $('#kode_kredit_angsuran').val();
        var akun_kredit_angsuran = $('#akun_kredit_angsuran').val();
		$.ajax({
			url:  urlAPI+"/app/module/piutang/angsuran_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                no_piutang_ang:no_piutang_ang,
                nama_kreditur_ang:nama_kreditur_ang,
                jml_angsuran:jml_angsuran,
                periode_angsuran:periode_angsuran, 
                tgl_angsuran:tgl_angsuran, 
                kode_debit_angsuran:kode_debit_angsuran, 
                akun_debit_angsuran:akun_debit_angsuran, 
                kode_kredit_angsuran:kode_kredit_angsuran, 
                akun_kredit_angsuran:akun_kredit_angsuran
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalPiutang(){
        var no_batal_piutang = $('#no_batal_piutang').val();
		$.ajax({
			url:  urlAPI+"/app/module/piutang/batal_piutang.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_batal_piutang:no_batal_piutang
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalAngsuran(){
        var no_batal_angsuran = $('#no_batal_angsuran').val();
		$.ajax({
			url:  urlAPI+"/app/module/piutang/batal_angsuran.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_batal_angsuran:no_batal_angsuran
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
        $('.konten').load('324_piutang/piutang.php');
    }

});