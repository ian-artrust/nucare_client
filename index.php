<html>
<head>
<title>.::NUCARE::.</title>
<link href="lib/css/login.css" rel="stylesheet" type="text/css">
<style type="text/"></style>
<script type="text/javascript" src="lib/js/login.js"></script>
</head>
<body ng-app="aczisApp" ng-controller="ctr">
<div class="content">
<div class="head"><img src="lib/img/logo_login.png" /></div>
<div class="framelog">
<div class="frameh1"></div>
<form method=POST action="">
    <table  align="center" >
    <tr>
    <td ><input class="text" type="text"  name="username" id="username" placeholder="Username"/></td>
    </tr>
    
    <tr>
    <td><input class="text" placeholder="Password" type="password" name="password" id="password"/></td>
    </tr>
    
    <tr>
    <td colspan="2"><center><input class="submit" type="submit" onclick="cek_login();" value="Login"/></center></td>
    </tr>
</form>
</table>
</div>

<div class="foot">Copyright &copy 2018 - NUCare LazisNU</div>
</div>
<script src='lib/js/jquery.min.js'></script>
</body>
<script type="text/javascript">
    $('#username').focus();
</script>
</html>