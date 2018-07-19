function cek_login()
{

	/*
    * event ketika tombol Cari Di Klik Maka Akan Memanggil function prosesAjax
    */
	$('.login-btn').click(function(){
		loginAjax();
	});

    /*
    * event ketika tombol Ketika Menekan Tombol Enter Pada Keyboard
    * Maka Akan Memanggil function prosesAjax
    */
	$('form').submit(function(e){
		e.preventDefault();
		loginAjax();
	});
}

function loginAjax()
{
	/* Mengambil Data Dari Textbox */
	var username = $('#username').val();
	var password = $('#password').val();

	var path_login = "http://localhost/nucare_api/bin/login.php";
	// var path_login = "http://153.92.4.115/nucare_api/bin/login.php";

	/* Menggunakan Ajax */
	$.ajax({
		url 		: path_login,
		data 		: {username:username, password:password},
		type 		: 'POST',
		dataType	: 'html',
		success:function(response){
			var data = $.parseJSON(response);
			if(data.level=="Administrator"){
				alert(data.pesan);
				window.location='module/dashboard.php';
			}else if(data.level=="AD"){
				alert(data.pesan);
				window.location='module/dashboard_ad.php';
			}else if(data.level=="FO"){
				alert(data.pesan);
				window.location='module/dashboard_fo.php';
			}else if(data.level=="ZISR"){
				alert(data.pesan);
				window.location='module/dashboard_zisr.php';
			}else if(data.level=="KL"){
				alert(data.pesan);
				window.location='module/dashboard_kl.php';
			}else if(data.level=="Program"){
				alert(data.pesan);
				window.location='module/dashboard_prg.php';
			}else if(data.level=="Akuntan"){
				alert(data.pesan);
				window.location='module/dashboard_keu.php';
			}else if(data.level=="Direktur"){
				alert(data.pesan);
				window.location='module/dashboard_dir.php';
			} else {
				alert(data.pesan);
				// window.location='index.php';
			}

		}, 

		error: function(response){
			var data = $.parseJSON(response);
			alert(data.pesan);
			window.location='index.php';
		}
	});
}