$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    var urlGetCombo     = urlAPI+'/app/lib/combo_posdana.php';
    var urlGetComboPeriode     = urlAPI+'/app/lib/combo_periode.php';

    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            format:'YYYY-MM-DD'
        });

        /** Combobox Periode Ajax */
        $.getJSON(urlGetComboPeriode,function(json){
            $('#periode').html('');
            $.each(json, function(index, row) {
                $('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $.getJSON(urlGetComboPeriode,function(json){
            $('#periode_pny').html('');
            $.each(json, function(index, row) {
                $('#periode_pny').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $.getJSON(urlGetCombo,function(json){
            $('#pos_dana').html('');
            $.each(json, function(index, row) {
                $('#pos_dana').append('<option value='+row.kode_akun+'>'+row.akun+'</option>');
            });
        });

        $('#tabel_asset').DataTable( {
            "ajax": urlAPI+"/app/module/asset/get_asset.php",
            "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
		    "columns": [
                {"data": "no_asset" },
                {"data": "asset" },
                {"data": "kategori" },
                {"data": "nilai_asset" },
                {"data": "umur_ekonomis" },
                {"data": "nilai_penyusutan" },
		    ]
        });

        $('#tabel_transaksi').DataTable({
            "paging":   false,
            "searching": false
        });

        $('#lookup_kategori').DataTable( {
		    "ajax": urlAPI+"/app/module/asset/lookup_kat_asset.php",
		    "columns": [
			    {"data": "kode_kat_asset" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_asset').DataTable( {
		    "ajax": urlAPI+"/app/module/asset/lookup_asset.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/asset/lookup_akun_debit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/asset/lookup_akun_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_transaksi').DataTable( {
		    "ajax": urlAPI+"/app/module/asset/get_asset_pny.php",
		    "columns": [
			    {"data": "no_asset" },
                {"data": "asset" },
                {"data": "kategori" },
                {"data": "nilai_penyusutan" },
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

        $('#lookup_bank tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_bank').DataTable();
            var data = table.row( this ).data();
            $('#no_rekening').val(data["no_rekening"]);
            $('#nama_bank').val(data["nama_bank"]);
            $('.close').click();
        });

        $('#lookup_kategori tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_kategori').DataTable();
            var data = table.row( this ).data();
            $('#kode_kat_asset').val(data["kode_kat_asset"]);
            $('#kat_asset').val(data["kategori"]);
            $('.close').click();
        });

        $('#lookup_asset tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_asset').DataTable();
            var data = table.row( this ).data();
            $('#kode_akun_asset').val(data["kode_akun"]);
            $('#akun_asset').val(data["akun"]);
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

        $('#lookup_transaksi tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_transaksi').DataTable();
            var data = table.row( this ).data();
            $('#no_asset_pny').val(data["no_asset"]);
            $('#asset_pny').val(data["asset"]);
            $('#kat_asset_pny').val(data["kategori"]);
            $('#nilai_pny').val(data["nilai_penyusutan"]);
            loadAkun();
            loadGridPenyusutan();
            $('.close').click();
        });

        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });

        $('#harga_perolehan').on('input', function() {
            $('#format_jml').html(moneyFormat.to(parseInt($(this).val())));
        });
    });

    
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    $('#reset_pny').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
        saveAsset();
    	resetForm();
    });

    $('#save_pny').click(function(){
        savePenyusutan();
    	resetForm();
    });

    $('#batal_asset').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Transaksi...?');
        if(tanya==true){
            batalAsset();
            resetForm();
        }else{
            return false;
        }
    });

    $('#batal_penyusutan').click(function(){
        var tanya = confirm('Anda Yakin Membatalkan Penyusutan...?');
        if(tanya==true){
            batalPenyusutan();
            resetForm();
        }else{
            return false;
        }
    });

    function loadAkun(){
        var no_asset_pny = $('#no_asset_pny').val();
		$.getJSON(urlAPI+'/app/module/asset/akun_load.php', {no_asset_pny:no_asset_pny}, function(json) {
            $('#akun_dua').val(json.akun_dua);
            $('#akun_tiga').val(json.akun_tiga);  
		});
    }

    function loadGridPenyusutan(){
        var no_asset_pny = $('#no_asset_pny').val();
        $.ajax({
            url: urlAPI+'/app/module/asset/grid_penyusutan.php',
            method: 'POST',
            data: {no_asset_pny:no_asset_pny},
            success:function(data){
                $('#grid_transaksi').html(data);
            }
        });
    }

    function saveAsset(){
        var no_asset = $('#no_asset').val();
        var asset = $('#asset').val();
        var kode_kat_asset = $('#kode_kat_asset').val();
        var kat_asset = $('#kat_asset').val();
        var periode = $('#periode').val();
        var tgl_perolehan = $('#tgl_perolehan').val();
        var sumber_dana = $('#sumber_dana').val();
        var pos_dana = $('#pos_dana').val();
        var umur_ekonomis = $('#umur_ekonomis').val();
        var satuan = $('#satuan').val();
        var harga_perolehan = $('#harga_perolehan').val();
        var nilai_residu = $('#nilai_residu').val();
        var nilai_penyusutan = $('#nilai_penyusutan').val();
        var kode_akun_asset = $('#kode_akun_asset').val();
        var akun_asset = $('#akun_asset').val();
        var kode_akun_debit = $('#kode_akun_debit').val();
        var akun_debit = $('#akun_debit').val();
        var kode_akun_kredit = $('#kode_akun_kredit').val();
        var akun_kredit = $('#akun_kredit').val();
        var no_rekening = $('#no_rekening').val();
		$.ajax({
			url:  urlAPI+"/app/module/asset/asset_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                no_asset:no_asset,
                asset:asset,
                kode_kat_asset:kode_kat_asset,
                kat_asset:kat_asset,
                periode:periode,
                tgl_perolehan:tgl_perolehan,
                sumber_dana:sumber_dana,
                pos_dana:pos_dana,
                umur_ekonomis:umur_ekonomis,
                satuan:satuan,
                harga_perolehan:harga_perolehan,
                nilai_residu:nilai_residu,
                nilai_penyusutan:nilai_penyusutan,
                kode_akun_asset:kode_akun_asset,
                akun_asset:akun_asset,
                kode_akun_debit:kode_akun_debit,
                akun_debit:akun_debit, 
                kode_akun_kredit:kode_akun_kredit,
                akun_kredit:akun_kredit,
                no_rekening:no_rekening
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function savePenyusutan(){
        var no_asset_pny = $('#no_asset_pny').val();
        var asset_pny = $('#asset_pny').val();
        var kat_asset_pny = $('#kat_asset_pny').val();
        var periode_pny = $('#periode_pny').val();
        var tgl_penyusutan = $('#tgl_penyusutan').val();
        var nilai_pny = $('#nilai_pny').val();
        var akun_dua = $('#akun_dua').val();
        var akun_tiga = $('#akun_tiga').val();
		$.ajax({
			url:  urlAPI+"/app/module/asset/penyusutan_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                no_asset_pny:no_asset_pny,
                asset_pny:asset_pny,
                kat_asset_pny:kat_asset_pny,
                periode_pny:periode_pny,
                tgl_penyusutan:tgl_penyusutan,
                nilai_pny:nilai_pny,
                akun_dua:akun_dua,
                akun_tiga:akun_tiga
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalAsset(){
        var no_batal_asset = $('#no_batal_asset').val();
		$.ajax({
			url:  urlAPI+"/app/module/asset/batal_asset.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_batal_asset:no_batal_asset
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function batalPenyusutan(){
        var no_batal_penyusutan = $('#no_batal_penyusutan').val();
		$.ajax({
			url:  urlAPI+"/app/module/asset/batal_penyusutan.php",
			type: 'POST',
			dataType: 'json',
			data: {
				no_batal_penyusutan:no_batal_penyusutan
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
        $('.konten').load('325_asset/asset.php');
    }

});