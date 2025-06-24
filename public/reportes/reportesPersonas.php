<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../src/libs/fpdf.php';
require_once __DIR__ . '/../../src/models/Persona.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();

$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Reporte de Personas'), 0, 1, 'C');
$pdf->Ln(5);

// Encabezados
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(52, 73, 94);
$pdf->SetTextColor(255); // Blanco

$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(35, 10, utf8_decode('Nombre'), 1, 0, 'C', true);
$pdf->Cell(35, 10, utf8_decode('Apellido'), 1, 0, 'C', true);
$pdf->Cell(35, 10, utf8_decode('Teléfono'), 1, 0, 'C', true);
$pdf->Cell(75, 10, utf8_decode('Email'), 1, 1, 'C', true);
// Datos
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0); // Negro

foreach ($personas as $p) {
    $pdf->Cell(10, 10, $p['id'], 1);
    $pdf->Cell(35, 10, utf8_decode($p['nombre']), 1);
    $pdf->Cell(35, 10, utf8_decode($p['apellido']), 1);
    $pdf->Cell(35, 10, utf8_decode($p['telefono']), 1);
    $pdf->Cell(75, 10, utf8_decode($p['email']), 1);
    $pdf->Ln();
}

$pdf->Output();
