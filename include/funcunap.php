<?php	
	function finitu()
	{
		global $sUser;
		$sUser['start'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
		$sUser['init'] = '1';
	}
	function fverifylo()
	{
		global $sUser;
		if ($sUser['start'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sUser['init'] == '1')
			return TRUE;
		return FALSE;
	}
	function fverifyld()
	{
		global $sUser;
		if(fverifylo())
		{
			$vjj = 0;
			$vch = '8';
			$tLogin = strlen($sUser['login']);
			$vTampas = strlen($sUser['passwd']);

			//--------------------------------------------------
			if($tLogin < 5 )
			{
				$sUser['errorl'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL USUARIO ES PEQUEÑO';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					if ( $sUser['login'][$vjj] == ' ')
					{
						$sUser['errorl'] = TRUE;
						$sUser['msnerror'] = 'ERROR, EL USUARIO ES INCORRECTO';
						return FALSE;
					}
			}
			$vch = $sUser['login'][0];
			if (!($vch >= 'a' && $vch <= 'z'))
			{
				$sUser['errorl'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL USUARIO ES INCORRECTO';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					$vch = $sUser['login'][$vjj];
					if ( !(($vch >= "a" && $vch <= "z") || ($vch == "_") || ($vch == "-") || ($vch >= "0" && $vch <= "9")) )
					{
						$sUser['errorl'] = TRUE;
						$sUser['msnerror'] = 'ERROR, EL USUARIO ES INCORRECTO';
						return FALSE;
					}
			}
			//--------------------------------------------------
			if($vTampas < 5 )
			{
				$sUser['errorl'] = TRUE;
				$sUser['msnerror'] = 'ERROR, LA CONTRASEÑA ES PEQUEÑA';
				return FALSE;
			}
			if($sUser['num_doc'] == '')
			{
				$sUser['errorl'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL NRO. DOCUMENTO ESTA VACIO';
				return FALSE;
			}
		}
		return TRUE;
	}
	function fverifyss()
	{
		global $sUser;
		if ($sUser['safetys'] === '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sUser['init'] == '1')
			return TRUE;
		return FALSE;
	}
	function fverifyss2()
	{
		global $sUser;
		if (fverifyss() and ($sUser['safetys2'] === '*25740E18E08CC91F492F1B38E5413E1B85E32A01') and substr($_SERVER['HTTP_REFERER'], 0, 40) === "http://www.unap.edu.pe/unapnet2/unapnet/")
			return TRUE;
		return FALSE;
	}
	function fverifyds()
	{
		global $sUser;
		if ($sUser['safetyd'] === '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sUser['init'] == '1')
			return TRUE;
		return FALSE;
	}
	function fverifyds2()
	{
		global $sUser;
		if (fverifyds() and ($sUser['safetyd2'] === '*25740E18E08CC91F492F1B38E5413E1B85E32A01') and substr($_SERVER['HTTP_REFERER'], 0, 40) === "http://www.unap.edu.pe/unapnet2/unapnet/")
			return TRUE;
		return FALSE;
	}
	function fverifysd()
	{
		global $sUser;

		$tRecorda = strlen($sUser['recorda']);
		$tTipodoc = strlen($sUser['tip_doc']);
		$tNum_doc = strlen($sUser['num_doc']);
		$tSexo = strlen($sUser['sexo']);
		$tDia = strlen($sUser['dia']);
		$tMes = strlen($sUser['mes']);
		$tAno = strlen($sUser['ano']);
		$tDirecc = strlen($sUser['direc']);
		$tTelefono = strlen($sUser['fono']);
		$tCelular = strlen($sUser['celular']);
		$tEcivil = strlen($sUser['est_civ']);
		
		$vjj = 0;
		$vch = '8';
		$vMes = $sUser['mes'];

		if($tRecorda < 5 )
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL RECORDATORIO DEBE DE TENER AL MENOS 5 CARACTERES.';
			return FALSE;
		}

		if($sUser['num_doc'] == '')
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL NUMERO DE DOCUMENTO NO DEBE ESTAR VACIO.';
			return FALSE;
		}
		if($sUser['tip_doc'] == '01')
		{
			if($tNum_doc != 8)
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL NÚMERO DEL DNI DEBED DE SER DE 8 NUMEROS.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tNum_doc; $vjj++)
			{
				$vch = $sUser['num_doc'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sUser['error'] = TRUE;
					$sUser['msnerror'] = 'ERROR, EL NÚMERO DE DOCUMENTO DEBE DE SER NUMÉRICO.';
					return FALSE;
				}
			}
		}		
		if($sUser['tip_doc'] == '02' && $tNum_doc != 10)
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL NUMERO DE LA LIBRETA MILITAR DEBE SER DE 10 NUMEROS.';
			return FALSE;
		}
		if($sUser['dia'] == '')
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO PUEDE ESTAR VACIO.';
			return FALSE;
		}
		for ($vjj = 0; $vjj < $tDia; $vjj++)
		{
			$vch = $sUser['dia'][$vjj];
			if ( !($vch >= "0" && $vch <= "9"))
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO DEBE SER NUMÉRICO.';
				return FALSE;
			}
		}

		if($sUser['ano'] == '')
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO NO PUEDE ESTAR VACIO.';
			return FALSE;
		}
		for ($vjj = 0; $vjj < $tAno; $vjj++)
		{
			$vch = $sUser['ano'][$vjj];
			if ( !($vch >= "0" && $vch <= "9"))
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO DEBE SER NUMÉRICO.';
				return FALSE;
			}
		}

		if (($vMes == "01" || $vMes == "03" || $vMes == "05" || $vMes == "07" || $vMes == "08" || $vMes == "10" || $vMes == "12" ) &&
			($sUser['dia'] > 31 || $sUser['dia'] < 1))
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
			return FALSE;
		}
		if (($vMes == "04" || $vMes == "06" || $vMes == "09" || $vMes == "11" ) &&
			($sUser['dia'] > 30 || $sUser['dia'] < 1))
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
			return FALSE;
		}
		if (($vMes == "02") && ($sUser['dia'] > 28 || $sUser['dia'] < 1) &&
			$sUser['ano'] % 4 != 0)
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
			return FALSE;
		}
		if (($vMes == "02") && ($sUser['dia'] > 29 || $sUser['dia'] < 1) &&
			$sUser['ano'] % 4 == 0)
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
			return FALSE;
		}
		if($sUser['direc'] == '')
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LA DIRECCIÓN NO PUEDE ESTAR VACIO.';
			return FALSE;
		}
		for ($vjj = 0; $vjj < $tTelefono; $vjj++)
		{
			$vch = $sUser['fono'][$vjj];
			if ( !($vch >= "0" && $vch <= "9"))
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL TELÉFONO DEBE SER NUMÉRICO.';
				return FALSE;
			}
		}

		for ($vjj = 0; $vjj < $tCelular; $vjj++)
		{
			$vch = $sUser['celular'][$vjj];
			if ( !($vch >= "0" && $vch <= "9"))
			{
				$sUser['error'] = TRUE;
				$sUser['msnerror'] = 'ERROR, EL CELULAR DEBE SER NUMÉRICO.';
				return FALSE;
			}
		}

