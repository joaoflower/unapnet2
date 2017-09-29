function clickmisdatos()
{
	var vlink = "std_viewmidata.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickpasswd()
{
	var vlink = "psw_getpasswd.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickplan()
{
	var vlink = "std_viewplan.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickhorario()
{
	var vlink = "std_viewhorario.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clicknota()
{
	var vlink = "std_viewnota.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickmatricula()
{
	var vlink = "std_prematri.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickcidiomas()
{
	var vlink = "cid_viewidiomas.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}

//------------------------------------------------------------------
function std_getmidata()
{
	var vlink = "std_getmidata.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function std_savemidata(pform)
{
	var vTip_doc = pform.rTip_doc.value;
	var vNum_doc = pform.rNum_doc2.value;
	var vFch_nac = pform.rAno_nac.value + "-" + pform.rMes_nac.value + "-" + pform.rDia_nac.value;
	var vSexo = pform.rSexo.value;
	var vEst_civ = pform.rEst_civ.value;
	var vFono = pform.rFono.value;
	var vCelular = pform.rCelular.value;
	var vDirec = pform.rDirec.value;
	var vOemail = pform.rOemail.value;
	
	var vlink = "std_savemidata.php";
	var vparam = "rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rFch_nac=" + vFch_nac + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rDirec=" + vDirec + "&rOemail=" + vOemail;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function std_selectcurso()
{
	var vlink = "std_selectcurso.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function std_matricular(pform)
{
	var i = 0;
	var vCod_cur = "";
	var vSec_gru = "";
	var vCrd_cur = 0;	
	var vCrd_curs = parseFloat(pform.rCrd_cur.value);
	
	var oSec_gru;
	var oCrd_cur;
	
	if(vCrd_curs > 0)
	{
		for (i = 0; i < pform.elements.length; i++) 
		{
			if(pform.elements[i].type == "checkbox") 
			{
				if(pform.elements[i].checked == true)
				{
					vCod_cur = vCod_cur + pform.elements[i].value;
					
					oSec_gru = document.getElementById("rSec_gru" + pform.elements[i].value);
					vSec_gru = vSec_gru + oSec_gru.value;
					
					oCrd_cur = document.getElementById("rCrd_cur" + pform.elements[i].value);
					vCrd_cur = vCrd_cur + parseFloat(oCrd_cur.value);
				}
			}
		}
	}
	if((vCrd_cur <= vCrd_curs) && vCrd_cur > 0 && vCod_cur != "")
	{
		var vlink = "std_matricular.php";
		var vparam = "rCod_cur=" + vCod_cur + "&rSec_gru=" + vSec_gru + "&rCrd_cur=" + vCrd_cur;
		var vlayer = "dsubcontent";

		openpagepost(vlink, vparam, vlayer, true, "");
	}
	else
	{
		alert("No se puede realizar la Matricula porque no selecciono curso alguno");
		
	}
}
function std_viewhorasge(pclave)
{
	var vlink = "std_viewhorasge.php";
	var vparam = "rClave=" + pclave;
	var vlayer = "dhorario";

	openpagepost(vlink, vparam, vlayer, true, "");		
}

//--------------- Centro de Idiomas -------------------
function cid_newidioma()
{
	var vlink = "cid_newidioma.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function cid_viewidioma(pcodigo)
{
	var vlink = "cid_viewidioma.php";
	var vparam = "rCodigo=" + pcodigo;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");		
}
function iclicknotas()
{
	var vlink = "cid_viewnotas.php";
	var vlayer = "dsubcontent2";
	openpageget(vlink, vlayer, true, "");
}
function iclickmatris()
{
	var vlink = "cid_viewmatris.php";
	var vlayer = "dsubcontent2";
	openpageget(vlink, vlayer, true, "");
}
function iclickplan()
{
	var vlink = "cid_viewplan.php";
	var vlayer = "dsubcontent2";
	openpageget(vlink, vlayer, true, "");
}
function iclickmatricular()
{
	var vlink = "cid_prematri.php";
	var vlayer = "dsubcontent2";
	openpageget(vlink, vlayer, true, "");
}
function cid_getdatamatri()
{
	var vlink = "cid_getdatamatri.php";
	var vlayer = "dsubcontent2";
	openpageget(vlink, vlayer, true, "");
}
function cid_savematri(pform)
{
	var vHra_sec = pform.rHra_sec.value;
	var vTip_pag = pform.rTip_pag.value;
	var vNum_rec = pform.rNum_rec.value;
	var vImp_pag = pform.rImp_pag.value;
	
	var vlink = "cid_savematri.php";
	var vparam = "rHra_sec=" + vHra_sec + "&rTip_pag=" + vTip_pag + "&rNum_rec=" + vNum_rec + "&rImp_pag=" + vImp_pag;
	var vlayer = "dsubcontent2";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//-----------------------------------------------------