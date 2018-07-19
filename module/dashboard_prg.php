<?php
session_start();

if(!$_SESSION){

  header("location:../index.php");

} else {

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Halaman Utama</title>
    
    <!-- Bootstrap core CSS -->
    <link href="../lib/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/css/menu.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../lib/twbs/bootstrap/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../lib/twbs/bootstrap/docs/examples/dashboard/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script type="text/javascript">
      function konfirmasi()
        {
          tanya = confirm('Anda Yakin Akan Keluar..?');
          if(tanya==true){
            window.location = '../bin/logout.php';
          } else {
            return false;
          }
        }
    </script>
    <style>
      .navbar, .navbar-header{
        background-color:#007000;
      }

      @font-face{
        font-family: "sqr";
        src: url('../lib/fonts/square721.ttf');
      }

      html, body {
        font-family: "sqr";
      }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>
  <input type="hidden" name="server" id="server" value='<?php echo $_SESSION['server']; ?>'>
    <!-- TOP MENU -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="color:#FFFFFF" href="#">NUCARE</a>
      </div>

      <ul class="nav navbar-nav">
        <div class="navbar-form navbar-left" role="search">
          <input type="text" class="form-control" placeholder="Masukan No Menu" id="key_menu" name="key_menu">
        </div>
      </ul>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">       
          <li class="dropdown">
            <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
              <span class="glyphicon glyphicon-cog"></span> 1.Setting
            </a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">1.1-Master</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" href="#">1.1.1-Fitur Terkunci</a></li>
                  <li><a class="klik" href="#">1.1.2-Fitur Terkunci</a></li>
                  <li><a class="klik" id="113" href="#">1.1.3-Rubah Password</a></li>
                </ul>
              </li>
              <li><a href="#">1.2-Transaksi</a></li>
              <li class="divider"></li>
              <li><a href="#">1.3-Laporan</a></li>
            </ul>
          </li>
          <li class="dropdown" id="accountmenu">
              <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
                <span class="glyphicon glyphicon-star"></span> 2.Pelayanan
              </a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
              <span class="glyphicon glyphicon-btc"></span> 3.Keuangan
            </a>
          </li>
          <li class="dropdown">
          <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-book"></span> 4.Program
          </a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a href="#">4.1-Master</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="411" href="#">4.1.1-Program Penerimaan</a></li>
                  <li><a class="klik" id="412" href="#">4.1.2-Mustahik</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">4.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="421" href="#">4.2.1-Jadwal Survey</a></li>
                  <li><a class="klik" id="422" href="#">4.2.2-Asesmen</a></li>
                  <li><a class="klik" id="423" href="#">4.2.3-Rekomendasi</a></li>
                  <li><a class="klik" id="424" href="#">4.2.4-Pengajuan Penyaluran</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">4.3-Laporan</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="431" href="#">4.3.1-Laporan Pengajuan</a></li>
                  <li><a class="klik" id="432" href="#">4.3.2-Laporan Penyaluran</a></li>
                  <li><a class="klik" id="433" href="#">4.3.3-Laporan Mustahik</a></li>
                </ul>
              </li> 
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-certificate"></span> 5.Direktur
            </a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-list-alt"></span> 6.Akuntansi
            </a>
          </li>
          <li class="dropdown navbar-right">
            <a href="#" style="color:#FFFFFF" onclick="konfirmasi()">
              <span class="glyphicon glyphicon-log-in"></span> Logout
            </a>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </nav>

  <div class="konten">
    
  </div>

    <!-- FOOTER -->
  <!-- <nav style="color:#FFFFFF" class="navbar navbar-default navbar-fixed-bottom navbar-right">
    <br>
    Copyright &copy;2016 LazisMU
  </nav> -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../twbs/bootstrap/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../lib/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../lib/twbs/bootstrap/docs/assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../lib/twbs/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {
          $('#key_menu').focus();

          $('label.tree-toggler').click(function () {
              $(this).parent().children('ul.tree').toggle(300);
          });

          // halaman yang di load default pertama kali
          $('.konten').load('home.php');

          //Router Menu Mouse Click Event
          $('.klik').click(function(){
            var menu = $(this).attr('id');
            if(menu == "111"){
              $('.konten').load('111_user/user.php'); 
            }else if(menu == "113"){
              $('.konten').load('113_rubah_password/rubah_password.php');
            }else if(menu == "411"){
              $('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
            }else if(menu == "412"){
              $('.konten').load('412_mustahik/mustahik.php');
            }else if(menu == "421"){
              $('.konten').load('421_jadwal_survey/jadwal_survey.php');
            }else if(menu == "423"){
              $('.konten').load('423_rekomendasi/rekomendasi.php');
            }else if(menu == "424"){
              $('.konten').load('424_pj_penyaluran/pj_penyaluran.php');
            }else if(menu == "431"){
              $('.konten').load('431_lap_pengajuan/lap_pengajuan.php');
            }else if(menu == "432"){
              $('.konten').load('432_lap_penyaluran/lap_penyaluran.php');
            }else if(menu == "433"){
              $('.konten').load('433_lap_mustahik/lap_mustahik.php');
            }    
          });

          //Router Menu Keypress Event
          $('#key_menu').keydown(function(e){
              if(e.keyCode == 13){
                var menu = $('#key_menu').val();
                if(menu == "0"){
                  $('.konten').load('home.php');  
                }else if(menu == "113"){
                  $('.konten').load('113_rubah_password/rubah_password.php');                
                }else if(menu == "411"){
                  $('.konten').load('411_prg_penerimaan/prg_penerimaan.php');
                }else if(menu == "412"){
                  $('.konten').load('412_mustahik/mustahik.php');
                }else if(menu == "421"){
                  $('.konten').load('421_jadwal_survey/jadwal_survey.php');
                }else if(menu == "423"){
                  $('.konten').load('423_rekomendasi/rekomendasi.php'); 
                }else if(menu == "424"){
                  $('.konten').load('424_pj_penyaluran/pj_penyaluran.php');
                }else if(menu == "431"){
                  $('.konten').load('431_lap_pengajuan/lap_pengajuan.php');
                }else if(menu == "432"){
                  $('.konten').load('432_lap_penyaluran/lap_penyaluran.php');
                }else if(menu == "433"){
                  $('.konten').load('433_lap_mustahik/lap_mustahik.php');
                }else if(menu == "999"){
                  konfirmasi();                   
                }
              }
          });
      });      
    </script>
  </body>
</html>
<?php } ?>