/*		if($sUser['ciudad'] == '')
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LA CIUDAD NO PUEDE ESTAR VACIA.';
			return FALSE;
		}*/
		return TRUE;
	}
	function fverifyp()
	{
		global $sUser;
		$tPassold = strlen($sUser['passold']);
		$tPassnew = strlen($sUser['passnew']);
		if($tPassold < 5 )
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LA CONTRASEÑA ANTIGUA DEBE DE TENER AL MENOS 5 CARACTERES.';
			return FALSE;
		}
		if($tPassnew < 5 )
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LA CONTRASEÑA NUEVA DEBE DE TENER AL MENOS 5 CARACTERES.';
			return FALSE;
		}
		if($sUser['passnew'] != $sUser['passnew2'])
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LAS CONTRASEÑAS INGRESADAS NO COINCIDEN.';
			return FALSE;
		}
		return TRUE;
	}
	function fverifyp2()
	{
		global $sUser;
		$tPasswd = strlen($sUser['passwd']);
		if($tPasswd < 5 )
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LA CONTRASEÑA DEBE DE TENER AL MENOS 5 CARACTERES.';
			return FALSE;
		}
		if($sUser['passwd'] != $sUser['passwd2'])
		{
			$sUser['error'] = TRUE;
			$sUser['msnerror'] = 'ERROR, LAS CONTRASEÑAS INGRESADAS NO COINCIDEN.';
			return FALSE;
		}
		return TRUE;
	}
	
?>
