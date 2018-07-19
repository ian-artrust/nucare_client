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
                  <li><a class="klik" id="111" href="#">1.1.1-User</a></li>
                  <li><a class="klik" id="112" href="#">1.1.2-Petugas</a></li>
                  <li><a class="klik" id="113" href="#">1.1.3-Kat.Asset</a></li>
                  <li><a class="klik" id="114" href="#">1.1.4-Periode</a></li>
                </ul>
              </li>
              <li><a href="#">1.2-Transaksi</a></li>
              <li class="divider"></li>
              <li class="dropdown-submenu">
                <a href="#">1.3-Laporan</a>
                  <ul class="dropdown-menu">
                    <li><a class="klik" id="131" href="#">1.3.1-Operasional Ramadhan</a></li>
                  </ul>
              </li>
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
                      <li><a class="klik" id="212" href="#">2.1.2-K.Layanan</a></li>
                      <li><a class="klik" id="213" href="#">2.1.3-Mustahik</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a href="#">2.2-Transaksi</a>
                    <ul class="dropdown-menu">
                    <li><a class="klik" id="221" href="#">2.2.1-Donasi</a></li>
                    <li><a class="klik" id="222" href="#">2.2.2-Batal Donasi</a></li>
                    <li><a class="klik" id="223" href="#">2.2.3-Pengajuan Individu</a></li>
                    <li><a class="klik" id="224" href="#">2.2.4-Pengajuan Lembaga</a></li>
                    <li><a class="klik" id="225" href="#">2.2.5-Disposisi</a></li>
                    <li><a class="klik" id="226" href="#">2.2.6-Satus Pengajuan</a></li>
                    <li><a class="klik" id="227" href="#">2.2.7-Donasi KL</a></li>
                    <li><a class="klik" id="228" href="#">2.2.8-Setoran Penghimpunan</a></li>
                    </ul>
                  </li>
                  <li class="divider"></li>
                  <li class="dropdown-submenu">
                    <a href="#">2.3-Laporan</a>
                    <ul class="dropdown-menu">
                      <li><a class="klik" id="231" href="#">2.3.1-Master</a></li>
                      <li><a class="klik" id="232" href="#">2.3.2-Transaksi</a></li>
                      <li><a class="klik" id="233" href="#">2.3.3-Transaksi KL</a></li>
                    </ul>
                  </li>
              </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
              <span class="glyphicon glyphicon-btc"></span> 3.Keuangan
            </a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a href="#">3.1-Master</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="311" href="#">3.1.1-Bank</a></li>
                  <li><a class="klik" id="312" href="#">3.1.2-Bank KL</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">3.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="321" href="#">3.2.1-Setup Saldo</a></li>
                  <li><a class="klik" id="322" href="#">3.2.2-Kas</a></li>
                  <li><a class="klik" id="323" href="#">3.2.3-Bank</a></li>
                  <li><a class="klik" id="324" href="#">3.2.4-Mutasi</a></li>
                  <li><a class="klik" id="325" href="#">3.2.5-Piutang</a></li>
                  <li><a class="klik" id="326" href="#">3.2.6-Asset</a></li>
                  <li><a class="klik" id="327" href="#">3.2.7-Hutang</a></li>
                  <li><a class="klik" id="328" href="#">3.2.8-Validasi Setoran</a></li>
                  <li><a class="klik" id="329" href="#">3.2.9-Pendistribusian</a></li>
                </ul>
              </li>
              <li><a href="#">3.3-Laporan</a></li> 
            </ul>
          </li>
          <li class="dropdown">
          <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-book"></span> 4.Program
          </a>
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a href="#">4.1-Master</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="411" href="#">4.1.1-Mustahik</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">4.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="421" href="#">4.2.1-Rekomendasi</a></li>
                </ul>
              </li>
              <li><a href="#">4.3-Laporan</a></li> 
            </ul>
          </li>
          <li class="dropdown">
          <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
          <span class="glyphicon glyphicon-certificate"></span> 5.Direktur
          </a>
            <ul class="dropdown-menu">
              <li><a href="#">5.1-Master</a></li>
              <li class="dropdown-submenu">
                <a href="#">5.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="521" href="#">5.2.1-Approval</a></li>
                </ul>
              </li>
              <li><a href="#">5.3-Laporan</a></li> 
            </ul>
          </li>
          <li class="dropdown">
          <a class="dropdown-toggle" style="color:#FFFFFF" data-toggle="dropdown" href="#">
          <span class="glyphicon glyphicon-list-alt"></span> 6.Akuntansi
          </a>
            <ul class="dropdown-menu">
              <li><a href="#">6.1-Master</a></li>
              <li><a href="#">6.2-Transaksi</a></li>
              <li><a href="#">6.3-Laporan</a></li> 
            </ul>
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
            }else if(menu == "112"){
              $('.konten').load('112_petugas/petugas.php'); 
            }else if(menu == "113"){
              $('.konten').load('113_kat_asset/kat_asset.php');
            }else if(menu == "114"){
              $('.konten').load('114_periode/periode.php');
            }else if(menu == "131"){
              $('.konten').load('131_lap_ramadhan/lap_ramadhan.php');       
            }else if(menu == "211"){
              $('.konten').load('211_muzaki/muzaki.php');
            }else if(menu == "212"){
              $('.konten').load('212_kl/kantor_layanan.php');
            }else if(menu == "213"){
              $('.konten').load('213_mustahik/mustahik.php');  
            }else if(menu == "221"){
              $('.konten').load('221_donasi/donasi.php');
            }else if(menu == "222"){
              $('.konten').load('222_batal_donasi/batal_donasi.php');
            }else if(menu == "227"){
              $('.konten').load('227_donasi_kl/donasi_kl.php');
            }else if(menu == "228"){
              $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
            }           
          });

          //Router Menu Keypress Event
          $('#key_menu').keydown(function(e){
              if(e.keyCode == 13){
                var menu = $('#key_menu').val();
                if(menu == "0"){
                  $('.konten').load('home.php');                  
                }else if(menu == "111"){
                  $('.konten').load('111_user/user.php'); 
                }else if(menu == "112"){
                  $('.konten').load('112_petugas/petugas.php'); 
                }else if(menu == "113"){
                  $('.konten').load('113_kat_asset/kat_asset.php'); 
                }else if(menu == "114"){
                  $('.konten').load('114_periode/periode.php');
                }else if(menu == "131"){
                  $('.konten').load('131_lap_ramadhan/lap_ramadhan.php');      
                }else if(menu == "211"){
                  $('.konten').load('211_muzaki/muzaki.php');
                }else if(menu == "212"){
                  $('.konten').load('212_kl/kantor_layanan.php');
                }else if(menu == "213"){
                  $('.konten').load('213_mustahik/mustahik.php');  
                }else if(menu == "221"){
                  $('.konten').load('221_donasi/donasi.php');
                }else if(menu == "222"){
                  $('.konten').load('222_batal_donasi/batal_donasi.php');
                }else if(menu == "227"){
                  $('.konten').load('227_donasi_kl/donasi_kl.php');
                }else if(menu == "228"){
                  $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');       
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