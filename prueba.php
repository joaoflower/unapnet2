<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>
<body>

<?
	session_start();
	session_register("sConedb");
//	session_register("count");

	$sConedb['host'] = '10.1.1.134';
	$sConedb['user'] = 'unapmatri';
	$sConedb['passwd'] = 'master2005';
	
	echo $_SESSION['count'] = 100;
	echo $_SESSION['count'];
	echo $count;
	
	$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	echo $pQuery = "Select * from unapnet.carrera";
	
	$cUsuest = mysql_query($pQuery, $xSerdata);
	
/*	if (!$cUsuest) {
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';*/

	
	
?>

<form id="fData" name="fData" method="post" action="prueba2.php">
  
  <select name="rCod_car" id="rCod_car">
  <?
  	while($aUsuest = mysql_fetch_array($cUsuest))
	{
  ?>
    <option value="<?=$aUsuest['cod_car']?>"><?=$aUsuest['cod_car']?></option>
	<?
		}	
	mysql_close($xSerdata);
	?>
  </select>
  

  <input type="submit" name="Submit" value="Enviar" />

</form>
</body>
</html>
