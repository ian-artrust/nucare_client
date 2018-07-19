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
                  <li><a class="klik" id="112" href="#">1.1.2-Petugas</a></li>
                  <li><a class="klik" id="113" href="#">1.1.3-Rubah Password</a></li>
                  <li><a class="klik" id="114" href="#">1.1.4-Kantor Layanan</a></li>
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
                      <li><a class="klik" id="212" href="#">2.1.2-Mustahik</a></li>
                      <li><a class="klik" id="213" href="#">2.1.3-Mustahik Entitas</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu">
                    <a href="#">2.2-Transaksi</a>
                    <ul class="dropdown-menu">
                      <li><a class="klik" id="221" href="#">2.2.1-Donasi</a></li>
                      <li><a class="klik" id="222" href="#">2.2.2-Non Tunai & Tab Qurban</a></li>
                      <li><a class="klik" id="223" href="#">2.2.3-Disposisi</a></li>
                      <li><a class="klik" id="224" href="#">2.2.4-Pengajuan</a></li>
                      <li><a class="klik" id="225" href="#">2.2.5-Setoran ZISR</a></li>
                      <li><a class="klik" id="226" href="#">2.2.6-Rekap Kasir</a></li>
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
            <ul class="dropdown-menu">
              <li><a href="#">5.1-Master</a></li>
              <li class="dropdown-submenu">
                <a href="#">5.2-Transaksi</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="521" href="#">5.2.1-Approval</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">5.3-Laporan</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="531" href="#">5.3.1-Laporan Pengajuan</a></li>
                  <li><a class="klik" id="532" href="#">5.3.2-Laporan Transaksi</a></li>
                </ul>
              </li>
              <li class="dropdown-submenu">
                <a href="#">5.4-Wilayah</a>
                <ul class="dropdown-menu">
                  <li><a class="klik" id="541" href="#">5.4.1-Laporan Ramadhan</a></li>
                </ul>
              </li>  
            </ul>
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

    <!-- FOOTER
  <nav style="color:#FFFFFF" class="navbar navbar-default navbar-bottom navbar-right">
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
            if(menu == "112"){
              $('.konten').load('112_petugas/petugas.php'); 
            }else if(menu == "113"){
              $('.konten').load('113_rubah_password/rubah_password.php');
            }else if(menu == "114"){
              $('.konten').load('114_kl/kantor_layanan.php');      
            }else if(menu == "211"){
              $('.konten').load('211_muzaki/muzaki.php');
            }else if(menu == "212"){
              $('.konten').load('212_mustahik/mustahik.php');
            }else if(menu == "213"){
              $('.konten').load('213_mustahik_entitas/mustahik_entitas.php');   
            }else if(menu == "221"){
              $('.konten').load('221_donasi/donasi.php');
            }else if(menu == "222"){
              // alert('Modul Belum Aktif');
              $('.konten').load('222_non_tunai/non_tunai.php');
            }else if(menu == "223"){
              $('.konten').load('223_disposisi/disposisi.php');
            }else if(menu == "224"){
              $('.konten').load('224_pengajuan/pengajuan.php');  
            }else if(menu == "225"){
              $('.konten').load('225_setoran_zisr/setoran_zisr.php');
            }else if(menu == "226"){
              $('.konten').load('226_rekap_kasir/rekap_kasir.php');
            }else if(menu == "227"){
              $('.konten').load('227_donasi_kl/donasi_kl.php');
            }else if(menu == "228"){
              $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
            }else if(menu == "229"){
              $('.konten').load('229_non_tunai/non_tunai.php');
            }else if(menu == "231"){
              $('.konten').load('231_lap_muzaki/lap_muzaki.php');  
            }else if(menu == "232"){
              $('.konten').load('232_lap_transaksi/lap_transaksi.php');
            }else if(menu == "233"){
              $('.konten').load('233_lap_transaksi_kl/lap_transaksi_kl.php');        
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
            }else if(menu == "521"){
              $('.konten').load('521_approval/approval.php');
            }else if(menu == "531"){
              $('.konten').load('531_lap_pengajuan/lap_pengajuan.php');
            }else if(menu == "541"){
              $('.konten').load('541_lap_ramadhan/lap_ramadhan.php');
            }else if(menu == "532"){
              $('.konten').load('532_lap_transaksi/lap_transaksi.php');
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
            } 
          });

          //Router Menu Keypress Event
          $('#key_menu').keydown(function(e){
              if(e.keyCode == 13){
                var menu = $('#key_menu').val();
                if(menu == "0"){
                  $('.konten').load('home.php');                  
                }else if(menu == "112"){
                  $('.konten').load('112_petugas/petugas.php'); 
                }else if(menu == "113"){
                  $('.konten').load('113_rubah_password/rubah_password.php'); 
                }else if(menu == "114"){
                  $('.konten').load('114_kl/kantor_layanan.php');   
                }else if(menu == "211"){
                  $('.konten').load('211_muzaki/muzaki.php');
                }else if(menu == "212"){
                  $('.konten').load('212_mustahik/mustahik.php'); 
                }else if(menu == "213"){
                  $('.konten').load('213_mustahik_entitas/mustahik_entitas.php');   
                }else if(menu == "221"){
                  $('.konten').load('221_donasi/donasi.php');
                }else if(menu == "222"){
                  // alert('Modul Belum Aktif');
                  $('.konten').load('222_non_tunai/non_tunai.php');
                }else if(menu == "223"){
                  $('.konten').load('223_disposisi/disposisi.php');
                }else if(menu == "224"){
                  $('.konten').load('224_pengajuan/pengajuan.php');  
                }else if(menu == "225"){
                  $('.konten').load('225_setoran_zisr/setoran_zisr.php');
                }else if(menu == "226"){
                  $('.konten').load('226_rekap_kasir/rekap_kasir.php');
                }else if(menu == "227"){
                  $('.konten').load('227_donasi_kl/donasi_kl.php');
                }else if(menu == "228"){
                  $('.konten').load('228_setoran_penghimpunan/setoran_penghimpunan.php');
                }else if(menu == "229"){
                  $('.konten').load('229_non_tunai/non_tunai.php');
                }else if(menu == "231"){
                  $('.konten').load('231_lap_muzaki/lap_muzaki.php');  
                }else if(menu == "232"){
                  $('.konten').load('232_lap_transaksi/lap_transaksi.php');
                }else if(menu == "233"){
                  $('.konten').load('233_lap_transaksi_kl/lap_transaksi_kl.php');    
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
                }else if(menu == "521"){
                  $('.konten').load('521_approval/approval.php');
                }else if(menu == "531"){
                  $('.konten').load('531_lap_pengajuan/lap_pengajuan.php');
                }else if(menu == "541"){
                  $('.konten').load('541_lap_ramadhan/lap_ramadhan.php');
                }else if(menu == "532"){
                  $('.konten').load('532_lap_transaksi/lap_transaksi.php');
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