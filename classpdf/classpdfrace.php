<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.race.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21);
        $this->Cell(0, 20, utf8_decode('Liste des Races'), 0, 1, 'C');
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
        $this->Cell(0, 10, utf8_decode('Vu le : ') . date('d/m/Y H:i:s') . ' | Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // En-tête du tableau
    function TableHeader() {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(60, 36, 21);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(60, 36, 21);

        // Calculer la position pour centrer le tableau
        $this->SetX((210 - 140) / 2);

        $this->Cell(40, 10, utf8_decode('ID Race'), 1, 0, 'C', true);
        $this->Cell(100, 10, utf8_decode('Libellé'), 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($idrace, $librace, $alternate) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255);
        $this->SetTextColor(60, 36, 21);

        $this->SetX((210 - 140) / 2);

        $this->Cell(40, 10, $idrace, 1, 0, 'C', true);
        $this->Cell(100, 10, utf8_decode($librace), 1, 0, 'C', true);
        $this->Ln();
    }
}

// Instanciation de la classe Race
$race = new Race();
$listeRaces = $race->RaceAll();

// Création de l'instance de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// En-tête du tableau
$pdf->TableHeader();

// Contenu du tableau
$alternate = false;
foreach ($listeRaces as $r) {
    if ($r['supprime'] != '1') {
        $pdf->TableRow($r['idrace'], $r['librace'], $alternate);
        $alternate = !$alternate;
    }
}

// Sortie du PDF
$pdf->Output();
?>
