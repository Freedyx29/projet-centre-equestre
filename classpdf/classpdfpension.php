<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.pension.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21);
        $this->Cell(0, 20, utf8_decode('Liste des Pensions'), 0, 1, 'C');
        $this->Ln(10);

        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94);
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(10);
    }

    // Pied de page
    function Footer() {
        $this->SetY(-30);

        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94);
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(5);

        // Affiche la date et le numéro de page
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, utf8_decode('Vu le : ') . date('d/m/Y H:i:s') . utf8_decode(' | Page ') . $this->PageNo(), 0, 0, 'C');
    }

    // En-tête du tableau
    function TableHeader() {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(60, 36, 21);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(60, 36, 21);

        $tableWidth = 190;
        $pageWidth = 210;
        $startX = ($pageWidth - $tableWidth) / 2;

        $this->SetX($startX);

        $this->Cell(40, 10, utf8_decode('Libellé'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Date début'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Date fin'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Tarif'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Cheval'), 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($libpen, $dateD, $dateF, $tarif, $cheval, $alternate) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255);
        $this->SetTextColor(60, 36, 21);

        $tableWidth = 190;
        $pageWidth = 210;
        $startX = ($pageWidth - $tableWidth) / 2;

        // Formatage du tarif avec 2 décimales et symbole €
        $tarifFormate = number_format($tarif, 2, ',', ' ') . chr(128);

        $this->SetX($startX);

        $this->Cell(40, 10, utf8_decode($libpen), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode($dateD), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode($dateF), 1, 0, 'C', true);
        $this->Cell(30, 10, $tarifFormate, 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode($cheval), 1, 0, 'C', true);
        $this->Ln();
    }
}

// Instanciation de la classe Pension
$pension = new Pension();
$listePensions = $pension->PensionAll();

// Création de l'instance de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// En-tête du tableau
$pdf->TableHeader();

// Contenu du tableau
$alternate = false;
foreach ($listePensions as $p) {
    if ($p['supprime'] != '1') {
        $cheval = $pension->PensionNumsire($p['numsire']);
        $pdf->TableRow($p['libpen'], $p['dateD'], $p['dateF'], $p['tarif'], $cheval, $alternate);
        $alternate = !$alternate;
    }
}

// Sortie du PDF
$pdf->Output();
?>
