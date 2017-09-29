// JavaScript Document
try{
    xmlhttp = new XMLHttpRequest();
}
catch(ee){
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		catch(E){
            xmlhttp = false;
        }
    }
}

function openpageget(plink, player, pmessage, pnext)
{
    if(pmessage)
	{
		var pointerlayer = document.getElementById(player)
		//pointerlayer.innerHTML = "Cargando Página..."
		pointerlayer.innerHTML = "<center><img src=\"../images/sms_sent.gif\" /></center>"
	}

    xmlhttp.open("GET", plink, true);	
	
    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
            var returntext = xmlhttp.responseText
            returntext = returntext.replace(/\+/g," ")
            returntext = unescape(returntext)

            var pointerlayer = document.getElementById(player)
            pointerlayer.innerHTML = returntext
			if(pnext.length > 0)
				fchangeobject(pnext)
        }
    }
	xmlhttp.send(null);
}

function openpagepost(plink, pparam, player, pmessage, pnext)
{
    if(pmessage)
	{
		var pointerlayer = document.getElementById(player)
		//pointerlayer.innerHTML = "Cargando Página..."
		pointerlayer.innerHTML = "<img src=\"../images/sms_sent.gif\" />"
	}

    xmlhttp.open("POST", plink, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(pparam);

    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
            var returntext = xmlhttp.responseText
            returntext = returntext.replace(/\+/g," ")
            returntext = unescape(returntext)

            var pointerlayer = document.getElementById(player)
            pointerlayer.innerHTML = returntext
			if(pnext.length > 0)
				fchangeobject(pnext)
        }
    }
}

function updatepageget(plink)
{
    xmlhttp.open("GET", plink, true);
	xmlhttp.send(null);
	
    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
            var returntext = xmlhttp.responseText
        }
    }
}

function updatepagepost(plink, pparam)
{
    xmlhttp.open("POST", plink, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(pparam);

    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4)
		{
            var returntext = xmlhttp.responseText    
        }
    }
}

function clearlayer(player)
{
	var pointerlayer = document.getElementById(player);
    pointerlayer.innerHTML="";
}
