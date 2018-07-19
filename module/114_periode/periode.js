$(document).ready(function() {
	resetForm();
	var table;
	var server = $('#server').val();
	var urlAPI = server;
	
	/* LOAD DATA TABLES LIBRARY */
	table = $('#tabelperiode').DataTable( {
		"ajax": urlAPI+"/app/module/periode/get_periode.php",
		"columns": [
			{"data": "periode" },
          	{"data": "status" },
		]
	});

	$('#tabelperiode tbody').on('click', 'tr', function () {
		resetForm();
		var data = table.row(this).data();
        $('#periode').val(data["periode"]);
        loadData();
        $('#save').attr('disabled', 'disabled');
        $('#update').removeAttr('disabled');
        $('#delete').removeAttr('disabled');
        $('#periode').focus();
	});

    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#save').click(function(){
    	savePeriode();
    	resetForm();
    	$('.konten').load('114_periode/periode.php');
	});
	
	/* UPDATE */
    $('#update').click(function(){
    	updatePeriode();
		resetForm();
    	$('.konten').load('114_periode/periode.php');
	});
	
	/* DELETE */
	$('#delete').click(function(){
		deletePeriode();
		resetForm();
		$('.konten').load('114_periode/periode.php');
	});

    /* CUSTOM FUNCTION */
	function resetForm()
	{
		$('#save').removeAttr('disabled');
		$('#update').attr('disabled', 'disabled');
		$('#delete').attr('disabled', 'disabled');
		$('input[type=date]').each(function(){
			$(this).val("");
		});
	}

	function loadData(){
		var aksi = "load";
		var periode = $('#periode').val();
		$.getJSON(urlAPI+'/app/module/periode/periode_load.php', {aksi:aksi, periode:periode}, function(json) {
			$('#periode').val(json.periode);
		});
	}

	function savePeriode(){
		var periode = $('#periode').val();
		$.ajax({
			url:  urlAPI+"/app/module/periode/periode_save.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'save',
				'periode':periode
			},
			success : function(data){
				alert(data.pesan);
			}, 
			error: function(data){
				alert(data.pesan);
			}
		});
	}

	function updatePeriode(){

		alert("Periode Tidak Bisa Dirubah");
		// var periode = $('#periode').val();
		// $.ajax({
		// 	url:  urlAPI+"/app/module/periode/periode_update.php",
		// 	type: 'POST',
		// 	dataType: 'json',
		// 	data: {
		// 		'aksi':'update',
		// 		'periode':periode
		// 	},
		// 	success : function(data){
		// 		alert(data.pesan);
		// 	}, 
		// 	error: function(data){
		// 		alert(data.pesan);
		// 	}
		// });
	}

	function deletePeriode(){
		var periode = $('#periode').val();
		$.ajax({
			url:  urlAPI+"/app/module/periode/periode_delete.php",
			type: 'POST',
			dataType: 'json',
			data: {
				'aksi':'delete',
				'periode':periode
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