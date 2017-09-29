<?php
	session_start();
        if ($ar_upasswd['Safety'] != "1236") header("Location:.");
?>
<Html>
<Head>
<Title> Un@pNet - Password System 2003 </Title>
<!--<Meta http-equiv="Page-Enter" content="revealTrans(Duration=2.0,Transition=0)">-->

<script language="JavaScript">

// Maximiza la ventana

   window.moveTo(0,0);
   if (document.all)
   {
      top.window.resizeTo(screen.availWidth,screen.availHeight);
   }
   else if (document.layers||document.getElementById)
   {
      if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth)
      {
         top.window.outerHeight = screen.availHeight;
         top.window.outerWidth = screen.availWidth;
      }
   }

</script>

</Head>

<!-- <Body Name = "main"> -->

<?

$Mostrar = "<frameset Frameborder = '0' Rows = '50,*,30 ' border = '0' framespacing = '0'>
	<frame Scrolling = 'no' Src = 'cabeza.php' Name = 'cabeza'>
        <frame Src = 'inicio.php' Name = 'conten'>
	<frame Scrolling = 'no' Src = '../include/piepaginat.php' Name = 'pie'>
	<noframes>
		<Body topmargin='0' marginheight='0' bgcolor='#FFFFFF'   leftmargin='0' rightmargin='0' background = 'images/background2.gif'>
			<Font face ='Arial' color = '#111155' Size = '3'>
				<center><b> Su navegador no soporta FRAMES, vaya a otra cabina </b></Center>
			<Font>
		</Body>
	</noframes>
</frameset>";
	if ($ar_upasswd["Safety"] != "1236")
	{
		echo "<body><Center>La página ha Caducado<Center><Br>Ingrese su login y contraseña</Body>";
	}
	else
	{
		echo $Mostrar;
	}
?>

</Body>
</Html>

