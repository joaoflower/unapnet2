<?php	
	function finito()
	{
		global $sOlvuser;
		$sOlvuser['safety'] = '*25740E18E08CC91F492F1B38E5413E1B85E32A01';
		$sOlvuser['init'] = '1';
	}
	
	function fverifyp()
	{
		global $sOlvuser;
		if ($sOlvuser['safety'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sOlvuser['init'] == '1')
		{
			$vjj = 0;
			$vch = '8';
			$vTamcod = strlen($sOlvuser['codigop']);
			$vTampas = strlen($sOlvuser['passwdp']);
			//--------------------------------------------------
			for ($vjj = 0; $vjj < $vTamcod ; $vjj++)
			{
				$vch = substr($sOlvuser['codigop'], $vjj, 1);
				if ( !($vch >= '0' && $vch <= '9'))
				{
					$sOlvuser['errorp'] = TRUE;
					$sOlvuser['msnerror'] = 'ERROR, EL C&Oacute;DIGO DEBE SER N&Uacute;MERICO';
					return FALSE;
				}			
			}
			if($vTamcod < 4 )
			{
				$sOlvuser['errorp'] = TRUE;
				$sOlvuser['msnerror'] = "ERROR, EL C&Oacute;DIGO DEBE DE TENER AL MENOS 4 CARACTERES $vTamcod".$sOlvuser['codigo'];
				return FALSE;
			}
			//--------------------------------------------------
			if($vTampas < 5 )
			{
				$sOlvuser['errorp'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, LA CONTRASEÑA DEBE TENER AL MENOS 5 CARACTERES';
				return FALSE;
			}
			//--------------------------------------------------
			return TRUE;
		}
		else
		{			
			$sOlvuser['errorp'] = TRUE;
			$sOlvuser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAN REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}		
	}
	function fverifyd()
	{
		global $sOlvuser;
		if ($sOlvuser['safety'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sOlvuser['init'] == '1')
		{
			$vjj = 0;
			$vch = '8';
			$tLogin = strlen($sOlvuser['login']);
			$vTampas = strlen($sOlvuser['passwdd']);
			$tDia = strlen($sOlvuser['dia']);
			$tMes = strlen($sOlvuser['mes']);
			$tAno = strlen($sOlvuser['ano']);

			//--------------------------------------------------
			if($tLogin < 5 )
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO DEBE DE TENER AL MENOS 5 CARACTERES.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					if ( $sOlvuser['login'][$vjj] == ' ')
					{
						$sOlvuser['errord'] = TRUE;
						$sOlvuser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO NO DEBE DE TENER ESPACIOS EN BLANCO.';
						return FALSE;
					}
			}
			$vch = $sOlvuser['login'][0];
			if (!($vch >= 'a' && $vch <= 'z'))
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL PRIMER CARACTER DEL NOMBRE DE USUARIO DEBE SER UN CARACTER EN MINUSCULA.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tLogin; $vjj++)
			{
					$vch = $sOlvuser['login'][$vjj];
					if ( !(($vch >= "a" && $vch <= "z") || ($vch == "_") || ($vch == "-") || ($vch >= "0" && $vch <= "9")) )
					{
						$sOlvuser['errord'] = TRUE;
						$sOlvuser['msnerror'] = 'ERROR, EL NOMBRE DE USUARIO EXISTEN CARACTERES QUE NO SON VALIDO O ESTAN EN MAYUSCULA.';
						return FALSE;
					}
			}
			//--------------------------------------------------
			if($vTampas < 5 )
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, LA CONTRASEÑA DEBE TENER AL MENOS 5 CARACTERES';
				return FALSE;
			}
			if($sOlvuser['dia'] == '')
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO PUEDE ESTAR VACIO.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tDia; $vjj++)
			{
				$vch = $sOlvuser['dia'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sOlvuser['errord'] = TRUE;
					$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}
	
			if($sOlvuser['ano'] == '')
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO NO PUEDE ESTAR VACIO.';
				return FALSE;
			}
			for ($vjj = 0; $vjj < $tAno; $vjj++)
			{
				$vch = $sOlvuser['ano'][$vjj];
				if ( !($vch >= "0" && $vch <= "9"))
				{
					$sOlvuser['errord'] = TRUE;
					$sOlvuser['msnerror'] = 'ERROR, EL AÑO DE NACIMIENTO DEBE SER NUMÉRICO.';
					return FALSE;
				}
			}
	
			if (($vMes == "01" || $vMes == "03" || $vMes == "05" || $vMes == "07" || $vMes == "08" || $vMes == "10" || $vMes == "12" ) &&
				($sOlvuser['dia'] > 31 || $sOlvuser['dia'] < 1))
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "04" || $vMes == "06" || $vMes == "09" || $vMes == "11" ) &&
				($sOlvuser['dia'] > 30 || $sOlvuser['dia'] < 1))
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "02") && ($sOlvuser['dia'] > 28 || $sOlvuser['dia'] < 1) &&
				$sOlvuser['ano'] % 4 != 0)
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			if (($vMes == "02") && ($sOlvuser['dia'] > 29 || $sOlvuser['dia'] < 1) &&
				$sOlvuser['ano'] % 4 == 0)
			{
				$sOlvuser['errord'] = TRUE;
				$sOlvuser['msnerror'] = 'ERROR, EL DÍA DE NACIMIENTO NO ES VALIDO.';
				return FALSE;
			}
			//--------------------------------------------------
			return TRUE;
		}
		else
		{			
			$sOlvuser['errord'] = TRUE;
			$sOlvuser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAN REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}		
	}
	function fverifyv()
	{
		global $sOlvuser;
		if ($sOlvuser['safetyv'] == '*25740E18E08CC91F492F1B38E5413E1B85E32A01' and $sOlvuser['init'] == '1')
		{
			return TRUE;
		}
		else
		{			
			$sOlvuser['errord'] = TRUE;
			$sOlvuser['msnerror'] = 'ERROR, USTED ESTA TRATANDO DE INGRESAR BRUSCAMENTE A ESTA P&Aacute;GINA, SE HAN REGISTRADO TODOS LOS DATOS DE SU M&Aacute;QUINA';
			return FALSE;
		}		
	}

?>
