function clickmisdatos()
{
	var vlink = "tch_viewmidata.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickpasswd()
{
	var vlink = "psw_getpasswd.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clicklistado()
{
	var vlink = "lst_viewcursos.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickacta()
{
	var vlink = "act_viewcursos.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickacta()
{
	var vlink = "act_viewcursos.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clicksilabo()
{
	var vlink = "si2_viewcursos.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickcontrasenhad()
{
	var vlink = "con_getdoce.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function clickcontrasenhae()
{
	var vlink = "con_getestu.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}


//------------------------------------------------------------------
function tch_getmidata()
{
	var vlink = "tch_getmidata.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function tch_savemidata(pform)
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
	
	var vlink = "tch_savemidata.php";
	var vparam = "rTip_doc=" + vTip_doc + "&rNum_doc=" + vNum_doc + "&rFch_nac=" + vFch_nac + "&rSexo=" + vSexo + "&rEst_civ=" + vEst_civ + "&rFono=" + vFono + "&rCelular=" + vCelular + "&rDirec=" + vDirec + "&rOemail=" + vOemail;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//--------------------------------------------------------------------------------------------
function lst_viewestumat(pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "lst_viewestumat.php";
	var vparam = "rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}

//-------------------------------------------------------------------------------------------
function act_getdesca(pform)
{
	var vCan_cap = pform.rCan_cap.value;
	var vCan_act = pform.rCan_act.value;
	
	var vlink = "act_getdesca.php";
	var vparam = "rIns_upd=i&rCan_cap=" + vCan_cap + "&rCan_act=" + vCan_act;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_saveca(pform)
{
	var i = 0;
	var j = 0;
	var vCap_act = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar las Capacidades y Actitudes !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vCap_act = vCap_act + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}
	
	var vlink = "act_saveca.php";
	var vparam = "rIns_upd=i" + vCap_act;
	var vlayer = "dnotas";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}
function act_editca(pform)
{
	var vlink = "act_getcanca.php";
	var vparam = "rIns_upd=u";
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}

function act_viewestumat(pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "act_viewestumat.php";
	var vparam = "rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_newnota(ptip_ord)
{
	var vlink = "act_getnota.php";
	var vparam = "rTip_ord=" + ptip_ord;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_editnota(ptip_ord)
{
	var vlink = "act_getnota.php";
	var vparam = "rTip_ord=" + ptip_ord;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_delnotapre(ptip_ord)
{
	var vlink = "act_delnotapre.php";
	var vparam = "rTip_ord=" + ptip_ord;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_delnota(ptip_ord)
{
	var vlink = "act_delnota.php";
	var vparam = "rTip_ord=" + ptip_ord;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function act_cancelnota()
{
	var vlink = "act_cancelnota.php";
	var vlayer = "dnotas";
	openpageget(vlink, vlayer, true, "");
}
function act_savenotaC(pform)
{
	var i = 0;
	var vNum_mat = "";
	var vNot_cur = "";
	var vMod_not = "";
	
	var tNum_mat = "";
	
	var oMod_not;

	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "text") 
		{
			if(pform.elements[i].value == "")
				pform.elements[i].value = 0;

			if(parseFloat(pform.elements[i].value) >= 0 && parseFloat(pform.elements[i].value) <= 20)
			{
				tNum_mat = pform.elements[i].id;
				vNum_mat = vNum_mat + tNum_mat.substring(1, 7);

				oMod_not = document.getElementById("rMod_not" + tNum_mat.substring(1, 7));
				vMod_not = vMod_not + oMod_not.value;

				if(parseFloat(pform.elements[i].value) < 10)
					vNot_cur = vNot_cur + "0";
				vNot_cur = vNot_cur + parseFloat(pform.elements[i].value);
			}
			else
			{
				alert("La NOTA ingresada es Incorrecta");
				pform.elements[i].focus();
				return false;
			}
		}
	}
	
	var vlink = "act_savenota.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rMod_not=" + vMod_not + "&rNot_cur=" + vNot_cur;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");	
}
function act_savenotaA(pform)
{
	var i = 0;
	var vNum_mat = "";
	var vNot_cur = "";
	var vMod_not = "";
	
	var oMod_not;

	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "text") 
		{
			if(pform.elements[i].value == "")
				pform.elements[i].value = 0;

			if(parseFloat(pform.elements[i].value) >= 0 && parseFloat(pform.elements[i].value) <= 2)
			{
				tNum_mat = pform.elements[i].id;
				vNum_mat = vNum_mat + tNum_mat.substring(1, 7);

				oMod_not = document.getElementById("rMod_not" + tNum_mat.substring(1, 7));
				vMod_not = vMod_not + oMod_not.value;

				vNot_cur = vNot_cur + parseFloat(pform.elements[i].value);
			}
			else
			{
				alert("La NOTA ingresada es Incorrecta");
				pform.elements[i].focus();
				return false;
			}
		}
	}
	
	var vlink = "act_savenota.php";
	var vparam = "rNum_mat=" + vNum_mat + "&rMod_not=" + vMod_not + "&rNot_cur=" + vNot_cur;
	var vlayer = "dnotas";

	openpagepost(vlink, vparam, vlayer, true, "");	
}

function act_saveactapre()
{
	var vlink = "act_saveactapre.php";
	var vlayer = "dnotas";
	openpageget(vlink, vlayer, true, "");
}
function act_saveacta()
{
	var vlink = "act_saveacta.php";
	var vlayer = "dnotas";
	openpageget(vlink, vlayer, true, "");
}

//--------------------------------------
function sil_newsilabo()
{
	var vlink = "sil_newsilabo.php";
	var vparam = "rIns_upd=i";
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
//--------------------------------------
function sil_updsilabo(pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "sil_getcanca.php";
	var vparam = "rIns_upd=u&rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function sil_delsilabopre(pcod_car, ppln_est, pcod_cur, psec_gru, pmod_mat)
{
	var vlink = "sil_delsilabopre.php";
	var vparam = "rCod_car=" + pcod_car + "&rPln_est=" + ppln_est + "&rCod_cur=" + pcod_cur + "&rSec_gru=" + psec_gru + "&rMod_mat=" + pmod_mat;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function sil_delsilabo()
{
	var vlink = "sil_delsilabo.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}
function sil_viewsemcurgru(pcod_car)
{
	var vlink = "sil_viewsemcurgru.php";
	var vparam = "rCod_car=" + pcod_car;
	var vlayer = "dsemcurgru";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function sil_viewsemcurgrupln(ppln_est)
{
	var vlink = "sil_viewsemcurgrupln.php";
	var vparam = "rPln_est=" + ppln_est;
	var vlayer = "dsemcurgru";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function sil_viewsemcurso(psem_anu)
{
	var vlink = "sil_viewsemcurso.php";
	var vparam = "rSem_anu=" + psem_anu;
	var vlayer = "dcurso";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function sil_viewmencion(pcod_cur)
{
	var vlink = "sil_viewmencion.php";
	var vparam = "rCod_cur=" + pcod_cur;
	var vlayer = "dmencion";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function sil_getcanca(pform)
{
	var vCod_cur = pform.rCod_cur.value;
	var vSec_gru = pform.rSec_gru.value;
	
	var vlink = "sil_getcanca.php";
	var vparam = "rIns_upd=i&rCod_cur=" + vCod_cur + "&rSec_gru=" + vSec_gru;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function sil_getdesca(pform)
{
	var vCan_cap = pform.rCan_cap.value;
	var vCan_act = pform.rCan_act.value;
	
	var vlink = "sil_getdesca.php";
	var vparam = "rCan_cap=" + vCan_cap + "&rCan_act=" + vCan_act;
	var vlayer = "dsilabo";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function sil_savesilabo(pform)
{
	var i = 0;
	var j = 0;
	var vCap_act = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar las Capacidades y Actitudes !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vCap_act = vCap_act + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vlink = "sil_savesilabo.php";
	var vparam = vCap_act;
	var vlayer = "dsilabo";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}

function psw_savepasswd(pform)
{
	var vOldpasswd = pform.rOldpasswd.value;
	var vNewpasswd = pform.rNewpasswd.value;
	var vReppasswd = pform.rReppasswd.value;	
	
	if(pform.rOldpasswd.value.length < 4 || pform.rNewpasswd.value.length < 4 || pform.rReppasswd.value.length < 4)
	{
		alert("La Contraseña debe de tener al menos 4 caracters ... !");
		pform.rOldpasswd.focus();
	}
	else
	{
		var vlink = "psw_savepasswd.php";
		var vparam = "rOldpasswd=" + vOldpasswd + "&rNewpasswd=" + vNewpasswd + "&rReppasswd=" + vReppasswd;
		var vlayer = "dsubcontent";

		openpagepost(vlink, vparam, vlayer, true, "");
	}
}

//-------------------------------------------
//-------------------------------------------
function si2_newsilabo()
{
	var vlink = "si2_newsilabo.php";
	var vparam = "rIns_upd=i";
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function si2_getdocente(pform)
{
	var vCod_cur = pform.rCod_cur.value;
	var vSec_gru = pform.rSec_gru.value;
	
	var vlink = "si2_getdocente.php";
	var vparam = "rIns_upd=i&rCod_cur=" + vCod_cur + "&rSec_gru=" + vSec_gru;
	var vlayer = "dsubcontent";

	openpagepost(vlink, vparam, vlayer, true, "");
}
function si2_getfuncon(pform)
{
	var vCod_car = pform.rCod_car.value;
	var vDep_aca = pform.rDep_aca.value;
	var vCnd_prf = pform.rCnd_prf.value;
	var vCod_cat = pform.rCod_cat.value;
	var vCod_gru = pform.rCod_gru.value;
	var vEsp_doc = pform.rEsp_doc.value;
	var vCod_amb = pform.rCod_amb.value;
	
	var vlink = "si2_getfuncon.php";
	var vparam = "rCod_car=" + vCod_car + "&rDep_aca=" + vDep_aca + "&rCnd_prf=" + vCnd_prf + "&rCod_cat=" + vCod_cat + "&rCod_gru=" + vCod_gru + "&rEsp_doc=" + vEsp_doc + "&rCod_amb=" + vCod_amb;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");
}
function si2_getcontra(pcan_cnt)
{
	var vlink = "si2_getcontra.php";
	var vparam = "rCan_cnt=" + pcan_cnt;
	var vlayer = "dcontra";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function si2_getcompe(pform)
{
	var i = 0;
	var j = 0;
	var vData = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar los Contenidos Transversales !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vData = vData + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vlink = "si2_getcompe.php";
	var vparam = vData;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}
function si2_getcompedata(pcan_com)
{
	var vlink = "si2_getcompedata.php";
	var vparam = "rCan_com=" + pcan_com;
	var vlayer = "dcontra";

	openpagepost(vlink, vparam, vlayer, false, "");
}
function si2_getheaderuna(pform)
{
	var i = 0;
	var j = 0;
	var vData = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar los Datos solicitados !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vData = vData + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vCan_una = pform.rCan_una.value;
	
	var vlink = "si2_getheaderuna.php";
	var vparam = "rCan_una=" + vCan_una + vData;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}
function si2_getbodyuna(pform)
{
	var i = 0;
	var j = 0;
	var vData = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar los Datos solicitados !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vData = vData + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vHrs_una = pform.rHrs_una.value;
	var vFch_des = pform.rFch_des.value;
	var vFch_al = pform.rFch_al.value;
	var vNum_com = pform.rNum_com.value;
	
	var vlink = "si2_getbodyuna.php";
	var vparam = "rHrs_una=" + vHrs_una + "&rFch_des=" + vFch_des + "&rFch_al=" + vFch_al + "&rNum_com=" + vNum_com + vData;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}

function si2_getheaderunax(pform)
{
	var i = 0;
	var j = 0;
	var vData = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar los Datos solicitados !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vData = vData + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vlink = "si2_getheaderuna.php";
	var vparam = vData;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}
function si2_getevalua(pform)
{
	var i = 0;
	var j = 0;
	var vData = "";
	var vCadena = "";
	var vNewcad = "";
	var vTam = 0;
	
	for (i = 0; i < pform.elements.length; i++) 
	{
		if(pform.elements[i].type == "textarea") 
		{
			vNewcad = "";
			if(pform.elements[i].value == "")
			{
				alert("Tiene que ingresar los Datos solicitados !!!");
				pform.elements[i].focus();
				return false;
			}
			else
			{
				vCadena = pform.elements[i].value;
				vTam = pform.elements[i].value.length;
				for(j = 0; j < vTam; j++)
				{
					if(vCadena.substring(j, j+1) == 'Á')
						vNewcad = vNewcad + 'A';
					else if(vCadena.substring(j, j+1) == 'É')
						vNewcad = vNewcad + 'E';
					else if(vCadena.substring(j, j+1) == 'Í')
						vNewcad = vNewcad + 'I';
					else if(vCadena.substring(j, j+1) == 'Ó')
						vNewcad = vNewcad + 'O';
					else if(vCadena.substring(j, j+1) == 'Ú')
						vNewcad = vNewcad + 'U';
					else if(vCadena.substring(j, j+1) == 'Ñ')
						vNewcad = vNewcad + 'N';
					else
						vNewcad = vNewcad + vCadena.substring(j, j+1);
				}
				vData = vData + "&" +  pform.elements[i].id + "=" + vNewcad;
			}
		}
	}	
	
	var vlink = "si2_getevalua.php";
	var vparam = vData;
	var vlayer = "dsubcontent";
	
	openpagepost(vlink, vparam, vlayer, true, "");	
}
function si2_savetipoeva(pform)
{
	var vTip_eva = pform.rTip_eva.value;
	var vUni_pro = pform.rUni_pro.value;
	var vDes_eva = pform.rDes_eva.value;
	var vFch_eva = pform.rFch_eva.value;
	var vPor_eva = pform.rPor_eva.value;
	
	pform.rDes_eva.value = "";
	pform.rFch_eva.value = "";
	pform.rPor_eva.value = "";
	
	var vlink = "si2_getevaluadata.php";
	var vparam = "rTip_eva=" + vTip_eva + "&rUni_pro=" + vUni_pro + "&rDes_eva=" + vDes_eva + "&rFch_eva=" + vFch_eva + "&rPor_eva=" + vPor_eva;
	var vlayer = "devalua";
	
	openpagepost(vlink, vparam, vlayer, true, "");
}

function si2_getevaluacap()
{
	var vlink = "si2_getevaluacap.php";
	var vlayer = "dsubcontent";
	openpageget(vlink, vlayer, true, "");
}

//-------------------------------------------
//-------------------------------------------
function con_searchdoc(pform)
{
	var vCod_prf = pform.rCod_prf.value;
	var vPaterno = pform.rPaterno.value;
	var vMaterno = pform.rMaterno.value;
	var vNombres = pform.rNombres.value;
	
	var vlink = "con_viewdoce.php";
	var vparam = "rCod_prf=" + vCod_prf + "&rPaterno=" + vPaterno + "&rMaterno=" + vMaterno + "&rNombres=" + vNombres;
	var vlayer = "dresultado";
	
	clearlayer("dpasswd");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}
function con_viewpasswd(pcod_prf)
{
	var vlink = "con_viewpasswd.php";
	var vparam = "rCod_prf=" + pcod_prf;
	var vlayer = "dpasswd";

	openpagepost(vlink, vparam, vlayer, true, "");
}

function con_searchestu(pform)
{
	var vNum_mat = pform.rNum_mat.value;
	
	var vlink = "con_viewestu.php";
	var vparam = "rNum_mat=" + vNum_mat;
	var vlayer = "dresultado";
	
	clearlayer("dpasswd");
	
	openpagepost(vlink, vparam, vlayer, false, "");
}
function con_viewpasswdestu(pnum_mat)
{
	var vlink = "con_viewpasswdestu.php";
	var vparam = "rNum_mat=" + pnum_mat;
	var vlayer = "dpasswd";

	openpagepost(vlink, vparam, vlayer, true, "");
}