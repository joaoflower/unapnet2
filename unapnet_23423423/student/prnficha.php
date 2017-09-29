<?php

	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	require "../../include/fpdf.php";

	if(!fverifyss2())
		header("Location:../.");

	class PDF extends FPDF
	{
		function Header()
		{
			//$this->Ln(8);
			
			$this->SetFont('Arial','B',10);
			$this->Cell(0,4,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
			$this->Ln();
			$this->Cell(0,4,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('arialn','B',10);
			$this->Cell(0,4,'UN@P.NET2 STUDENT', 0, 0, 'C');
			$this->Ln();
			
			$this->Ln(4);
			$this->Subhficha();
			$this->Subhficha2();
			
		}
		function Subhficha()
		{
			global $sUser, $sCarrera, $sFacultad;
			$this->SetFont('arial','B',7);
			$this->Cell(140,3,"FACULTAD: {$sFacultad[$sUser['cod_car']]}", 0);
			$this->SetFont('arial','B',12);
			$this->Cell(50,3,'FICHA DE MATRÍCULA', 0, 0, 0,'R');			
			$this->Ln();
			
			$this->SetFont('arial','B',7);
			$this->Cell(140,3, "CARRERA PROFESIONAL: {$sCarrera[$sUser['cod_car']]}", 0);			
			$this->Ln();
			
			$vNombre = strtoupper("{$sUser['paterno']} {$sUser['materno']}, {$sUser['nombres']}");
			$this->SetFont('arial','B',7);
			$this->Cell(140,3, "APELLIDOS Y NOMBRES: $vNombre", 0);
			$this->SetFont('arial','B',12);
			$this->Cell(50,3, "N° de Matrícula: {$sUser['codigo']}", 0, 0, 0,'R');
			$this->Ln();
			
			$this->SetFont('arial','B',7);
			$this->Cell(140,3, "PERIODO ACADÉMICO: 2004-SEGUNDO    SISTEMA CURRICULAR: FLEXIBLE    CONDICIÓN:  ", 0);
			$this->Ln();
						
			$this->SetFont('arial','B',7);
			$this->Cell(140,3, "NIVEL/CICLO DE ESTUDIOS:     GRUPO: UNICO    TURNO: MAÑANA", 0);
			$this->Ln();
			
			$this->Ln(1);
		}
		
		function Subhficha2()
		{
			$this->SetFont('arialn','B',7);
//			$this->Line(20, 52, 190, 52);
						
			$this->Cell(6,5,'N°', 1, 0, 'C');
			$this->Cell(8,5,'NIV', 1, 0, 'C');
			$this->Cell(15,5,'SEM', 1, 0, 'C');
			$this->Cell(60,5,'CURSO', 1, 0, 'C');
			$this->Cell(15,5,'GRUPO', 1, 0, 'C');
			$this->Cell(16,5,'MOD', 1, 0, 'C');
			$this->Cell(15,5,'TURNO', 1, 0, 'C');
			$this->Cell(10,5,'CRED', 1, 0, 'C');
			$this->Ln();
			//$this->Ln(1);
		}
		
		function Footer()
		{
			global $sUser, $sMes;
			$vFecha = getdate(time());
			$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
			$this->SetFont('arialn','',10);
			//$this->Line(20, 277, 190, 277);
			$this->SetY(-166);			
			$this->Cell(140, 4,"Fecha: $vFechan - IP: {$sUser['ip']}", 0);
			$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
		}
		function Body()
		{			
			global $sCursopdf;
			$this->SetFont('arialn','',8);
			$vSum_crd = 0;
			if(!empty($sCursopdf))
			foreach($sCursopdf as $sCurso)
			{
				$this->Cell(6,4, $sCurso['num_cur'], 'L', 0, 'C');
				$this->Cell(8,4, $sCurso['niv_est'], 0, 0, 'L');
				$this->Cell(15,4, $sCurso['sem_anu'], 0, 0, 'L');
				$this->Cell(60,4, $sCurso['nom_cur'], 0, 0, 'L');
				$this->Cell(15,4, $sCurso['sec_gru'], 0, 0, 'L');
				$this->Cell(16,4, $sCurso['mod_mat'], 0, 0, 'L');
				$this->Cell(15,4, $sCurso['tur_est'], 0, 0, 'L');
				$this->Cell(10,4, $sCurso['crd_cur'], 'R', 0, 'C');
				$this->Ln();
				$vSum_crd += $sCurso['crd_cur'];
			}
			$this->Cell(95,1, '___________________________________________________________________________', 0, 0, 'L');
			$this->Cell(95,1, '_____________________________________', 0, 0, 'L');
			$this->Ln(2);
			$this->Cell(142,4, "Total de Créditos: $vSum_crd", 0, 0, 'R');
			$this->Ln();
			
			$this->Rect(10, 42, 190, 93);
			
			$this->Rect(10, 42, 145, 58);
			$this->Rect(155, 42, 45, 58);
			
			$this->Rect(30, 102, 70, 26);
			$this->Line(35, 122, 95, 122);
			$this->Text(57, 125, "ESTUDIANTE");

			$this->Rect(110, 102, 70, 26);
			$this->Line(115, 122, 175, 122);
			$this->Text(128, 125, "COORDINADOR ACADÉMICO");
			
			$this->Rect(10, 130, 190, 5);
			
			
//			$this->Line(20, 58, 190, 58);		
		}
	}

	$pdf=new PDF('P', 'mm', 'A4');
	$pdf->AliasNbPages();
	$pdf->AddFont('arialn','','arialn.php');
	$pdf->AddFont('arialn','B','arialnb.php');
	$pdf->AddPage();
	$pdf->Body();
	
	$pdf->Output();
?> 