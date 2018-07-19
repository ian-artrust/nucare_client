$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    $(function () {

        $('#lookup_mustahik').DataTable({
            "ajax": urlAPI+"/app/module/mustahik/get_mustahik.php",
            "columns": [
                {"data": "no_registrasi" },
                {"data": "nama_mustahik" },
                {"data": "nik" },
            ]
        });
    
        $('#lookup_mustahik tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_mustahik').DataTable();
            var data = table.row( this ).data();
            $('#no_registrasi').val(data["no_registrasi"]);
            $('#nama_mustahik').val(data["nama_mustahik"]);
            loadGridMustahik();
            $('.close').click();
        });
    
        $('#lookup_entitas').DataTable({
            "ajax": urlAPI+"/app/module/mustahik_entitas/get_mustahik_entitas.php",
            "columns": [
                {"data": "no_registrasi" },
                {"data": "nama_lembaga" },
                {"data": "no_hp" },
            ]
        });
    
        $('#lookup_entitas tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_entitas').DataTable();
            var data = table.row( this ).data();
            $('#no_registrasi').val(data["no_registrasi"]);
            $('#nama_mustahik').val(data["nama_lembaga"]);
            loadGridMustahik();
            $('.close').click();
        });
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#load_mustahik').click(function(){
    	loadMustahik();
    });

    $('#load_mustahik_entitas').click(function(){
    	loadMustahikEntitas();
    });


    function loadGridMustahik(){
        var no_registrasi = $('#no_registrasi').val();
        var nama_mustahik = $('#nama_mustahik').val();
        $.ajax({
            url: urlAPI+'/app/module/lap_mustahik/grid_mustahik.php',
            method: 'POST',
            data: {no_registrasi:no_registrasi,nama_mustahik:nama_mustahik},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function loadMustahik() {
		$.ajax({
            url:urlAPI+'/app/module/lap_mustahik/load_mustahik.php',
            type:'POST',
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function loadMustahikEntitas(){
		$.ajax({
            url:urlAPI+'/app/module/lap_mustahik/load_mustahik_entitas.php',
            type:'POST',
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function resetForm(){
        $('.konten').load('433_lap_mustahik/lap_mustahik.php');
    }

});