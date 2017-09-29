<STYLE type=text/css>
@import url( ../css/main.css );
@import url( ../css/frame.css );
@import url( ../css/framelogin.css );
@import url( ../css/style.css );
</STYLE>

<?
	session_start();
	include "../include/funcget.php";
	include "../include/funcsql.php";
	include "../include/funcstyle.php";
	if(fsafetylogin())
	{
		$vCont = 1;
	}
	else
	{
		header("Location:../index.php");
	}
	
?>
<center>
<form action="#" method="post" enctype="multipart/form-data" name="fData" id="fData">
	<table border="0" cellpadding="0" cellspacing="0" class="tventana">
	  <tr>
		<td><img src="../images/ven_topleft.jpg" width="16" height="25" border="0" alt="" /></td>
		<th background="../images/ven_topcenter.jpg">Estudiantes</th>
		<td><img src="../images/ven_topright.jpg" width="16" height="25" border="0" alt="" /></td>
	  </tr>
	  <tr>
		<td background="../images/ven_mediumleft.jpg"></td>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tlistsearch">
				<tr>
				  <th width="10">&nbsp;</th>
				  <th width="80">N&uacute;m.Mat.</th>
				  <th width="120">Paterno</th>
				  <th width="120">Materno</th>
				  <th width="120">Nombres</th>
				  <th width="16">&nbsp;</th>
				</tr>
				<tr>
				  <th>&nbsp;</th>
				  <th><input name="rNum_mat" type="text" class="" id="rNum_mat" size="6" maxlength="6" onBlur="con_searchestu(document.fData); return false;"/></th>
				  <th>&nbsp;</th>
				  <th>&nbsp;</th>
				  <th>&nbsp;</th>
				  <th>&nbsp;</th>
			  </tr>
			</table>
            <div id="dresultado"></div>
		
		</td>
		<td background="../images/ven_mediumright.jpg"></td>
	  </tr>
	  <tr>
		<td><img src="../images/ven_bottomleft.jpg" width="16" height="16" border="0" alt="" /></td>
		<td background="../images/ven_bottomcenter.jpg"></td>
		<td><img src="../images/ven_bottomright.jpg" width="16" height="16" border="0" alt="" /></td>
	  </tr>
	</table>
    <div id="dpasswd"></div>
</form>	
</center>
