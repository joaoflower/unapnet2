<?php
	session_start();
	unset($sUser);
	unset($sConeun);
	unset($sConedb);
	unset($sCarrera);
	unset($sFacultad);
	unset($sTipousu);
	unset($sTipodoc);
	unset($sSexo);
	unset($sMes);
	unset($sEstcivil);
	unset($sNacional);
	
	session_destroy();

	session_start();
	include "../include/function.php";
	include "../include/funcunap.php";

	session_register("sUser");
	session_register("sConeun");
	session_register("sConedb");
	session_register("sCarrera");
	session_register("sFacultad");
	session_register("sTipousu");
	session_register("sTipodoc");
	session_register("sSexo");
	session_register("sMes");
	session_register("sEstcivil");
	session_register("sNacional");
	
	finit();
	finitu();	

	$sUser['errorl'] = FALSE;
	$sUser['msnerror'] = '';
	header("Location:index2.php");
?>
