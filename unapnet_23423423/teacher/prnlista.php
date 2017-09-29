<?php

	session_start();
	include "../../include/function.php";
	include "../../include/funcunap.php";
	require "../../include/fpdf.php";

	if(!fverifyds2())
		header("Location:../.");

	class PDF extends FPDF
	{
		function Header()
		{
			$this->Ln(8);
			
			$this->SetFont('Times','B',14);
			$this->Cell(0,5,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('Arial','B',12);
			$this->Cell(0,5,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('arialn','B',12);
			$this->Cell(0,5,'UN@P.NET2 TEACHER', 0, 0, 'C');
			$this->Ln();
			
			$this->Ln(4);
			$this->Subhnota();
			$this->Subhnota2();
			
		}
		function Subhnota()
		{
			global $sUser, $sCarrera, $sFacultad, $sPeriodoa;
			$this->SetFont('arial','B',9);
			$this->Cell(5);
			$this->Cell(130,5,"FACULTAD: {$sFacultad[$sUser['cod_car_cur']]}", 0);
			$this->Cell(50,5,"ESTUDIANTES [{$sUser['ano_aca']}-{$sPeriodoa[$sUser['per_aca']]}]", 0, 0, 0,'R');
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,5, "CARRERA PROFESIONAL: {$sCarrera[$sUser['cod_car_cur']]}, {$sUser['cod_esp']}", 0);
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,5, "CURSO: {$sUser['nom_cur']}", 0);
			$this->Ln();
			
			$vNombre = strtoupper("{$sUser['paterno']} {$sUser['materno']}, {$sUser['nombres']}");
			$this->Cell(5);
			$this->Cell(180,5, "DOCENTE: $vNombre", 0);
			$this->Ln();
		
			$this->Cell(5);
			$this->Cell(180,5, "NIVEL: {$sUser['niv_est']}    SEMESTRE: {$sUser['sem_anu']}    CREDITOS: {$sUser['crd_cur']}", 0);
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,5, "GRUPO(S): UNICO    CONDICIÓN(ES): TODOS", 0);
			$this->Ln();
			
			$this->Ln(1);
		}
		
		function Subhnota2()
		{
			$this->SetFont('arialn','B',7);
//			$this->Line(20, 52, 190, 52);
						
			$this->Cell(5);
			$this->Cell(7,5,'N°', 1, 0, 'C');
			$this->Cell(13,5,'CÓDIGO', 1, 0, 'C');
			$this->Cell(75,5,'APELLIDOS Y NOMBRES', 1, 0, 'C');
			$this->Cell(25,5,'MOD', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Cell(10,5,'', 1, 0, 'C');
			$this->Ln();
			$this->Ln(1);
		}
		
		function Footer()
		{
			global $sUser, $sMes;
			$vFecha = getdate(time());
			$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
			$this->SetFont('arialn','',10);
			$this->Line(15, 277, 195, 277);
			$this->SetY(-20);			
			$this->Cell(5);
			$this->Cell(130, 4,"Fecha: $vFechan - IP: {$sUser['ip']}", 0);
			$this->Cell(50, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
		}
		function Body()
		{			
			global $sEstupdf;
			$this->SetFont('arialn','',10);
			if(!empty($sEstupdf))
			foreach($sEstupdf as $sEstu)
			{
				$this->Cell(5);
				$this->Cell(7,5, $sEstu['num_est'], 0, 0, 'C');
				$this->Cell(13,5, $sEstu['num_mat'], 0, 0, 'C');
				$this->Cell(75,5, $sEstu['nombre'], 0, 0, 'L');
				$this->Cell(25,5, $sEstu['mod_mat'], 0, 0, 'L');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Cell(10,5,'', 1, 0, 'C');
				$this->Ln();
				//$this->Ln(10);
			}
			$this->Cell(5);
			$this->Cell(90,1, '________________________________________________________', 0, 0, 'L');
			$this->Cell(90,1, '________________________________________________________', 0, 0, 'L');
			$this->Ln();
			
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