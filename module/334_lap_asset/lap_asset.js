$(document).ready(function() {
	var server = $('#server').val();
    var urlAPI = server;
    
    $(function () {

        $('#lookup_transaksi').DataTable( {
		    "ajax": urlAPI+"/app/module/lap_asset/get_asset_pny.php",
		    "columns": [
			    {"data": "no_asset" },
                {"data": "asset" },
                {"data": "kategori" },
                {"data": "nilai_penyusutan" },
		    ]
        });

        $('#lookup_transaksi tbody').on('click', 'tr', function (e) {
            var table = $('#lookup_transaksi').DataTable();
            var data = table.row( this ).data();
            $('#no_asset_pny').val(data["no_asset"]);
            $('#asset_pny').val(data["asset"]);
            $('#kat_asset_pny').val(data["kategori"]);
            $('#nilai_pny').val(data["nilai_penyusutan"]);
            loadGridPenyusutan();
            $('.close').click();
        });
    });
   
    /* BUTTON EVENT */

    /* RESET */
    $('#load_asset').click(function(){
    	loadAsset();
    });


    function loadGridPenyusutan(){
        var no_asset_pny = $('#no_asset_pny').val();
        var asset_pny = $('#asset_pny').val();
        $.ajax({
            url: urlAPI+'/app/module/lap_asset/grid_penyusutan.php',
            method: 'POST',
            data: {no_asset_pny:no_asset_pny,asset_pny:asset_pny},
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function loadAsset() {
		$.ajax({
            url:urlAPI+'/app/module/lap_asset/load_asset.php',
            type:'POST',
            success:function(data){
                $('#data-here').html(data);
            }
        });
    }

    function resetForm(){
        $('.konten').load('334_lap_asset/lap_asset.php');
    }

});