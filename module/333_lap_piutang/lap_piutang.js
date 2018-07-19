$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    $(function () {

        $('#lookup_kreditur_angsuran').DataTable( {
		    "ajax": urlAPI+"/app/module/lap_piutang/lookup_kreditur_angsuran.php",
		    "columns": [
			    {"data": "no_piutang" },
                {"data": "nama_kreditur" },
                {"data": "jml_piutang" },
                {"data": "sumber_dana" },
		    ]
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
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#load_piutang').click(function(){
    	loadPiutang();
    });

    function loadSisaPiutang(){
        var no_piutang_ang = $('#no_piutang_ang').val();
		$.getJSON(urlAPI+'/app/module/lap_piutang/sisa_piutang_load.php', {no_piutang_ang:no_piutang_ang}, function(json) {
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
        var nama_kreditur_ang = $('#nama_kreditur_ang').val();
        var jumlah_piutang = $('#jumlah_piutang').val();
        var sisa_piutang = $('#sisa_piutang').val();
        $.ajax({
            url: urlAPI+'/app/module/lap_piutang/grid_angsuran.php',
            method: 'POST',
            data: {
                no_piutang_ang:no_piutang_ang,
                nama_kreditur_ang:nama_kreditur_ang,
                jumlah_piutang:jumlah_piutang,
                sisa_piutang:sisa_piutang
            },
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function loadPiutang() {
		$.ajax({
            url:urlAPI+'/app/module/lap_piutang/load_piutang.php',
            type:'POST',
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function resetForm(){
        $('.konten').load('333_lap_piutang/lap_piutang.php');
    }

});