 function cekSession()
{
    /* $.ajax({
    url     : "../../bin/session.php",
    type    : 'GET',
    dataType  : 'html',
    success:function(response){
      var data = $.parseJSON(response);
      sess_username = data.username;
      sess_password = data.password;
      sess_level = data.level;
      sess_kode_petugas = data.kode_petugas;
      sess_status = data.status;
      console.log(sess_level);
      if(data.level==null || data.level==""){
        window.location='../../index.html';
      }
    },
    error:function(response){
      var data = $.parseJSON(response);
      response = data.response;
      console.log(response);
      window.location='../../index.html';
    }
  });*/

  // $.post("../../bin/session.php");   
  // $('body').load('../../bin/session.php');
  /*$.ajax({
    type: "POST",
    url: "../../bin/session.php",
    success:function(html){
      $("body").append(html);
      //window.location='../../module/view/dashboard.html';
      // window.location='../../index.html';
    },
    error:function(response){
      $("body").append(html);
      //window.location='../../index.html';
      // window.location='../../module/view/dashboard.html';
    }
  });   */
 
}