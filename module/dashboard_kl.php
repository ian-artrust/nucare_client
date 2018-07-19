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
              <ul class="dropdown-menu">
                  <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">2.1-Master</a>
                    <ul class="dropdown-menu">
                      <li><a class="klik" id="211" href="#">2.1.1-Muzaki</a></li>
                      <!-- <li><a class="klik" href="#">2.1.2-Fitur Terkunci</a></li>
                      <li><a class="klik" id="213" href="#">2.1.3-Mustahik</a></li>
                      <li><a class="klik" id="214" href="#">2.1.4-Mustahik Entitas</a></li> -->
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a href="#">2.2-Transaksi</a>
                    <ul class="dropdown-menu">
                      <li><a class="klik" href="#">2.2.1-Fitur Terkunci</a></li>
                      <li><a class="klik" href="#">2.2.2-Fitur Terkunci</a></li>
                      <li><a class="klik" href="#">2.2.3-Fitur Terkunci</a></li>
                      <li><a class="klik" href="#">2.2.4-Fitur Terkunci</a></li>
                      <li><a class="klik" href="#">2.2.5-Fitur Terkunci</a></li>
                      <li><a class="klik" href="#">2.2.6-Fitur Terkunci</a></li>
                      <li><a class="klik" id="227" href="#">2.2.7-Donasi KL</a></li>
                      <li><a class="klik" id="228" href="#">2.2.8-Setoran Penghimpunan</a></li>
                      <li><a class="klik" id="229" href="#">2.2.9-Donasi Non Tunai</a></li>
                    </ul>
                  </li>
                  <li class="divider"></li>
                  <li class="dropdown-submenu">
                    <a href="#">2.3-Laporan</a>
                    <ul class="dropdown-menu">
                      <li><a class="klik" id="231" href="#">2.3.1-Muzaki</a></li>
                      <li><a class="klik" href="#">2.3.2-Fitur Terkunci</a></li>
                      <li><a class="klik" id="233" href="#">2.3.3-Transaksi KL</a></li>
                      <li><a class="klik" id="234" href="#">2.3.4-Laporan Pengajuan</a></li>
                    </ul>
                  </li>
              </ul>
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
            if(menu == "211"){
               $('.konten').load('211_muzaki_kl/muzaki_kl.php'); 
            }else if(menu == "113"){
              $('.konten').load('113_rubah_password/rubah_password.php');
            // }else if(menu == "213"){
            //    $('.konten').load('213_mustahik/mustahik.php');  
            // }else if(menu == "214"){
            //   $('.konten').load('214_mustahik_entitas/mustahik_entitas.php');   
            // }else if(menu == "224"){
              // alert("Menu Pengajuan Belum Dapat Diakses Untuk Saat Ini");
              // $('.konten').load('224_pengajuan/pengajuan.php');    
            }else if(menu == "227"){
              $('.konten').load('227_donasi_kl/donasi_kl.php');
            }else if(menu == "228"){
              $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
            }else if(menu == "229"){
              $('.konten').load('229_non_tunai/non_tunai.php');
            }else if(menu == "231"){
              $('.konten').load('231_lap_muzaki/lap_muzaki.php'); 
            }else if(menu == "233"){
              $('.konten').load('233_lap_transaksi_kl/lap_transaksi_kl.php');       
            }else if(menu == "234"){
              $('.konten').load('234_lap_pengajuan_kl/lap_pengajuan_kl.php');   
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
                }else if(menu == "211"){
                  $('.konten').load('211_muzaki_kl/muzaki_kl.php'); 
                // }else if(menu == "213"){
                //   $('.konten').load('213_mustahik/mustahik.php'); 
                // }else if(menu == "214"){
                //   $('.konten').load('214_mustahik_entitas/mustahik_entitas.php');   
                // }else if(menu == "224"){
                  // alert("Menu Pengajuan Belum Dapat Diakses Untuk Saat Ini");
                  // $('.konten').load('224_pengajuan/pengajuan.php');                    
                }else if(menu == "227"){
                  $('.konten').load('227_donasi_kl/donasi_kl.php');  
                }else if(menu == "228"){
                  $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
                }else if(menu == "229"){
                  $('.konten').load('229_non_tunai/non_tunai.php');
                }else if(menu == "231"){
                  $('.konten').load('231_lap_muzaki/lap_muzaki.php');   
                }else if(menu == "233"){
                  $('.konten').load('233_lap_transaksi_kl/lap_transaksi_kl.php');
                }else if(menu == "234"){
                  $('.konten').load('234_lap_pengajuan_kl/lap_pengajuan_kl.php');             
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