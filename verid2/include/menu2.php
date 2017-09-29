<?
	if(fsafetylogin())
	{
	}
	else
	{
		$_SESSION['sIni'] = "";
		header("Location:../index.php");
	}
?>
<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
</STYLE>
<div id="dmenu"> 
	<a href="" onclick="clickmisdatos();  return false;" class="imydata" title="Mis datos personales" >Mis datos </a> 
	<a href="" onclick="clickpasswd();  return false;" class="ipasswd" title="cambiar contraseña" >Contrase&ntilde;a</a> 
	<a href="" onclick="clickplan();  return false;" class="iplan" title="Plan de Estudios" >Plan de Estudios</a>
	<a href="" onclick="clickhorario();  return false;" class="ihorario" title="Horarios" >Horarios</a>
	<a href="" onclick="clicknota();  return false;" class="inotas" title="Notas" >Notas</a> 
	<a href="" onclick="clickmatricula();  return false;" class="imatriculas" title="Matriculas" >Matriculas</a> 
	<a href="" onclick="clickcidiomas();  return false;" class="icidiomas" title="Centro de Idiomas" >C. Idiomas</a> 
	<a href="../close.php" class="iexit" title="Salir del Sistema" >Salir</a> </div>
