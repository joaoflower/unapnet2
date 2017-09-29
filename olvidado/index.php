<?php
	session_start();
	unset($sOlvuser);
	unset($sConeun);
	unset($sConedb);
	unset($sCarrera);
	unset($sTipousu);
	unset($sMes);
	
	session_destroy();

	session_start();
	include "../include/function.php";
	include "../include/funcolv.php";
	session_register("sOlvuser");
	session_register("sConeun");
	session_register("sConedb");
	session_register("sCarrera");
	session_register("sTipousu");
	session_register("sMes");
	
	finit();
	finito();

	header("Location:index2.php");
?>
