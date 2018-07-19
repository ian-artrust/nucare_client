$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    $(function () {
		$('#dtpj1').datetimepicker({
			format:'YYYY-MM-DD'
		});
	
		$('#dtpj2').datetimepicker({
			format:'YYYY-MM-DD'
        });
    });

	$("#load_pengajuan").click(function(){
        loadPengajuan();
	});
	
	$("#cetak").click(function(){
        $('#data-here').printArea();
    });

	function loadPengajuan(){
        var dari_pj = $('#dari_pj').val();
		var sampai_pj = $('#sampai_pj').val();
		$.ajax({
            url:urlAPI+'/app/module/pj_penyaluran/load_pengajuan.php',
            type:'POST',
            data:{dari_pj:dari_pj, sampai_pj:sampai_pj},
            success:function(data){
                $('#data-here').html(data);
            }
        });
	}
});