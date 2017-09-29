<?php
        function fConexDb ()
        {
                global $aConeDb;
                $aConeDb['Cnxn'] = mysql_connect( $aConeDb['Host'], $aConeDb['User'], $aConeDb['Pswd'] );

        }
        function fQueryDb ()
        {
                global $vQueryDb, $aConeDb;
                return mysql_query( $vQueryDb, $aConeDb['Cnxn'] );
        }
        function fCloseDb ()
        {
                global $aConeDb;
                mysql_close( $aConeDb['Cnxn'] );
        }
        function fComboDb ($pName, $pValue, $pDescri, $pIqual)
        {
                $vMostrar = "";
                $vMostrar = "<Select Name = '" .$pName. "'> \n";

                fConexDb();
                $cTable = fQueryDb();
                while ( $aTable = mysql_fetch_array( $cTable ) )
                {
                        $vMostrar .= "<Option Value = '" .$aTable[$pValue]. "' ";
                        if ( $pIqual == $aTable[$pValue] )
                                $vMostrar .= "Selected > ";
                        else
                                $vMostrar .= "> ";
                        $vMostrar .= $aTable[$pDescri]. " </Option> \n";
                }
                fCloseDb();

                $vMostrar .= "</Select> \n";
                echo $vMostrar;

        }
        function fDate ()
        {
                $vFecha = getdate(time());
                return $vFecha["year"]. "-" .$vFecha["mon"]. "-" .$vFecha["mday"];
        }
        function fDaTi ()
        {
                $vFecha = getdate(time());
                return $vFecha["year"]. "-" .$vFecha["mon"]. "-" .$vFecha["mday"]. " " .$vFecha["hours"]. ":" .$vFecha["minutes"]. ":" .$vFecha["seconds"];
        }
        function fViewDay ($pDay)
		{
			switch ($pDay)
			{
				case 0: return "Domingo";
				case 1: return "Lunes";         
				case 2: return "Martes";        
				case 3: return "Mi&eacute;rcoles";     
				case 4: return "Jueves";        
				case 5: return "Viernes";       
				case 6: return "Sábado";        
			}
		}
		function fViewMonth ($pMonth)
		{
			switch ($pMonth)
			{
				case 1: return "Enero";       
				case 2: return "Febrero";     
				case 3: return "Marzo";       
				case 4: return "Abril";       
				case 5: return "Mayo";        
				case 6: return "Junio";       
				case 7: return "Julio";       
				case 8: return "Agosto";      
				case 9: return "Septiembre";  
				case 10: return "Octubre";    
				case 11: return "Noviembre";  
				case 12: return "Diciembre";  
			}
		}
		function fViewDoc ($pDoc)
		{
			switch ($pDoc)
			{
				case '01': return "DNI";
				case '02': return "LM";
				case '03': return "BM";
				case '04': return "PART.";
				case '05': return "OTROS";
			}
		}
		function fViewEst ($pEstado)
		{
			switch ($pEstado)
			{
				case '01': return "Soltero(a)";
				case '02': return "Casado(a)";
				case '03': return "Viudo(a)";
				case '04': return "Separado(a)";
				case '05': return "Otros";
			}
		}
		function fViewPer ($pPeriodo)
		{
			switch ($pPeriodo)
			{
				case '00': return "Anual";
				case '01': return "Semestre I";				
				case '02': return "Semestre II";
				case '03': return "Vacacional";
			}
		}
		function fViewCon ($pVeces)
		{
			switch ($pVeces)			
			{
				case 1: 
				case 2: return "01";
				case 3: return "07";
				case 4: return "08";
				case 5: 
				case 6: return "11";
			}
		}
		function fViewNumero ($pNumero)
		{
			switch ($pNumero)
			{
				case 11: return "Once";
				case 12: return "Doce";	
				case 13: return "Trece";
				case 14: return "Catorce";
				case 15: return "Quince";
				case 16: return "Dieciseis";
				case 17: return "Diecisiete";
				case 18: return "Dieciocho";
				case 19: return "Diecinueve";
				case 20: return "Veinte";	
			}
		}
		function fViewModMat ($pModnot)
		{
			switch ($pModnot)
			{
				case '01': return "01";
			}
		}
		function fViewDate ()
        {
                $vFecha = getdate(time());
				$vFecha['weekday'] = fViewDay($vFecha['wday']);
				$vFecha['month'] = fViewMonth($vFecha['mon']);
                $vFecEn = $vFecha['weekday']. ", " .$vFecha['mday']. " de " .$vFecha['month']. " del " .$vFecha['year'];
                echo $vFecEn;
        }
        function fMenu($pMenu, $pTamano = 2, $pTarget = "conten")
        {
                if ($pTamano == 1) $vHeight = 15;
                else $vHeight = 20;

                $vMostrar = "
                <Table border='0' cellSpacing = '0' cellPadding = '0' bordercolor = '#04134D' Rules = 'rows, cols'>
                        <Tr bgcolor='#1E5E8E'>
                                <Td bgcolor = '#1E5E8E' style = 'CURSOR:hand' onmouseover = \"this.style.background = '#6996BD'\"
                                 onmouseout = \"this.style.background = '#1E5E8E'\" width = '100' height = '" .$vHeight. "'>
                                        <Center><A class ='tnormalwn' title = '" .$pMenu['Title']. "'
                                        href = '" .$pMenu['Href']. "' target = '" .$pTarget. "' > " .$pMenu['Item']. " </A> </Center>
                                </Td>
                        </Tr>
                </Table>
                ";
                echo $vMostrar;
        }

        function fMenuL($pMenuM, $pTamano = 2, $pTarget = "conten")
        {
                if ($pTamano == 1) $vHeight = 15;
                else $vHeight = 20;

                $vMostrar = "
                <Table border='0' cellSpacing = '0' cellPadding = '0' bordercolor = '#04134D' Rules = 'rows, cols'> ";

                if ($pMenuM != "")
                foreach($pMenuM as $vMenu)
                {
                        if ($vMenu['Target'] == "") $vMenu['Target'] = 'conten';
                        $vMostrar .= "
                        <Tr bgcolor='#1E5E8E'>
                                <Td bgcolor = '#1E5E8E' style = 'CURSOR:hand' onmouseover = \"this.style.background = '#6996BD'\"
                                 onmouseout = \"this.style.background = '#1E5E8E'\" width = '' height = '" .$vHeight. "'>
                                        <A class ='tnormalwn' title = '" .$vMenu['Title']. "'
                                        href = '" .$vMenu['Href']. "' onclick = \"" .$vMenu['OnClick']. "\" target = '" .$vMenu['Target']. "' > " .$vMenu['Item']. " </A>
                                </Td>
                        </Tr>";
                }

                $vMostrar .= "
                </Table> ";
                echo $vMostrar;
        }

        function fMenuM($pMenuM, $pTamano = 2, $pTarget = "conten")
        {
                if ($pTamano == 1) $vHeight = 15;
                else $vHeight = 20;

                $vMostrar = "
                <Table border='0' cellSpacing = '0' cellPadding = '0' bordercolor = '#04134D' Rules = 'rows, cols'> ";

                foreach($pMenuM as $vMenu)
                {
                        if ($vMenu['Target'] == "") $vMenu['Target'] = 'conten';
                        $vMostrar .= "
                        <Tr bgcolor='#1E5E8E'>
                                <Td bgcolor = '#1E5E8E' style = 'CURSOR:hand' onmouseover = \"this.style.background = '#6996BD'\"
                                 onmouseout = \"this.style.background = '#1E5E8E'\" width = '100' height = '" .$vHeight. "'>
                                        <Center><A class ='tnormalwn' title = '" .$vMenu['Title']. "'
                                        href = '" .$vMenu['Href']. "' onclick = \"" .$vMenu['OnClick']. "\" target = '" .$vMenu['Target']. "' > " .$vMenu['Item']. " </A> </Center>
                                </Td>
                        </Tr>";
                }

                $vMostrar .= "
                </Table> ";
                echo $vMostrar;
        }

        function fTMenu($pItem)
        {
                $vMostrar = "
                <Table border='0' cellSpacing = '0' cellPadding = '0' bordercolor = '#04134D' Rules = 'rows, cols'>
                        <Tr bgcolor='#04134D'>
                                <Td bgcolor = '#04134D' style = 'CURSOR:hand' onmouseover = \"this.style.background = '#6996BD'\"
                                 onmouseout = \"this.style.background = '#04134D'\" width = '100' height = '20'><Center>
                                        <Font class ='tlargewb' > " .$pItem. " </Center> </Font>
                                </Td>
                        </Tr>
                </Table>
                ";
                echo $vMostrar;
        }
		
		function fMenuHot($pMenuM)
	    {
			$vMostrar = "<table border ='0' cellPadding ='0' cellSpacing ='0' class ='tnormalbn' width ='' height ='16'><tr align ='center'>";
			$vCont = 0;

			if ($pMenuM != "")
			foreach($pMenuM as $vMenu)
			{
				if ($vCont > 0) 
					$vMostrar .= "<td>&nbsp; | &nbsp;</td>";
				if ($vMenu['Target'] == "") $vMenu['Target'] = 'conten';
				$vMostrar .= "
					<td class='obotoni' noWrap onmouseout =Moutb() width='' onmouseover =Moverb()>
						<img align ='absMiddle' alt =' ' border ='0' hspace ='1' src ='../images/edit.gif'>
						<A href ='" .$vMenu['Href']. "' onclick = \"" .$vMenu['OnClick']. "\" target = '" .$vMenu['Target']. "' 
						tabIndex ='0' title ='" .$vMenu['Title']. "'>" .$vMenu['Item']. "</A></td>";
			}

			$vMostrar .= "
			</Tr></Table> ";
			echo $vMostrar;
		}

        function fEMenu()
        {
                global $ar_UnapNet;
                $vMostrar = "
                        <Script language = 'JavaScript1.2'>";
                $vMostrar .= $ar_UnapNet['Menu'];
                $vMostrar .= "
                        </Script>

                        <script src='../script/exmplmenu_var_fprot.js'
                        type=text/javascript></script>

                        <script src='../script/emenu_com.js'
                        type=text/javascript></script>";
                echo $vMostrar;
        }
		
		function fTitle($pTitle, $pMenu = 0)
		{
			return "
			<Table cellpadding ='1' cellspacing ='0' border ='0' width ='650' style='margin-top:" .($pMenu ? '30':'5'). ";margin-left:5'>
				<Tr> <Td bgcolor ='#4791C5' class ='tlargewn' align ='left'>&nbsp; <b>Un@pNet&reg; :</b> $pTitle </Td> </Tr>
			</Table>
			";
		}
		
		function fTitle2($pTitle, $pMenu = 0)
		{
			return "
			<Table cellpadding ='1' cellspacing ='0' border ='0' width ='765' style='margin-top:" .($pMenu ? '30':'5'). ";margin-left:5'>
				<Tr> <Td bgcolor ='#4791C5' class ='tlargewn' align ='left'>&nbsp; <b>Un@pNet&reg; :</b> $pTitle </Td> </Tr>
			</Table>
			";
		}

        function fEncript($pPalabra)
        {
                global $vConexion;
                $vConsulta = "Select password('" .$pPalabra. "') as passwd";
                $cr_Passwd = mysql_query($vConsulta, $vConexion);
                $ar_Passwd = mysql_fetch_array($cr_Passwd);

                return $ar_Passwd['passwd'];
        }
		
		function Obtener($Archivo_)
		{
			$ArchivoC = "../images/" .$Archivo_;
			if (File_Exists($ArchivoC)):
				$file = FOpen($ArchivoC,rw);
				$Numero = FGets($file,6);
				$Numero = $Numero + 1;
				FClose($file);
			else:
				$Numero = 1;
			endif;
			$file= FOpen($ArchivoC,w);
			FputS ($file,$Numero);
			FClose($file);
			return $Numero;
		};
		function Contador($file)
		{
			$NumeroR = Obtener($file);
			$NumeroC = StrVal($NumeroR);
			$Canti = StrLen($NumeroC);
			for ($jj = 0; $jj < $Canti; $jj++)
			{
				$Caracter = SubStr($NumeroC, $jj, 1);
				$ArchivoN = "../images/c" .$Caracter. ".jpg";
				echo "<img src='" .$ArchivoN. "' border = 0 Width = 12>";
			};
		};
		function Obtener2($Archivo_)
		{
			$ArchivoC = "images/" .$Archivo_;
			if (File_Exists($ArchivoC)):
				$file = FOpen($ArchivoC,rw);
				$Numero = FGets($file,6);
				$Numero = $Numero + 1;
				FClose($file);
			else:
				$Numero = 1;
			endif;
			$file= FOpen($ArchivoC,w);
			FputS ($file,$Numero);
			FClose($file);
			return $Numero;
		};
		function Contador2($file)
		{
			$NumeroR = Obtener2($file);
			$NumeroC = StrVal($NumeroR);
			$Canti = StrLen($NumeroC);
			for ($jj = 0; $jj < $Canti; $jj++)
			{
				$Caracter = SubStr($NumeroC, $jj, 1);
				$ArchivoN = "images/c" .$Caracter. ".jpg";
				echo "<img src='" .$ArchivoN. "' border = 0 Width = 12>";
			};
		};

        function fScript ($pShift = 1, $pCtrl = 1, $pAlt = 1)
        {
                // Shift = 16, Ctrl = 17, Alt = 18
                $vMostrar = "
//---------------------------------------------------------------------------
//
//---------------------------------------------------------------------------
   var isnn,isie
   var message=\"JAFM-CTI-UNA-Puno.\\n©2003 Un@pNet\";

   if(navigator.appName=='Microsoft Internet Explorer') //check the browser
   {  isie=true }
   if(navigator.appName=='Netscape')
   {  isnn=true }

   if (window.Event)
   document.captureEvents(Event.MOUSEUP);

   function nocontextmenu()
   {
      event.cancelBubble = true
      event.returnValue = false;
      return false;
   }

   function norightclick(e)
   {
      if (window.Event)
      {
         if (e.which == 2 || e.which == 3)
            return false;
      }
      else
      if (event.button == 2 || event.button == 3)
      {
         alert(message)
         event.cancelBubble = true
         event.returnValue = false;
         return false;
      }
   }

   function key(k)
   {
      if(isie)
      {
         if( ";
                if ($pShift == 1) $vMostrar .= "event.keyCode==16 || ";
                if ($pCtrl == 1) $vMostrar .= "event.keyCode==17 || ";
                if ($pAlt == 1) $vMostrar .= "event.keyCode==18 || ";

                $vMostrar .= "event.keyCode==93 || (event.keyCode>=112 && event.keyCode<=123 && event.keyCode!=116))
         {
	    alert(message)
	    return false;
         }
      }
      /*if(isnn)
      {
         alert(\"Perdone, pero Ud. no tiene permiso para presionar esta tecla.\")
	 return false;
      } */
   }

   if (document.layers)
   {
      document.captureEvents(Event.MOUSEDOWN);
   }

   if (document.layers) window.captureEvents(Event.KEYPRESS);
   document.onkeydown=key;
   document.onmousedown = norightclick;
   document.onmouseup = norightclick;
//--------------------------------------------------------------------------
//
//--------------------------------------------------------------------------

";
                echo $vMostrar;
        }

?>
