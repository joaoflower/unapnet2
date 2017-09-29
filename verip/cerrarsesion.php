<?php
	session_start();
	unset($ar_upasswd);
	unset($ar_conex);
	unset($ar_conedb);
        unset($ar_carrera);
	session_destroy();
	header("Location:.");
?>



