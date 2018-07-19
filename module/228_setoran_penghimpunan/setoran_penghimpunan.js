$(document).ready(function() {
	var server = $('#server').val();
	var urlAPI = server;
    var urlGetCombo     = urlAPI+'/app/lib/combo_periode.php';

    $(function() {
        $('#datetimepicker1').datetimepicker({
            format:'YYYY-MM-DD'
        });

        /** Combobox Periode Ajax */
        $.getJSON(urlGetCombo,function(json){
            $('#periode').html('')
            $.each(json, function(index, row) {
                $('#periode').append('<option value='+row.periode+'>'+row.periode+'</option>');
            });
        });
    });

    table = $('#tabel_setoran').DataTable( {
        "ajax": urlAPI+"/app/module/setoran_penghimpunan/get_setoran.php",
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

    $('#jml_setoran').on('input', function() {
        $('#format_mata_uang').html(moneyFormat.to(parseInt($(this).val())));
    });

    $('#jml_setoran').change(function() {

    });

    $('#lookup_bank tbody').on('click', 'tr', function (e) {
		var table = $('#lookup_bank').DataTable();
        var data = table.row( this ).data();
        $('#no_rekening').val(data["no_rekening"]);
        $('#nama_bank').val(data["nama_bank"]);
        $('#kode_akun').val(data["kode_akun"]);
        $('.close').click();
    });

    function cetak(){
        var no_setoran = $('#no_setoran').val();
        var penyetor = $('#penyetor').val();
		var periode = $('#periode').val();
        var tgl_setoran = $('#tgl_setoran').val();
        var jml_setoran = $('#jml_setoran').val();
        var no_rekening = $('#no_rekening').val();
        var no_bukti = $('#no_bukti').val();
        var jenis = $('#jenis').val();
        var kode_akun = $('#kode_akun').val();

		$.ajax({
			url:  urlAPI+"/app/module/setoran_penghimpunan/setoran_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				aksi:'save',
                no_setoran:no_setoran,
                penyetor:penyetor,
				periode:periode,
                tgl_setoran:tgl_setoran,
                jml_setoran:jml_setoran,
                no_rekening:no_rekening,
                no_bukti:no_bukti,
                jenis:jenis,
                kode_akun:kode_akun
			},
			success : function(data){
                alert(data.pesan);
                $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
                // $('.konten').load('228_setoran_penghimpunan/struk_setoran.php','no_setoran='+data.no_setoran);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
    }

    function clear() {
        $("#no_setoran").val("");
        $("#penyetor").val("");
        $("#no_rekening").val("");
        $("#nama_bank").val("");
		$("#jml_setoran").val("");
    }

    $('#reset').click(function(){
        $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
    });

    $('#cetak').click(function(){
        cetak();
    });

});