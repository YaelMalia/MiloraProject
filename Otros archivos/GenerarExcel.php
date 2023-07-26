<?php
require 'vendor/autoload.php';
require 'cn.php';

// https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/

use PhpOffice\PhpSpreadsheet\{SpreadSheet,IOFactory};
use PhpOffice\PhpSpreadsheet\Style\{Fill,Color,Border,Style,Font,Alignment};
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$Consulta="SELECT * FROM piezas";
$resultado= $mysqli->query($Consulta);

$excel= new Spreadsheet();

$excel->getProperties()-> setCreator("Dto SC Milora");

$excel->setActiveSheetIndex(0);

$hojaActiva= $excel->getActiveSheet();

$tableHeaderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
    'fill' => [
        'fillType' => Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90, // Ángulo de rotación del degradado (90 para vertical, 0 para horizontal)
        'startColor' => ['argb' => 'FF0000FF'], // Color de inicio (azul)
        'endColor' => ['argb' => 'FFFFFFFF'], // Color de fin (blanco)
    ],
    'font' => [
        'bold' => true,
        'size' => 12, // Tamaño de fuente
        'name' => 'Arial', // Familia de fuente (puedes cambiarlo a otra como 'Calibri', 'Times New Roman', etc.)
        'color' => ['argb' => '000000'], // Color de fuente (amarillo)
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_JUSTIFY, // Justificar horizontalmente el texto
        'vertical' => Alignment::VERTICAL_CENTER, // Centrar verticalmente el texto
        'wrapText' => true, // Ajustar automáticamente el contenido
    ],
];

$tableHeaderStyle2 = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
    'font' => [
        'bold' => true,
        'size' => 8, // Tamaño de fuente
        'name' => 'Arial', // Familia de fuente (puedes cambiarlo a otra como 'Calibri', 'Times New Roman', etc.)
        'color' => ['argb' => '000000'], // Color de fuente (Negro)
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_JUSTIFY, // Justificar horizontalmente el texto
        'vertical' => Alignment::VERTICAL_CENTER, // Centrar verticalmente el texto
        'wrapText' => true, // Ajustar automáticamente el contenido
    ],
];
/*
$hojaActiva->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID);
$hojaActiva->getStyle('A1')->getFill()->getStartColor()->setARGB(Color::COLOR_BLUE);
*/ 

$hojaActiva->getStyle('A1:C1')->applyFromArray($tableHeaderStyle);
$hojaActiva->setTitle("Reporte piezas");
$hojaActiva->getColumnDimension('A')->setWidth(30);
$hojaActiva->setCellValue('A1','No_diseños');
$hojaActiva->getColumnDimension('B')->setWidth(30);
$hojaActiva->setCellValue('B1','Descripcion');
$hojaActiva->getColumnDimension('C')->setWidth(30);
$hojaActiva->setCellValue('C1','Codigo MP');

$fila=2;
while($rows=$resultado->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila,$rows['No_diseno']);
    $hojaActiva->setCellValue('B'.$fila,$rows['Descripcion_MP']);
    $hojaActiva->setCellValue('C'.$fila,$rows['Codigo_MP']);
    $hojaActiva->getStyle('A'.$fila.':'.'C'.$fila)->applyFromArray($tableHeaderStyle2);
    $fila++;
}

header('Content-Type: application/vnd.openxlmformats-officedocument.spreadsheetlm.sheet');
header('Content-Disposition: attachment;filename="Reporte Milora Piezasb.xlsx"');
header('Cache-Control: max-age=0');

$writer=IOFactory::createWriter($excel,'Xlsx');
$writer->save('php://output');
exit;
echo 'lsfjkhdf';

//$writer=new Xlsx($excel);
//$writer->save('Kubo es la vrg pero con Xlsx');
?>