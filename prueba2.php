<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<?
	session_start();
	
/*	$sConedb['host'] = '10.1.1.134';
	$sConedb['user'] = 'unapmatri';
	$sConedb['passwd'] = 'master2005';*/
	
	$xSerdata = mysql_connect($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
	echo $pQuery = "Select * from unapnet.carrera";
	echo $_SESSION["count"]."-";
	echo $count."-";
	echo $_POST["rCod_car"]."-";
	$cUsuest = mysql_query($pQuery, $xSerdata);
	
	if (!$cUsuest) {
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';

	
	while($aUsuest = mysql_fetch_array($cUsuest))
	{
		echo $aUsuest['cod_car'].$aUsuest['car_des'].'<br />';
	}	
	mysql_close($xSerdata);
?>

</body>
</html>
