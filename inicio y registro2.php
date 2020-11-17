<?php require_once('Connections/TeachPC.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['correo'])) {
  $loginUsername=$_POST['correo'];
  $password=$_POST['correo'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.html";
  $MM_redirectLoginFailed = "inicio y registro2.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_TeachPC, $TeachPC);
  
  $LoginRS__query=sprintf("SELECT Correo, Correo FROM integrantes WHERE Correo=%s AND Correo=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $TeachPC) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Iniciar Secion</title>
<style type="text/css">
#apDiv1 {
	position: absolute;
	width: 288px;
	height: 58px;
	z-index: 1;
	left: 2px;
	top: 18px;
}
h1,h2,h3,h4,h5,h6 {
	font-family: Georgia, "Times New Roman", Times, serif;
}
h1 {
	font-size: 24px;
}
#apDiv2 {
	position: absolute;
	width: 531px;
	height: 345px;
	z-index: 2;
	left: 3px;
	top: 80px;
}
h2 {
	font-size: 16px;
}
h3 {
	font-size: 16px;
	color: #999;
}
</style>
</head>

<body>
<div id="apDiv1">
  <h1>Inicio de usuario</h1>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="apDiv2">
<table width="481" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="611" height="29"><form action="<?php echo $loginFormAction; ?>" method="POST" name="form2" target="_parent" id="form2">
      <p>
      <label for="correo">
        <div align="center">
        <div align="center">Correo<br />
        </div>
        </div>
      </label>
      <div align="center">
        <input type="text" name="correo" id="correo" />
      </div>
      </p>
      <p align="center">
        <label for="Password">Contraceña</label>
      </p>
      <p align="center">
        <input type="password" name="Password" id="Password" />
      </p>
      <p align="center">
        <input type="submit" name="Entrar" id="Entrar" value="Entrar" />
      </p>
    </form>
      <h2>&nbsp;</h2></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <h3>¿Olvidaste tu contraceña? </h3>
</form>
</div>
<p>&nbsp;</p>
</body>
</html>
