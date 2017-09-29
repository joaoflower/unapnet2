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
<div id="dfoot">
  Copyright &copy; 2008 - Oficina de Tecnolog&iacute;a Inform&aacute;tica - UNA - Telefono: +51-51-364356 - Celular: +51-51-9823126 </div>
</body>