<?php

	session_start();

	unset($sReguser);
	unset($sConeun);
	unset($sConedb);
	unset($sCarrera);
	unset($sTipousu);
	unset($sTipodoc);
	unset($sSexo);
	unset($sMes);
	unset($sEstcivil);
	unset($sNacional);

	session_destroy();

	session_start();

	include "../include/function.php";
	include "../include/funcreg.php";
	session_register("sReguser");
	session_register("sConeun");
	session_register("sConedb");
	session_register("sCarrera");
	session_register("sTipousu");
	session_register("sTipodoc");
	session_register("sSexo");
	session_register("sMes");
	session_register("sEstcivil");
	session_register("sNacional");
	

	finit();

	finitr();

	header("Location: index2.php");

?>
