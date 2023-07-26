<?php
require('FPDF/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'MILORITA',1,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(50,10,'No_diseno',1,0,'C',0);
    $this->Cell(60,10,'Descripcion_MP',1,0,'C',0);
    $this->Cell(60,10,'Codigo_MP',1,1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require('cn.php');
$Consulta="SELECT * FROM piezas";
$resultado= $mysqli->query($Consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while($row=$resultado->fetch_assoc()){
    $pdf->Cell(50,10,$row['No_diseno'],1,0,'C',0);
    $pdf->Cell(60,10,$row['Descripcion_MP'],1,0,'C',0);
    $pdf->Cell(60,10,$row['Codigo_MP'],1,1,'C',0);
}

$pdf->Output();
?>