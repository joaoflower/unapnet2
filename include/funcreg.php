<?php	
	function finitr()
	{
		global $sReguser;
		$sReguser['safety'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
		$sReguser['init'] = '1';
	}
	
	function fverifyrv()
	{
		global $sReguser;
		if ($sReguser['safety'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sReguser['init'] == '1')
		{
			$vjj = 0;
			$vch = '8';
			$vTamcod = strlen($sReguser['codigo']);
			$vTamcar = strlen($sReguser['cod_car']);
			$vTampas = strlen($sReguser['passwd']);
			//--------------------------------------------------
			for ($vjj = 0; $vjj < $vTamcod ; $vjj++)
			{
				$vch = substr($sReguser['codigo'], $vjj, 1);
				if ( !($vch >= '0' && $vch <= '9'))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL C&Oacute;DIGO DEBE SER N&Uacute;MERICO';
					return FALSE;
				}			
			}
			if($vTamcod < 4 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = "ERROR, EL C&Oacute;DIGO DEBE DE TENER AL MENOS 4 CARACTERES $vTamcod".$sReguser['codigo'];
				return FALSE;
			}
			//--------------------------------------------------
			for ($vjj = 0; $vjj < $vTamcar ; $vjj++)
			{
				$vch = substr($sReguser['cod_car'], $vjj, 1);
				if ( !($vch >= '0' && $vch <= '9'))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, LA CARRERA PROFESIONAL ES INCORRECTA';
					return FALSE;
				}			
			}
			if($vTamcar != 2 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA CARRERA PROFESIONAL ES INCORRECTA';
				return FALSE;
			}
			//--------------------------------------------------
			if($vTampas < 5 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA CONTRASEÑA DEBE TENER AL MENOS 5 CARACTERES';
				return FALSE;
			}
			//--------------------------------------------------
			return TRUE;
		}
		else
		{			
			$sReguser['error'] = TRUE;
			$sReguser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAn REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}		
	}
	
	function fverifyrd()
	{
		global $sReguser;
		if ($sReguser['safetyd'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sReguser['init'] == '1')
		{
			return TRUE;
		}
		else
		{
			$sReguser['error'] = TRUE;
			$sReguser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAn REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}
	}
	
	function fverifyrr()
	{
		global $sReguser;
		if (fverifyrd())
		{
			$tLogin = strlen($sReguser['login']);
			$tPasswd = strlen($sReguser['passwd']);
			$tRecorda = strlen($sReguser['recorda']);
			$tTipodoc = strlen($sReguser['tip_doc']);
			$tNum_doc = strlen($sReguser['num_doc']);
			$tSexo = strlen($sReguser['sexo']);
			$tDia = strlen($sReguser['dia']);
			$tMes = strlen($sReguser['mes']);
			$tAno = strlen($sReguser['ano']);
			$tDirecc = strlen($sReguser['direc']);
			$tTelefono = strlen($sReguser['fono']);
			$tCelular = strlen($sReguser['celular']);
			$tEcivil = strlen($sReguser['est_civ']);
			//$tCiudad = strlen($sReguser['ciudad']);
			
			$vjj = 0;
			$vch = '8';
			$vMes = $sReguser['mes'];
	
			if($tLogin < 5 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO DEBE DE TENER AL MENOS 5 CARACTERES.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					if ( $sReguser['login'][$vjj] == ' ')
					{
						$sReguser['error'] = TRUE;
						$sReguser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO NO DEBE DE TENER ESPACIOS EN BLANCO.';
						return FALSE;
					}
			}
			$vch = $sReguser['login'][0];
			if (!($vch >= 'a' && $vch <= 'z'))
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL PRIMER CARACTER DEL NOMBRE DE USUARIO DEBE SER UN CARACTER EN MINUSCULA.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					$vch = $sReguser['login'][$vjj];
					if ( !(($vch >= "a" && $vch <= "z") || ($vch == "_") || ($vch == "-") || ($vch >= "0" && $vch <= "9")) )
					{
						$sReguser['error'] = TRUE;
						$sReguser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO EXISTEN CARACTERES QUE NO SON VALIDO O ESTAN EN MAYUSCULA.';
						return FALSE;
					}
			}
			if($tPasswd < 5 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA CONTRASEÑA DEBE DE TENER AL MENOS 5 CARACTERES.';
				return FALSE;
			}
			if($sReguser['passwd'] != $sReguser['passwd2'])
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LAS CONTRASEÑAS INGRESADAS NO COINCIDEN.';
				return FALSE;
			}
			if($tRecorda < 5 )
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL RECORDATORIO DEBE DE TENER AL MENOS 5 CARACTERES.';
				return FALSE;
			}
	
			if($sReguser['num_doc'] == '')
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL NUMERO DE DOCUMENTO NO DEBE ESTAR VACIO.';
				return FALSE;
			}
			if($sReguser['tip_doc'] == '01')
			{
				if($tNum_doc != 8)
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL NÚMERO DEL DNI DEBED DE SER DE 8 NUMEROS.';
					return FALSE;
				}
				for ($vjj = 0; $vjj < $tNum_doc; $vjj++)
				{
					$vch = $sReguser['num_doc'][$vjj];
					if ( !($vch >= "0" && $vch <= "9"))
					{
						$sReguser['error'] = TRUE;
						$sReguser['msnerror'] = 'ERROR, EL NÚMERO DE MATRÍCULA DEBE DE SER NUMÉRICO.';
						return FALSE;
					}
				}
			}		
			if($sReguser['tip_doc'] == '02' && $tNum_doc != 10)
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL NUMERO DE LA LIBRETA MILITAR DEBE SER DE 10 NUMEROS.';
				return FALSE;
			}
			if($sReguser['dia'] == '')
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO PUEDE ESTAR VACIO.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tDia; $vjj++)
			{
				$vch = $sReguser['dia'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}
	
			if($sReguser['ano'] == '')
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO NO PUEDE ESTAR VACIO.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tAno; $vjj++)
			{
				$vch = $sReguser['ano'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}
	
			if (($vMes == "01" || $vMes == "03" || $vMes == "05" || $vMes == "07" || $vMes == "08" || $vMes == "10" || $vMes == "12" ) &&
				($sReguser['dia'] > 31 || $sReguser['dia'] < 1))
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "04" || $vMes == "06" || $vMes == "09" || $vMes == "11" ) &&
				($sReguser['dia'] > 30 || $sReguser['dia'] < 1))
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "02") && ($sReguser['dia'] > 28 || $sReguser['dia'] < 1) &&
				$sReguser['ano'] % 4 != 0)
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "02") && ($sReguser['dia'] > 29 || $sReguser['dia'] < 1) &&
				$sReguser['ano'] % 4 == 0)
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if($sReguser['direc'] == '')
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA DIRECCIÓN NO PUEDE ESTAR VACIO.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tTelefono; $vjj++)
			{
				$vch = $sReguser['fono'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL TELÉFONO DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}

			for ($vjj = 0; $vjj < $tCelular; $vjj++)
			{
				$vch = $sReguser['celular'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sReguser['error'] = TRUE;
					$sReguser['msnerror'] = 'ERROR, EL CELULAR DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}

			/*if($sReguser['ciudad'] == '')
			{
				$sReguser['error'] = TRUE;
				$sReguser['msnerror'] = 'ERROR, LA CIUDAD NO PUEDE ESTAR VACIA.';
				return FALSE;
			}*/
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function fverifyrf()
	{
		global $sReguser;
		if ($sReguser['safetyv'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sReguser['init'] == '1')
		{
			return TRUE;
		}
		else
		{
			$sReguser['error'] = TRUE;
			$sReguser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAn REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}
	}
?>
