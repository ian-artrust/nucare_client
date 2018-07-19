$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    var urlGetComboPeriode     = urlAPI+'/app/lib/combo_periode.php';

    $(function () {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        });

        /** Combobox Periode Ajax */
        $.getJSON(urlGetComboPeriode,function(json){
            $('#periode').html('');
            $.each(json, function(index, row) {
                $('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });

        $('#tabel_alokasi').DataTable( {
            "ajax": urlAPI+"/app/module/jurnal_umum/get_jurnal.php",
            "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
		    "columns": [
                {"data": "no_jurnal" },
                {"data": "akun" },
                {"data": "keterangan" },
                {"data": "tgl_jurnal" },
                {"data": "periode" },
                {"data": "debit" },
                {"data": "kredit" },
		    ]
        });

        $('#lookup_akun_debit').DataTable( {
		    "ajax": urlAPI+"/app/module/jurnal_umum/lookup_akun_debit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
        });

        $('#lookup_akun_kredit').DataTable( {
		    "ajax": urlAPI+"/app/module/jurnal_umum/lookup_akun_kredit.php",
		    "columns": [
			    {"data": "kode_akun" },
                {"data": "akun" },
                {"data": "kategori" },
		    ]
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

        var moneyFormat = wNumb({
             mark: ',',
             decimals: 0,
             thousand: '.',
             prefix: '',
             suffix: ''
        });
    });

    
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
        saveAsset();
    	resetForm();
    });

    $('#load_pnr').click(function(){
        var alokasi = $('#alokasi').val();
        if(alokasi==''){
            alert('Presentase Penerimaan Harap Diisi');
        }else{
            loadAlokasi();
        }

    });

    $('#hitung').click(function(){
        var alokasi = $('#alokasi').val();
        if(alokasi==''){
            alert('Presentase Penerimaan Harap Diisi');
        }else{
            alokasiAmil();
        }

    });

    function loadAlokasi(){
        var alokasi = $('#alokasi').val();
        var jenis = $('#jenis').val();
        var periode = $('#periode').val();
        var tgl_jurnal = $('#tgl_jurnal').val();
		$.getJSON(urlAPI+'/app/module/jurnal_umum/get_alokasi.php', {alokasi:alokasi,jenis:jenis, periode:periode,tgl_jurnal:tgl_jurnal}, function(json) {
			$('#jml_penerimaan').val(json.kredit);
		});
    }

    function alokasiAmil(){
        var jml_penerimaan = $('#jml_penerimaan').val();
        var alokasi = $('#alokasi').val();
        var hasil_amil = (parseFloat(jml_penerimaan)/100) * parseFloat(alokasi);
        var alokasi_amil = Math.round(hasil_amil);
        $('#jml_alokasi').val(alokasi_amil);
    }

    function saveAsset(){
        var periode = $('#periode').val();
        var tgl_jurnal = $('#tgl_jurnal').val();
        var keterangan = $('#keterangan').val();
        var jml_alokasi = $('#jml_alokasi').val();
        var kode_akun_debit = $('#kode_akun_debit').val();
        var akun_debit = $('#akun_debit').val();
        var kode_akun_kredit = $('#kode_akun_kredit').val();
        var akun_kredit = $('#akun_kredit').val();
		$.ajax({
			url:  urlAPI+"/app/module/jurnal_umum/jurnal_umum_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                periode:periode,
                tgl_jurnal:tgl_jurnal,
                keterangan:keterangan,
                jml_alokasi:jml_alokasi,
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

    function resetForm(){
        $('.konten').load('621_jurnal_umum/jurnal_umum.php');
    }

});