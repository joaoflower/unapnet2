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
<div id="dheader">
	<div class="headerow">
		<div class="headercol"><img name="cabe_r1_c1" src="../images/cabe_r1_c1.jpg" width="770" height="21" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r2_c1" src="../images/cabe_r2_c1.jpg" width="770" height="3" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r3_c1" src="../images/cabe_r3_c1.jpg" width="200" height="18" border="0" alt=""></div>
		<div class="headermsn">[<?=($_SESSION['sUsertip_usu']=='student'?"ESTUDIANTE":"MANAGER")?>] - Bienvenido: <?=$_SESSION['sUsernombres']?> <?=$_SESSION['sUserpaterno']?> <?=$_SESSION['sUsermaterno']?></div>
		<div class="headercol"><img name="cabe_r3_c3" src="../images/cabe_r3_c3.jpg" width="70" height="18" border="0" alt=""></div>
	</div>
	<div class="headerow">
		<div class="headercol"><img name="cabe_r4_c1" src="../images/cabe_r4_c1.jpg" width="770" height="3" border="0" alt=""></div>
	</div>
</div>