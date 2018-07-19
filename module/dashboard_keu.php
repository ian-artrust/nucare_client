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
            <ul class="dropdown-menu">
              <li class="dropdown-submenu">
                <a href="#">3.1-Master</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="311" href="#">3.1.1-Bank</a></li>
                  <li><a class="klik" id="312" href="#">3.1.2-Bank KL</a></li>
                  <li><a class="klik" id="313" href="#">3.1.3-Closing Kas Harian</a></li>
                  <li><a class="klik" id="314" href="#">3.1.4-Kreditur</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">3.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="321" href="#">3.2.1-Setup Saldo</a></li>
                  <li><a class="klik" id="322" href="#">3.2.2-Kas</a></li>
                  <li><a class="klik" id="323" href="#">3.2.3-Bank</a></li>
                  <li><a class="klik" id="324" href="#">3.2.4-Piutang</a></li>
                  <li><a class="klik" id="325" href="#">3.2.5-Asset</a></li>
                  <li><a class="klik" id="326" href="#">3.2.6-Penyaluran</a></li>
                  <li><a class="klik" id="327" href="#">3.2.7-Hak Amil</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">3.3-Laporan</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="331" href="#">3.3.1-Laporan Kas</a></li>
                  <li><a class="klik" id="332" href="#">3.3.2-Laporan Bank</a></li>
                  <li><a class="klik" id="333" href="#">3.3.3-Laporan Piutang</a></li>
                  <li><a class="klik" id="334" href="#">3.3.4-Laporan Asset</a></li>
                  <li><a class="klik" id="335" href="#">3.3.5-Rekap Transaksi</a></li>
                  <li><a class="klik" id="336" href="#">3.3.6-Rekap KL</a></li>
                  <li><a class="klik" id="337" href="#">3.3.7-Laporan Wilayah</a></li>
                </ul>
              </li>  
            </ul>
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
            <ul class="dropdown-menu">
              <li><a href="#">6.1-Master</a></li>
              <li class="dropdown-submenu">
                <a href="#">6.2-Transaksi</a>
                  <ul class="dropdown-menu">
                    <li><a class="klik" id="621" href="#">6.2.1-Jurnal Umum</a></li>
                  </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">6.3-Laporan</a>
                  <ul class="dropdown-menu">
                    <li><a class="klik" id="631" href="#">6.3.1-Jurnal</a></li>
                    <li><a class="klik" id="632" href="#">6.3.2-Buku Besar</a></li>
                    <li><a class="klik" id="633" href="#">6.3.3-Neraca Saldo</a></li>
                  </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">6.4-PSAK 109</a>
                  <ul class="dropdown-menu">
                    <li><a class="klik" id="641" href="#">6.4.1-PSAK-109</a></li>
                  </ul>
              </li>
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
            if(menu == "311"){
              $('.konten').load('311_bank/bank.php');
            }else if(menu == "113"){
              $('.konten').load('113_rubah_password/rubah_password.php');
            }else if(menu == "312"){
              $('.konten').load('312_bank_kl/bank_kl.php');
            }else if(menu == "313"){
              $('.konten').load('313_closing_kas_harian/closing_kas_harian.php');
            }else if(menu == "314"){
              $('.konten').load('314_kreditur/kreditur.php');
            }else if(menu == "321"){
              $('.konten').load('321_setup_saldo/setup_saldo.php');
            }else if(menu == "322"){
              $('.konten').load('322_kas/kas.php');
            }else if(menu == "323"){
              $('.konten').load('323_trsbank/trsbank.php');
            }else if(menu == "324"){
              $('.konten').load('324_piutang/piutang.php');
            }else if(menu == "325"){
              $('.konten').load('325_asset/asset.php');
            }else if(menu == "326"){
              $('.konten').load('326_penyaluran/penyaluran.php');
            }else if(menu == "327"){
              $('.konten').load('327_hak_amil/hak_amil.php');
            }else if(menu == "331"){
              $('.konten').load('331_lap_kas/lap_kas.php');
            }else if(menu == "332"){
              $('.konten').load('332_lap_bank/lap_bank.php');
            }else if(menu == "333"){
              $('.konten').load('333_lap_piutang/lap_piutang.php');
            }else if(menu == "334"){
              $('.konten').load('334_lap_asset/lap_asset.php'); 
            }else if(menu == "335"){
              $('.konten').load('335_rekap_transaksi/rekap_transaksi.php');
            }else if(menu == "336"){
              $('.konten').load('336_rekap_kl/rekap_kl.php');
            }else if(menu == "337"){
              $('.konten').load('337_lap_ramadhan/lap_ramadhan.php');   
            }else if(menu == "621"){
              $('.konten').load('621_jurnal_umum/jurnal_umum.php'); 
            }else if(menu == "631"){
              $('.konten').load('631_jurnal/jurnal.php');
            }else if(menu == "632"){
              $('.konten').load('632_buku_besar/buku_besar.php');
            }else if(menu == "633"){
              $('.konten').load('633_neraca_saldo/neraca_saldo.php');
            }else if(menu == "641"){
              $('.konten').load('641_lpk/lpk.php');
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
                }else if(menu == "311"){
                  $('.konten').load('311_bank/bank.php');
                }else if(menu == "312"){
                  $('.konten').load('312_bank_kl/bank_kl.php');
                }else if(menu == "313"){
                  $('.konten').load('313_closing_kas_harian/closing_kas_harian.php');
                }else if(menu == "314"){
                  $('.konten').load('314_kreditur/kreditur.php');
                }else if(menu == "321"){
                  $('.konten').load('321_setup_saldo/setup_saldo.php');
                }else if(menu == "322"){
                  $('.konten').load('322_kas/kas.php');
                }else if(menu == "323"){
                  $('.konten').load('323_trsbank/trsbank.php');
                }else if(menu == "324"){
                  $('.konten').load('324_piutang/piutang.php');
                }else if(menu == "325"){
                  $('.konten').load('325_asset/asset.php');
                }else if(menu == "326"){
                  $('.konten').load('326_penyaluran/penyaluran.php');
                }else if(menu == "327"){
                  $('.konten').load('327_hak_amil/hak_amil.php'); 
                }else if(menu == "331"){
                  $('.konten').load('331_lap_kas/lap_kas.php'); 
                }else if(menu == "332"){
                  $('.konten').load('332_lap_bank/lap_bank.php');
                }else if(menu == "333"){
                  $('.konten').load('333_lap_piutang/lap_piutang.php');
                }else if(menu == "334"){
                  $('.konten').load('334_lap_asset/lap_asset.php'); 
                }else if(menu == "335"){
                  $('.konten').load('335_rekap_transaksi/rekap_transaksi.php'); 
                }else if(menu == "336"){
                  $('.konten').load('336_rekap_kl/rekap_kl.php');  
                }else if(menu == "337"){
                  $('.konten').load('337_lap_ramadhan/lap_ramadhan.php'); 
                }else if(menu == "631"){
                  $('.konten').load('631_jurnal/jurnal.php');
                }else if(menu == "621"){
                  $('.konten').load('621_jurnal_umum/jurnal_umum.php');
                }else if(menu == "632"){
                  $('.konten').load('632_buku_besar/buku_besar.php');
                }else if(menu == "633"){
                  $('.konten').load('633_neraca_saldo/neraca_saldo.php'); 
                }else if(menu == "641"){
                  $('.konten').load('641_lpk/lpk.php');  
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