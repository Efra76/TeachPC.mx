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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO integrantes (Nombre) VALUES (%s)",
                       GetSQLValueString($_POST['Nombre'], "text"));

  mysql_select_db($database_TeachPC, $TeachPC);
  $Result1 = mysql_query($insertSQL, $TeachPC) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO integrantes (Nombre, Correo, Password) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Correo'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_TeachPC, $TeachPC);
  $Result1 = mysql_query($insertSQL, $TeachPC) or die(mysql_error());

  $insertGoTo = "index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
#apDiv1 {
	position: absolute;
	width: 288px;
	height: 58px;
	z-index: 1;
	left: 447px;
	top: -15px;
}
#apDiv2 {
	position: absolute;
	width: 920px;
	height: 323px;
	z-index: 2;
	left: 104px;
	top: -9px;
}
h1,h2,h3,h4,h5,h6 {
	font-family: Georgia, "Times New Roman", Times, serif;
}
h1 {
	font-size: 12px;
}
a:link {
	color: #000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000;
}
a:hover {
	text-decoration: none;
	color: #000;
}
a:active {
	text-decoration: none;
	color: #000;
}
h2 {
	font-size: 24px;
}
h3 {
	font-size: 16px;
}
#apDiv3 {
	position: absolute;
	width: 336px;
	height: 35px;
	z-index: 3;
	left: 123px;
	top: 255px;
}
</style>
</head>

<body>
<div id="apDiv1">
  <h2>Inicio de usuario</h2>
</div>
<div id="apDiv3">
  <h1>¿Ya tienes una cuenta ?<a href="inicio y registro.html" target="_parent"> Iniciar Secion</a></h1>
</div>
<div id="apDiv2">
  <table width="876" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td height="329"><div align="center">
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" target="_parent" id="form2">
          <table width="344" height="142" align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Nombre:</td>
              <td><input type="text" name="Nombre" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Correo:</td>
              <td><input type="text" name="Correo" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Contraceña:</td>
              <td><input type="text" name="Password" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Registrar" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form2" />
      </form>
        <p>&nbsp;</p>
<h3>&nbsp;</h3>
      </div></td>
    </tr>
  </table>
  <form id="form4" name="form4" method="post" action="">
    <div align="center"></div>
  </form>
</div>
</body>
</html>
