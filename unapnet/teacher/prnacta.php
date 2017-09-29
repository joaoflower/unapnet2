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
	
			$this->SetFont('Times','B',14);
			$this->Cell(0,5,'UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('Arial','B',10);
			$this->Cell(0,4,'OFICINA DE TECNOLOGÍA INFORMÁTICA', 0, 0, 'C');
			$this->Ln();
			$this->SetFont('arialn','B',10);
			$this->Cell(0,4,'UN@P.NET2 TEACHER', 0, 0, 'C');
			$this->Ln();
			
			$this->Ln(4);
			$this->Subhnota();
			$this->Subhnota2();
			
		}
		function Subhnota()
		{
			global $sUser, $sCarrera, $sFacultad;
			$this->SetFont('arial','B',9);

			$this->Cell(5);
			$this->Cell(130,4,"REGISTRO DE EVALUACIONES: REGULAR", 0);
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(130,4,"FACULTAD: {$sFacultad[$sUser['cod_car']]}", 0);			
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,4, "CARRERA PROFESIONAL: {$sCarrera[$sUser['cod_car']]}, {$sUser['cod_esp']}", 0);
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,4, "CURSO: {$sUser['nom_cur']}", 0);
			$this->Ln();
			
			$vNombre = strtoupper("{$sUser['paterno']} {$sUser['materno']}, {$sUser['nombres']}");
			$this->Cell(5);
			$this->Cell(180,4, "DOCENTE: $vNombre", 0);
			$this->Ln();			

			$this->Cell(5);
			$this->Cell(180,4, "CREDITOS: {$sUser['crd_cur']}", 0);
			$this->Ln();
			
			$this->Cell(5);
			$this->Cell(180,4, "AÑO ACADEMICO: [2004-II]    SEMESTRE: {$sUser['sem_anu']}    GRUPO: UNICO ", 0);
			$this->Ln();
			
			$this->Ln(1);
		}
		
		function Subhnota2()
		{
			$this->SetFont('arialn','B',6);
						
			$this->Cell(5);
			$this->Cell(7,5,'N°', 'RLT', 0, 'C');			
			
			$this->SetFont('arialn','B',9);
			$this->Cell(78,5,'', 'RLT', 0, 'C');
			$this->Cell(56,5,'CAPACIDADES', 1, 0, 'C');
			$this->Cell(35,5,'ACTITUDES', 1, 0, 'C');			

			$this->SetFont('arialn','B',6);
			$this->Cell(9,5,'PROM', 'RLT', 0, 'C');
			$this->Ln();
			
			$this->SetFont('arialn','B',6);
			
			$this->Cell(5);
			$this->Cell(7,5,'ORDEN', 'RLB', 0, 'C');			

			$this->SetFont('arialn','B',9);
			$this->Cell(78,5,'', 'RLB', 0, 'C');
			$this->Cell(8,5,'1°', 1, 0, 'C');
			$this->Cell(8,5,'2°', 1, 0, 'C');
			$this->Cell(8,5,'3°', 1, 0, 'C');
			$this->Cell(8,5,'4°', 1, 0, 'C');
			$this->Cell(8,5,'5°', 1, 0, 'C');
			$this->Cell(8,5,'6°', 1, 0, 'C');
			$this->Cell(8,5,'PC', 1, 0, 'C');
			$this->Cell(7,5,'1°', 1, 0, 'C');
			$this->Cell(7,5,'2°', 1, 0, 'C');
			$this->Cell(7,5,'3°', 1, 0, 'C');
			$this->Cell(7,5,'4°', 1, 0, 'C');
			$this->Cell(7,5,'PA', 1, 0, 'C');
			
			$this->SetFont('arialn','B',6);
			$this->Cell(9,5,'FINAL', 'RLB', 0, 'C');
			
			$this->SetFont('arialn','B',9);
			$this->Text(35, 62, "A P E L L I D O S   Y   N O M B R E S");
			
			$this->Ln();
		}
		
		function Footer()
		{
			global $sUser, $sMes;
			$vFecha = getdate(time());
			$vFechan = "{$vFecha['mday']} de {$sMes[$vFecha['mon']]} del {$vFecha['year']} - Hora: {$vFecha['hours']}:{$vFecha['minutes']}:{$vFecha['seconds']} hrs.";
			$this->SetFont('arialn','',10);
			$this->Line(15, 245, 200, 245);
			$this->Line(15, 280, 200, 280);
			$this->SetY(-22);			
			
			$this->Rect(15, 246, 47, 27);
			$this->Rect(62, 246, 46, 27);
			$this->Rect(108, 246, 46, 27);
			$this->Rect(154, 246, 46, 27);
			
			//$this->Cell(185, 4, 'FIRMA', 1);
						
			$this->Cell(5);
			$this->Cell(185, 4, "Puno, C.U ................ de ......................................... del 20 ...........", 0, 0,'C');
			$this->Ln();
			$this->Ln(2);
			
			$this->Cell(5);
			$this->Cell(130, 4,"Fecha: $vFechan - IP: {$sUser['ip']}", 0);
			$this->Cell(60, 4,'Pag: '.$this->PageNo().' / {nb}',0,0,'R');
		}
		function Body()
		{			
			global $sActapdf;
			$vCont = 1;
			if(!empty($sActapdf))
			foreach($sActapdf as $sEstu)
			{
				$this->SetFont('arialn','',9);
				$this->Cell(5);
				$this->Cell(7,7, $sEstu['num_est'], 1, 0, 'C');			
				$this->Cell(78,7, $sEstu['num_mat']."  ".$sEstu['nombre'], 1, 0, 'L');						
				$this->SetFont('arialn','',14);
				$this->Cell(8,7, $sEstu['c1'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['c2'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['c3'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['c4'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['c5'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['c6'], 1, 0, 'C');
				$this->Cell(8,7, $sEstu['pc'], 1, 0, 'C');
				$this->Cell(7,7, $sEstu['a1'], 1, 0, 'C');
				$this->Cell(7,7, $sEstu['a2'], 1, 0, 'C');
				$this->Cell(7,7, $sEstu['a3'], 1, 0, 'C');
				$this->Cell(7,7, $sEstu['a4'], 1, 0, 'C');
				$this->Cell(7,7, $sEstu['pa'], 1, 0, 'C');
				$this->Cell(9,7, $sEstu['pf'], 1, 0, 'C');
				$this->Ln();
				//$this->Ln(10);
				if ($vCont % 25 == 0)
					$this->AddPage();
				$vCont++;
			}
			
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