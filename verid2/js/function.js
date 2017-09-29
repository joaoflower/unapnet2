// Script Function	
function maximizar()
{
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
}
function cerrar() 
{
	var ventana = window.self;
	ventana.opener = window.self;
	parent.close();
}
function pintar(objeto)
{ 
	if(objeto.checked)
	{
		sombrear(objeto);
	}
	else
	{
		desombrear(objeto);
	}
}

function sombrear(E)
{
	while (E.tagName!="TR")
	{
		E=E.parentElement;
	}
	E.className="trselect";
	if(E.id == "p")
	{
		E.id = "ps"
	}
	if(E.id == "i")
	{
		E.id = "is"
	}				
}

function desombrear(E)
{
	while (E.tagName!="TR")
	{
		E=E.parentElement;
	}
	if(E.id == "ps")
	{
		E.className="trpar";
		E.id = "p";
	}
	if(E.id == "is")
	{
		E.className="trinpar";
		E.id = "i";
	}		
}

function mouseover(E)
{
	E.className="trhover";
}
function mouseout(E)
{
	if(E.id == "p")
	{
		E.className="trpar";
	}
	if(E.id == "i")
	{
		E.className="trinpar";
	}				
	if(E.id == "ps" || E.id == "is")
	{
		E.className="trselect";
	}				
}
function fupper(pobject)
{		
	pobject.value = pobject.value.toUpperCase();
}
function fverinota(pobject, ptip_not)
{
	if(ptip_not == 'C')
	{
		if(parseFloat(pobject.value) >= 0 && parseFloat(pobject.value) <= 10)
			pobject.className = "notades";
		if(parseFloat(pobject.value) > 10 && parseFloat(pobject.value) <= 20)
			pobject.className = "notapro";
	}
	else if(ptip_not == 'A')
	{
		if(parseFloat(pobject.value) >= 0 && parseFloat(pobject.value) <= 2)
			pobject.className = "notapro";
		else
			pobject.className = "notades";
	}
}

function seleccionar(cont)
{
	if(cont.checked)
		sombrear(cont);
	else
		desombrear(cont);			
}
function fchecknota(pnextab)
{
	if(window.event.keyCode==13)
	{
		if(pnextab != "end")
		{
			eval('document.fData.' + pnextab + '.focus();');
		
		}
	}
}