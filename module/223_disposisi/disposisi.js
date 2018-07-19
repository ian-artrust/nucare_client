$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;

	$(function () {
		$('#datetimepicker1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#datetimepicker2').datetimepicker({
			format:'YYYY-MM-DD'
		});
	});
	/* LOAD DATA TABLES LIBRARY */
    table = $('#tabeldisposisi').DataTable( {
        "ajax": urlAPI+"/app/module/disposisi/get_disposisi.php",
        "lengthMenu": [[3, 5, 7, -1], [3, 5, 7, "All"]],
		"columns": [
			{"data": "no_disposisi" },
          	{"data": "perihal" },
			{"data": "pengirim" },
            {"data": "tgl_surat" },
			{"data": "no_surat" },
		]
    });

	$('#tabeldisposisi tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#no_disposisi').val(data["no_disposisi"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#no_disposisi').focus();
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
    	saveDisposisi();
	});
	
	/* DELETE */
	$('#delete').click(function(){
		tanya = confirm('Anda Yakin Akan Menghapus Data..?');
		if(tanya==true){
			deleteDisposisi();
			resetForm();
			$('.konten').load('223_disposisi/disposisi.php');
		}else{
			return false;
		}
	});

    /* CUSTOM FUNCTION */
	function resetForm()
	{
		$('#save').removeAttr('disabled');
		$('#update').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('input[type=text]').each(function(){
			$(this).val("");
		});
	}

	function loadData(){
		var aksi = "load";
		var no_disposisi = $('#no_disposisi').val();
		$.getJSON(urlAPI+'/app/module/disposisi/disposisi_load.php', {no_disposisi:no_disposisi}, function(json) {
			$('#no_agenda').val(json.no_agenda);
			$('#pengirim').val(json.pengirim);
			$('#no_surat').val(json.no_surat);
			$('#tgl_surat').val(json.tgl_surat);
            $('#tertanggal_surat').val(json.tertanggal_surat);
            $('#perihal').val(json.perihal);
			$('#catatan_penerima').val(json.catatan_penerima);
		});
	}

	function saveDisposisi(){
		var no_agenda = $('#no_agenda').val();
		var pengirim = $('#pengirim').val();
		var no_surat = $('#no_surat').val();
        var tgl_surat = $('#tgl_surat').val();
        var tertanggal_surat = $('#tertanggal_surat').val();
        var deliver_to = $('#deliver_to').val();
		var perihal = $('#perihal').val();
		var catatan_penerima = $('#catatan_penerima').val();
		$.ajax({
			url:  urlAPI+"/app/module/disposisi/disposisi_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				aksi:'save',
				no_agenda:no_agenda,
				pengirim:pengirim,
				no_surat:no_surat,
				tgl_surat:tgl_surat,
				tertanggal_surat:tertanggal_surat,
				deliver_to:deliver_to,
				perihal:perihal,
				catatan_penerima:catatan_penerima 
			},
			success : function(data){
				alert(data.pesan);
				$('.konten').load('223_disposisi/tanda_terima.php','no_disposisi='+data.no_disposisi);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function deleteDisposisi(){
		var no_disposisi = $('#no_disposisi').val();
		$.ajax({
			url:  urlAPI+"/app/module/disposisi/disposisi_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'no_disposisi':no_disposisi
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