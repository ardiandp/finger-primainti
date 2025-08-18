<?php
/*$pdf=new FPDF();
$pdf->addPage();
$pdf-Image('../upload/sertifikat.jpg',10,10);
$pdf->output(); */
?>


<?php
require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>