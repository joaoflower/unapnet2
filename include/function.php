<?php
	include "funcsql.php";
	function finit()
	{
		global $sConeun, $sConedb, $sCarrera, $sTipousu, $sTipodoc, $sSexo, $sMes, $sEstcivil, $sFacultad, $sNacional;
	/*	$sConeun['host'] = '10.1.1.138';
		$sConeun['user'] = 'unapmatri';
		$sConeun['passwd'] = 'master2005';
		
		$sConedb['host'] = '10.1.1.138';
		$sConedb['user'] = 'unapmatri';
		$sConedb['passwd'] = 'master2005';*/
		
		$sConeun['host'] = '10.1.1.134';
		$sConeun['user'] = 'unapmatri';
		$sConeun['passwd'] = 'master2005';
		
		$sConedb['host'] = '10.1.1.134';
		$sConedb['user'] = 'unapmatri';
		$sConedb['passwd'] = 'master2005';
		
		$sConedb['hosti'] = '10.1.1.134';
		$sConedb['useri'] = 'developer';
		$sConedb['passwdi'] = 'xDeveloper2k7';

/*		$sConeun['host'] = 'localhost';
		$sConeun['user'] = 'root';
		$sConeun['passwd'] = '';
		
		$sConedb['host'] = 'localhost';
		$sConedb['user'] = 'root';
		$sConedb['passwd'] = '';*/
		
		//-------------------------------------------------------------------------
		$vQuery = "Select cod_car, car_des from unapnet.carrera where (cod_car < '37' or cod_car = '56' or cod_car = '61' or cod_car = '87' or cod_car = '88') and cod_car <> '19'";
		$cCarrera = fQuery($vQuery);
		while($aCarrera = mysql_fetch_array($cCarrera))
			$sCarrera[$aCarrera['cod_car']] = $aCarrera['car_des'];
		
		//-------------------------------------------------------------------------
		$vQuery = "Select facultad.cod_fac, carrera.cod_car, facultad.fac_des from unapnet.carrera left join unapnet.facultad on ";
		$vQuery .= " carrera.cod_fac = facultad.cod_fac where (cod_car < '37' or cod_car = '56' or cod_car = '61' or cod_car = '88') and cod_car <> '19'";		
		$cFacultad = fQuery($vQuery);
		while($aFacultad = mysql_fetch_array($cFacultad))
			$sFacultad[$aFacultad['cod_car']] = $aFacultad['fac_des'];

		//-------------------------------------------------------------------------
		$sTipousu['1'] = 'ESTUDIANTE';
		$sTipousu['2'] = 'DOCENTE';
		$sTipousu['3'] = 'PARTICULAR';
		
		//-------------------------------------------------------------------------
		$vQuery = "Select tip_doc, doc_des from unapnet.tipodoc where not tip_doc = '' and tip_doc < '07'";
		$cTipodoc = fQuery($vQuery);
		while($aTipodoc = mysql_fetch_array($cTipodoc))
			$sTipodoc[$aTipodoc['tip_doc']] = ucwords(strtolower($aTipodoc['doc_des']));

/*		$sDocumen['01'] = 'DNI';
		$sDocumen['02'] = 'Libreta Militar';
		$sDocumen['03'] = 'Boleta Militar';
		$sDocumen['04'] = 'Partida de Nacimiento';
		$sDocumen['05'] = 'Otros';*/
		
		//-------------------------------------------------------------------------
		$sSexo['1'] = 'Masculino';
		$sSexo['2'] = 'Femenino';
		
		//-------------------------------------------------------------------------
		$sMes['01'] = 'Enero';
		$sMes['1'] = 'Enero';
		$sMes['02'] = 'Febrero';
		$sMes['2'] = 'Febrero';
		$sMes['03'] = 'Marzo';
		$sMes['3'] = 'Marzo';
		$sMes['04'] = 'Abril';
		$sMes['4'] = 'Abril';
		$sMes['05'] = 'Mayo';
		$sMes['5'] = 'Mayo';
		$sMes['06'] = 'Junio';
		$sMes['6'] = 'Junio';
		$sMes['07'] = 'Julio';
		$sMes['7'] = 'Julio';
		$sMes['08'] = 'Agosto';
		$sMes['8'] = 'Agosto';
		$sMes['09'] = 'Setiembre';
		$sMes['9'] = 'Setiembre';
		$sMes['10'] = 'Octubre';
		$sMes['11'] = 'Noviembre';
		$sMes['12'] = 'Diciembre';		
		
		//-------------------------------------------------------------------------
		$vQuery = "Select est_civ, est_des from unapnet.estcivil where not est_civ = ''";
		$cEstcivil = fQuery($vQuery);
		while($aEstcivil = mysql_fetch_array($cEstcivil))
			$sEstcivil[$aEstcivil['est_civ']] = ucwords(strtolower($aEstcivil['est_des']));

		/*$sEcivil['01'] = 'Solter@';
		$sEcivil['02'] = 'Casad@';
		$sEcivil['03'] = 'Viud@';
		$sEcivil['04'] = 'Separad@';
		$sEcivil['05'] = 'Otros';		*/
		
		//-------------------------------------------------------------------------
		$vQuery = "Select cod_nac, nac_des from unapnet.nacional where not cod_nac = ''";
		$cNacional = fQuery($vQuery);
		while($aNacional = mysql_fetch_array($cNacional))
			$sNacional[$aNacional['cod_nac']] = ucwords(strtolower($aNacional['nac_des']));

	}
	
	function fmsnerror ($pError)
	{
    	echo "<table border='0' cellpadding='0' cellspacing='0'>        
        <tr>
          <td><img name='ventana_r1_c1' src='../images/ventana_r1_c1.jpg' width='12' height='29' border='0' alt=''></td>
          <td align='center' background='../images/ventana_r1_c2.jpg' class='timporbb'> ERROR - ERROR </td>
          <td><img name='ventana_r1_c4' src='../images/ventana_r1_c4.jpg' width='11' height='29' border='0' alt=''></td>
        </tr>
        <tr>
          <td background='../images/ventana_r2_c1.jpg'></td>
          <td background='../images/ventana_r2_c2.jpg' class='timporbb'>$pError</td>
          <td background='../images/ventana_r2_c4.jpg'></td>
        </tr>
        <tr>
          <td><img name='ventana_r4_c1' src='../images/ventana_r4_c1.jpg' width='12' height='10' border='0' alt=''></td>
          <td background='../images/ventana_r4_c2.jpg'></td>
          <td><img name='ventana_r4_c4' src='../images/ventana_r4_c4.jpg' width='11' height='10' border='0' alt=''></td>
        </tr>
      </table>";
	}
	function fmsnerrors ($pError)
	{
    	echo "<table border='0' cellpadding='0' cellspacing='0'>        
        <tr>
          <td><img name='ventana_r1_c1' src='../../images/ventana_r1_c1.jpg' width='12' height='29' border='0' alt=''></td>
          <td align='center' background='../../images/ventana_r1_c2.jpg' class='timporbb'> ERROR - ERROR </td>
          <td><img name='ventana_r1_c4' src='../../images/ventana_r1_c4.jpg' width='11' height='29' border='0' alt=''></td>
        </tr>
        <tr>
          <td background='../../images/ventana_r2_c1.jpg'></td>
          <td background='../../images/ventana_r2_c2.jpg' class='timporbb'>$pError</td>
          <td background='../../images/ventana_r2_c4.jpg'></td>
        </tr>
        <tr>
          <td><img name='ventana_r4_c1' src='../../images/ventana_r4_c1.jpg' width='12' height='10' border='0' alt=''></td>
          <td background='../../images/ventana_r4_c2.jpg'></td>
          <td><img name='ventana_r4_c4' src='../../images/ventana_r4_c4.jpg' width='11' height='10' border='0' alt=''></td>
        </tr>
      </table>";
	}
	function fwindow ($pTitle, $pMessage)
	{
		return "<table border='0' cellpadding='0' cellspacing='0'>        
        <tr>
          <td><img name='ventana_r1_c1' src='../../images/ventana_r1_c1.jpg' width='12' height='29' border='0' alt=''></td>
          <td align='center' background='../../images/ventana_r1_c2.jpg' class='tlargebb'>$pTitle</td>
          <td><img name='ventana_r1_c4' src='../../images/ventana_r1_c4.jpg' width='11' height='29' border='0' alt=''></td>
        </tr>
        <tr>
          <td background='../../images/ventana_r2_c1.jpg'></td>
          <td background='../../images/ventana_r2_c2.jpg' class='tnormalbn' align = 'center'>$pMessage</td>
          <td background='../../images/ventana_r2_c4.jpg'></td>
        </tr>
        <tr>
          <td><img name='ventana_r4_c1' src='../../images/ventana_r4_c1.jpg' width='12' height='10' border='0' alt=''></td>
          <td background='../../images/ventana_r4_c2.jpg'></td>
          <td><img name='ventana_r4_c4' src='../../images/ventana_r4_c4.jpg' width='11' height='10' border='0' alt=''></td>
        </tr>
      </table>";
	}
	function ftabledata($pHeader, $pBody, $pWidth = 460)
	{
		$vTable = "<table width='$pWidth' border='1' cellpadding='0' cellspacing='0' bordercolor='#FFFFFF' class='tnormalbn'>";
		$vTable .= "<tr align='center' class='cabecera'>";
		
		if(!empty($pHeader))
		foreach($pHeader as $vItem)
			$vTable .= "<td>&nbsp;$vItem&nbsp;</td>";
		
		$vTable .= "</tr>";
		$vCont = 1;
		
		if(!empty($pBody))
		foreach($pBody as $vRow)
		{
			if($vCont++%2 == 0)
				$vTable .= "<tr  class ='celdainpar'>";
			else
				$vTable .= "<tr  class ='celdapar'>";
			foreach($vRow as $vItem)
				$vTable .= "<td>&nbsp;&nbsp;$vItem&nbsp;&nbsp;</td>";
			$vTable .= "</tr>\n";
		}
		$vTable .= "</table>\n";
		return $vTable;
	}
	
	function ftablenota($pHeader, $pBody, $pWidth = 460)
	{
		$vTable = "<table width='$pWidth' border='1' cellpadding='1' cellspacing='0' bordercolor='#FFFFFF' class='tnormalbn'>";
		$vTable .= "<tr align='center' class='cabecera'>";
		
		if(!empty($pHeader))
		foreach($pHeader as $vItem)
			$vTable .= "<td>&nbsp;$vItem&nbsp;</td>";
		
		$vTable .= "</tr>";
		$vCont = 1;
		
		if(!empty($pBody))
		foreach($pBody as $vRow)
		{
			if($vCont++%2 == 0)
				$vTable .= "<tr  class ='celdainpar'>";
			else
				$vTable .= "<tr  class ='celdapar'>";
			foreach($vRow as $vItem)
				$vTable .= "<td>$vItem</td>";
			$vTable .= "</tr>\n";
		}
		$vTable .= "</table>\n";
		return $vTable;
	}
	
	function ftablerow($pBody, $pWidth = 20)
	{
		$vTable = "<table border='1' cellpadding='0' cellspacing='0' bordercolor='#DDDDDD' class='tnormalbn'>";		
		if(!empty($pBody))
		foreach($pBody as $vRow)
		{
			$vTable .= "<tr class ='celdainpar'>";
			foreach($vRow as $vItem)
				$vTable .= "<td  width='$pWidth' align='right'>&nbsp;$vItem&nbsp;</td>";
			$vTable .= "</tr>";
		}
		$vTable .= "</table>";
		return $vTable;
	}
	
	function fviewcar($pCod_Car)
	{
		global $sCarrera;
		$vReturn = '';

		foreach($sCarrera as $vCod_Car => $vCar_Des)
		{
			$vReturn .= "<option value='$vCod_Car'";
			if ($vCod_Car == $pCod_Car) $vReturn .= " Selected";
			$vReturn .= " >$vCar_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewdoc($pTipodoc)
	{
		global $sTipodoc;
		$vReturn = '';

		foreach($sTipodoc as $vTipodoc => $vDoc_Des)
		{
			$vReturn .= "<option value='$vTipodoc'";
			if ($vTipodoc == $pTipodoc) $vReturn .= " Selected";
			$vReturn .= " >$vDoc_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewsex($pSexo)
	{
		global $sSexo;
		$vReturn = '';

		foreach($sSexo as $vSexo => $vSex_Des)
		{
			$vReturn .= "<option value='$vSexo'";
			if ($vSexo == $pSexo) $vReturn .= " Selected";
			$vReturn .= " >$vSex_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewmes($pMes)
	{
		global $sMes;
		$vReturn = '';

		foreach($sMes as $vMes => $vMes_Des)
		{
			if (strlen($vMes) == 2)
			{
				$vReturn .= "<option value='$vMes'";
				if ($vMes == $pMes) $vReturn .= " Selected";
				$vReturn .= " >$vMes_Des</option> \n";
			}
		}
		return $vReturn;
	}
	function fvieweci($pEcivil)
	{
		global $sEstcivil;
		$vReturn = '';

		foreach($sEstcivil as $vEcivil => $vEci_Des)
		{
			$vReturn .= "<option value='$vEcivil'";
			if ($vEcivil == $pEcivil) $vReturn .= " Selected";
			$vReturn .= " >$vEci_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewnac($pCod_Nac)
	{
		global $sNacional;
		$vReturn = '';

		foreach($sNacional as $vCod_Nac => $vNac_Des)
		{
			$vReturn .= "<option value='$vCod_Nac'";
			if ($vCod_Nac == $pCod_Nac) $vReturn .= " Selected";
			$vReturn .= " >$vNac_Des</option> \n";
		}
		return $vReturn;
	}
	function fviewdep($pCod_Dep)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_dep, dep_nom from unapnet.departam where not cod_dep = ''";
		$cDepartam = fQuery($vQuery);
		while($aDepartam = mysql_fetch_array($cDepartam))
		{
			$vReturn .= "<option value=\"{$aDepartam['cod_dep']}\"";
			if ($aDepartam['cod_dep'] == $pCod_Dep) $vReturn .= " Selected";
			$vReturn .= " >{$aDepartam['dep_nom']}</option> \n";
		}

		return $vReturn;
	}
	function fviewprv($pCod_Dep, $pCod_Prv)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_prv, prv_nom from unapnet.provinc where cod_dep = '{$pCod_Dep}' and not cod_prv = ''";
		$cProvinc = fQuery($vQuery);
		while($aProvinc = mysql_fetch_array($cProvinc))
		{
			$vReturn .= "<option value=\"{$aProvinc['cod_prv']}\"";
			if ($aProvinc['cod_prv'] == $pCod_Prv) $vReturn .= " Selected";
			$vReturn .= " >{$aProvinc['prv_nom']}</option> \n";
		}
		return $vReturn;
	}
	function fviewdis($pCod_Dep, $pCod_Prv, $pCod_Dis)
	{
		$vReturn = "<option value=''>Seleccione ...</option>\n";

		$vQuery = "Select cod_dis, dis_nom from unapnet.distrito where cod_dep = '{$pCod_Dep}' and cod_prv = '{$pCod_Prv}' and not cod_dis = ''";
		$cDistrito = fQuery($vQuery);
		while($aDistrito = mysql_fetch_array($cDistrito))
		{
			$vReturn .= "<option value=\"{$aDistrito['cod_dis']}\"";
			if ($aDistrito['cod_dis'] == $pCod_Dis) $vReturn .= " Selected";
			$vReturn .= " >{$aDistrito['dis_nom']}</option> \n";
		}
		return $vReturn;
	}
	function fviewesp($pEspecial)
	{
		global $sEspecial;
		$vReturn = '';

		foreach($sEspecial as $vEspecial => $vEsp_Des)
		{
			$vReturn .= "<option value='$vEspecial'";
			if ($vEspecial == $pEspecial) $vReturn .= " Selected";
			$vReturn .= " >$vEsp_Des</option> \n";
		}
		return $vReturn;
	}
	function fpassword($pPasswd)
	{
		$vQuery = "Select password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = mysql_fetch_array($cPasswd))
			return $aPasswd['passwd'];
	}
	function fold_password($pPasswd)
	{
		$vQuery = "Select old_password('$pPasswd') as passwd";
		$cPasswd = fQuery($vQuery);
		if($aPasswd = mysql_fetch_array($cPasswd))
			return $aPasswd['passwd'];
	}
	function fCondicion ($pVeces)
	{
		global $sTutor;
		switch ($pVeces)			
		{
			case 0: 
			case 1: $sTutor['mod_mat'] = "01";	break;
			case 2: $sTutor['mod_mat'] = "07";	break;
			case 3: $sTutor['mod_mat'] = "08";	break;
			case 4: 
			case 5:
			case 6:
			case 7: $sTutor['mod_mat'] = "11";	break;
		}
		switch ($pVeces)			
		{
			case 0: 
				if($sTutor['apr_pas'] > 16)
				{					
					$sTutor['crd_max'] = 24;
					if($sTutor['pro_pas'] > 13)		$sTutor['crd_max'] = 28;
					if($sTutor['pro_pas'] > 12 and $sTutor['pro_pas'] <= 13) $sTutor['crd_max'] = 26;					
				}
				else
				{	$sTutor['crd_max'] = 24; 	}
				break;
			case 1: $sTutor['crd_max'] = 24;	break;
			case 2: $sTutor['crd_max'] = 24;	break;
			case 3: case 4:  case 5: case 6: case 7: case 8: 
			case 9: $sTutor['crd_max'] = 16;	break;
		}			
	}
	function fModcurso ($pVeces)
	{
		switch ($pVeces)			
		{
			case 0: 
			case 1: return '01';
			case 2: return '07';
			case 3: return '08';
			case 4: return '11';
			case 5: return '13';
			case 6: return '14';
			case 7: 
			case 8: 
			case 9: return '15';
		}
	}
	function fModestudia ($pVeces, $pPromedio, $pCrdapro)
	{
		global $sUser;
		switch ($pVeces)			
		{
			case 0: 
			case 1: $sUser['mod_mat'] = '01';	break;
			case 2: $sUser['mod_mat'] = '07';	break;
			case 3: $sUser['mod_mat'] = '08';	break;
			case 4: $sUser['mod_mat'] = '11';	break;
			case 5: $sUser['mod_mat'] = '13';	break;
			case 6: $sUser['mod_mat'] = '14';	break;
			case 7: 
			case 8:
			case 9: $sUser['mod_mat'] = '15';	break;
		}
		
		switch ($sUser['cod_car'])
		{
			case '16': case '17':
				switch ($pVeces)			
				{
					case 0: 
						if($pCrdapro > 16)
						{	$sUser['max_crd'] = 28;
							if($pPromedio > 13)		$sUser['max_crd'] = 32;
							if($pPromedio > 12 and $pPromedio <= 13)	$sUser['max_crd'] = 30;		}
						else
						{	$sUser['max_crd'] = 28; 	}
						break;
					case 1: $sUser['max_crd'] = 28;	break;
					case 2: $sUser['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sUser['max_crd'] = 16;	break;
				}			
				break;
			case '18':
				switch ($pVeces)			
				{
					case 0: 
						if($pCrdapro > 16)
						{	$sUser['max_crd'] = 25;
							if($pPromedio > 13)		$sUser['max_crd'] = 29;
							if($pPromedio > 12 and $pPromedio <= 13)	$sUser['max_crd'] = 27;		}
						else
						{	$sUser['max_crd'] = 25; 	}
						break;
					case 1: $sUser['max_crd'] = 25;	break;
					case 2: $sUser['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sUser['max_crd'] = 16;	break;
				}
				break;
			case '20': case '21':
				switch ($pVeces)			
				{
					case 0: 
						if($pCrdapro > 16)
						{	$sUser['max_crd'] = 26;
							if($pPromedio > 13)		$sUser['max_crd'] = 30;
							if($pPromedio > 12 and $pPromedio <= 13)	$sUser['max_crd'] = 28;		}
						else
						{	$sUser['max_crd'] = 26; 	}
						break;
					case 1: $sUser['max_crd'] = 26;	break;
					case 2: $sUser['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sUser['max_crd'] = 16;	break;
				}
				break;
			default:
				switch ($pVeces)			
				{
					case 0: 
						if($pCrdapro > 16)
						{	$sUser['max_crd'] = 24;
							if($pPromedio > 13)		$sUser['max_crd'] = 28;
							if($pPromedio > 12 and $pPromedio <= 13)	$sUser['max_crd'] = 26;		}
						else
						{	$sUser['max_crd'] = 24; 	}
						break;
					case 1: $sUser['max_crd'] = 24;	break;
					case 2: $sUser['max_crd'] = 24;	break;
					case 3: case 4: case 5: case 6: case 7: case 8:
					case 9: $sUser['max_crd'] = 16;	break;
				}			
				break;
		}
	}
	function fviewgrupo($pSec_gru)
	{
		global $sGrupo;

		foreach($sGrupo as $vSec_gru => $vSec_des)
		{
			$vReturn .= "<option value='$vSec_gru'";
			if ($vSec_gru == $pSec_gru) $vReturn .= " Selected";
			$vReturn .= " >$vSec_des</option> \n";
		}
		return $vReturn;
	}
	function fConcurso ($pVeces)
	{
		switch ($pVeces)			
		{
			case 0: 
			case 1: return '01';
			case 2: return '07';
			case 3: return '08';
			case 4: 
			case 5:
			case 6:
			case 7: return '11';
		}
	}
	function fNacional($pCod_nac)
	{
		$vQuery = "Select nac_des from unapnet.nacional where cod_nac = '{$pCod_nac}'";
		$cNacional = fQuery($vQuery);
		if($aNacional = mysql_fetch_array($cNacional))
			return $aNacional['nac_des'];
		else
			return '';
	}
	function fDepartam($pCod_dep)
	{
		$vQuery = "Select dep_nom from unapnet.departam where cod_dep = '{$pCod_dep}'";
		$cDepartam = fQuery($vQuery);
		if($aDepartam = mysql_fetch_array($cDepartam))
			return $aDepartam['dep_nom'];
		else
			return '';
	}
	function fProvinc($pCod_dep, $pCod_prv)
	{
		$vQuery = "Select prv_nom from unapnet.provinc where cod_prv = '{$pCod_prv}' and cod_dep = '{$pCod_dep}'";
		$cProvinc = fQuery($vQuery);
		if($aProvinc = mysql_fetch_array($cProvinc))
			return $aProvinc['prv_nom'];
		else
			return '';
	}
	function fDistrito($pCod_dep, $pCod_prv, $pCod_dis)
	{
		$vQuery = "Select dis_nom from unapnet.distrito where cod_dis = '{$pCod_dis}' and cod_prv = '{$pCod_prv}' and cod_dep = '{$pCod_dep}'";
		$cDistrito = fQuery($vQuery);
		if($aDistrito = mysql_fetch_array($cDistrito))
			return $aDistrito['dis_nom'];
		else
			return '';
	}
	

/*
	$xSerdata = new mysqli($sConedb['host'], $sConedb['user'], $sConedb['passwd']);
		$vQuery = "Select cod_car, car_des from sys.carrera where (cod_car < '37' or cod_car = '56' or cod_car = '65' or cod_car = '66') and cod_car <> '19'";
		$cCarrera = $xSerdata->query($vQuery);
		while($aCarrera = $cCarrera->fetch_array())
			$sCarrera[$aCarrera['cod_car']] = $aCarrera['car_des'];
		$cCarrera->close();
		$xSerdata->close();
*/

?>
