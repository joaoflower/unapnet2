<?php
	session_start();
	include "../include/function.php";
	include "../include/funcreg.php";

	$sReguser['login'] = $_POST['rLogin'];
	$sReguser['passwd'] = $_POST['rPasswd'];
	$sReguser['passwd2'] = $_POST['rPasswd2'];
	$sReguser['recorda'] = $_POST['rRecorda'];
	$sReguser['oemail'] = $_POST['rOemail'];
	$sReguser['tip_doc'] = $_POST['rTip_doc'];
	$sReguser['num_doc'] = $_POST['rNum_doc'];
	$sReguser['sexo'] = $_POST['rSexo'];
	$sReguser['dia'] = $_POST['rDia'];
	$sReguser['mes'] = $_POST['rMes'];
	$sReguser['ano'] = $_POST['rAno'];
	$sReguser['dia'] = $_POST['rDia'];
	$sReguser['direc'] = $_POST['rDirec'];
	$sReguser['fono'] = $_POST['rFono'];
	$sReguser['celular'] = $_POST['rCelular'];
	$sReguser['est_civ'] = $_POST['rEst_civ'];
	$sReguser['cod_nac'] = $_POST['rCod_nac'];
	$sReguser['cod_dep'] = $_POST['rCod_dep'];
	$sReguser['cod_prv'] = $_POST['rCod_prv'];
	$sReguser['cod_dis'] = $_POST['rCod_dis'];
		
	if(fverifyrd())
	{
		if(fverifyrr())
		{
			$bUsulog = FALSE;
			$bUsucod = FALSE;
			$bInsert = FALSE;

			$vQuery = "Select login from unapnet.usuario where login = '{$sReguser['login']}'";
			$cUsuario = fQuery($vQuery);
			if($aUsuario = mysql_fetch_array($cUsuario))
				$bUsulog = TRUE;
			
			if ($sReguser['tip_usu'] == '1')
			{
				$vQuery = "Select num_mat, cod_car from unapnet.usuest where num_mat = '{$sReguser['codigo']}' ";
				$vQuery .= "and cod_car = '{$sReguser['cod_car']}'"; 
				$cUsuario2 = fQuery($vQuery);
				if($aUsuario2 = mysql_fetch_array($cUsuario2))
					$bUsucod = TRUE;
			}
			elseif ($sReguser['tip_usu'] == '2')
			{
				$vQuery = "Select cod_prf from unapnet.usudoc where cod_prf = '{$sReguser['codigo']}' ";
				$cUsuario2 = fQuery($vQuery);
				if($aUsuario2 = mysql_fetch_array($cUsuario2))
					$bUsucod = TRUE;
			}
			elseif ($sReguser['tip_usu'] == '3')
			{
				$vQuery = "Select cod_unap from unapnet.usuidio where cod_unap = '{$sReguser['codigo']}' ";
				$cUsuario2 = fQuery($vQuery);
				if($aUsuario2 = mysql_fetch_array($cUsuario2))
					$bUsucod = TRUE;
			}
						
			if(!$bUsulog)
			{
				if(!$bUsucod)
				{
					$sReguser['fec_nac'] = "19{$sReguser['ano']}-{$sReguser['mes']}-{$sReguser['dia']}";
					$vFecha = getdate(time());
					$sReguser['fec_reg'] = "{$vFecha['year']}-{$vFecha['mon']}-{$vFecha['mday']} {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']}";
					$sReguser['num_ip'] = $REMOTE_ADDR;
					
					if ($sReguser['tip_usu'] == '1')
					{					
						$vQuery1 = "update unapnet.estudiante set tip_doc = '{$sReguser['tip_doc']}', num_doc = '{$sReguser['num_doc']}', ";
						$vQuery1 .= "fch_nac = '{$sReguser['fec_nac']}', sexo = '{$sReguser['sexo']}', est_civ = '{$sReguser['est_civ']}', ";
						$vQuery1 .= "cod_nac = '{$sReguser['cod_nac']}', cod_dep = '{$sReguser['cod_dep']}', cod_prv = '{$sReguser['cod_prv']}', ";
						$vQuery1 .= "cod_dis = '{$sReguser['cod_dis']}', direc = '{$sReguser['direc']}', fono = '{$sReguser['fono']}', ";
						$vQuery1 .= "email = '{$sReguser['oemail']}', celular = '{$sReguser['celular']}' ";
						$vQuery1 .= "where num_mat = '{$sReguser['codigo']}' and cod_car = '{$sReguser['cod_car']}'";
						
						$vQuery2 = "insert into unapnet.usuario values ('{$sReguser['login']}')";
						
						$vQuery3 = "insert into unapnet.usuest values ('{$sReguser['login']}', '{$sReguser['codigo']}', '{$sReguser['cod_car']}', ";
						$vQuery3 .= "password('{$sReguser['passwd']}'), '{$sReguser['recorda']}', '{$sReguser['oemail']}', ";
						$vQuery3 .= "'{$sReguser['fec_reg']}', '{$sReguser['num_ip']}')";
						
						$bInsert = fInewusu($vQuery1, $vQuery2, $vQuery3);
					}
					elseif ($sReguser['tip_usu'] == '2')
					{
						$vQuery1 = "update unapnet.docente set tip_doc = '{$sReguser['tip_doc']}', num_doc = '{$sReguser['num_doc']}', ";
						$vQuery1 .= "fch_nac = '{$sReguser['fec_nac']}', sexo = '{$sReguser['sexo']}', est_civ = '{$sReguser['est_civ']}', ";
						$vQuery1 .= "cod_nac = '{$sReguser['cod_nac']}', cod_dep = '{$sReguser['cod_dep']}', cod_prv = '{$sReguser['cod_prv']}', ";
						$vQuery1 .= "cod_dis = '{$sReguser['cod_dis']}', direc = '{$sReguser['direc']}', fono = '{$sReguser['fono']}', ";
						$vQuery1 .= "email = '{$sReguser['oemail']}', celular = '{$sReguser['celular']}' ";
						$vQuery1 .= "where cod_prf = '{$sReguser['codigo']}'";
						
						$vQuery2 = "insert into unapnet.usuario values ('{$sReguser['login']}')";
						
						$vQuery3 = "insert into unapnet.usudoc values ('{$sReguser['login']}', '{$sReguser['codigo']}', '{$sReguser['cod_car']}', ";
						$vQuery3 .= "password('{$sReguser['passwd']}'), '{$sReguser['recorda']}', '{$sReguser['oemail']}', ";
						$vQuery3 .= "'{$sReguser['fec_reg']}', '{$sReguser['num_ip']}')";
						
						$bInsert = fInewusu($vQuery1, $vQuery2, $vQuery3);
					}
					elseif ($sReguser['tip_usu'] == '3')
					{
						$vQuery1 = "update dbcidiomas.estudiantes set tip_doc = '{$sReguser['tip_doc']}', num_doc = '{$sReguser['num_doc']}', ";
						$vQuery1 .= "cod_sex = '{$sReguser['sexo']}', dir_est = '{$sReguser['direc']}', fon_est = '{$sReguser['celular']}', ";
						$vQuery1 .= "email = '{$sReguser['oemail']}' ";
						$vQuery1 .= "where cod_unap = '{$sReguser['codigo']}'";
						
						$vQuery2 = "insert into unapnet.usuario values ('{$sReguser['login']}')";
						
						$vQuery3 = "insert into unapnet.usuidio values ('{$sReguser['login']}', '{$sReguser['codigo']}', '{$sReguser['cod_car']}', ";
						$vQuery3 .= "password('{$sReguser['passwd']}'), '{$sReguser['recorda']}', '{$sReguser['oemail']}', ";
						$vQuery3 .= "'{$sReguser['fec_reg']}', '{$sReguser['num_ip']}')";
						
						$bInsert = fInewusu($vQuery1, $vQuery2, $vQuery3);
					}
															
					if($bInsert)
					{
						$sReguser['safetyv'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
						header("Location:view.php");
					}
					else	
					{
						$sReguser['error'] = TRUE;
						$sReguser['msnerror'] = "ERROR, NO SE PUDO INGRESAR LOS DATOS, INTENTELO DE NUEVO";
						header("Location:data.php");
					}
				}
				else
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = "ERROR, USTED YA TIENE UNA CUENTA EN Un@p.Net2";
					header("Location:data.php");
				}
			}
			else
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = "ERROR, EL NOMBRE DE USUARIO SELECCIONADO ({$sReguser['login']}), YA EXISTE, ESCRIBA OTRO";
				header("Location:data.php");
			}
		}
		else
		{
			$sReguser['error'] = TRUE;
			//$sReguser['msnerror'] = "ERROR, LOS DATOS INGRESADOS SON INCORRECTOS";
			header("Location:data.php");	
		}
	}
	else
		header("Location:index2.php");	
?>