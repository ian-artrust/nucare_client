$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;

    $(function () {
        loadNamaPetugas();
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#reset').click(function(){
    	resetForm();
    });

    /* SAVE */
    $('#update').click(function(){
        updatePassword();
    	resetForm();
    });

    function loadNamaPetugas(){
        var kode_petugas = $('#kode_petugas').val();
		$.getJSON(urlAPI+'/app/module/rubah_password/petugas_load.php', {kode_petugas:kode_petugas}, function(json) {
            $('#nama_petugas').val(json.nama_petugas);
            $('#username').val(json.username);
		});
    }

    function updatePassword(){
        var kode_petugas = $('#kode_petugas').val();
        var nama_petugas = $('#nama_petugas').val();
        var username = $('#username').val();
        var new_password = $('#new_password').val();
		$.ajax({
			url:  urlAPI+"/app/module/rubah_password/password_update.php",
			type: 'POST',
			dataType: 'json',
			data: {
                'aksi':'save',
                'kode_petugas':kode_petugas,
                'nama_petugas':nama_petugas,
                'username':username,
				'new_password':new_password
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
        $('.konten').load('113_rubah_password/rubah_password.php');
    }

});