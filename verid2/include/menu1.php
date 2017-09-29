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
	<a href="" onclick="clickcontrasenhad();  return false;" class="imydata" title="Contraseñas de Docente" >Contrase&ntilde;a Docentes</a> 
    <a href="" onclick="clickcontrasenhae();  return false;" class="imydata" title="Contraseñas de Estudiante" >Contrase&ntilde;a Estudiantes</a> 
	<a href="../close.php" class="iexit" title="Salir del Sistema" >Salir</a> </div>
