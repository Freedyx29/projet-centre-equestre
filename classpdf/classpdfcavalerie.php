<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.cavalerie.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21);
        $this->Cell(0, 20, utf8_decode('Liste des Cavaleries'), 0, 1, 'C');
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

        $this->Cell(30, 10, utf8_decode('N° SIRE'), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode('Nom'), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode('Date naissance'), 1, 0, 'C', true);
        $this->Cell(25, 10, utf8_decode('Garrot'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Race'), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode('Robe'), 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($numsire, $nomche, $datenache, $garrot, $race, $robe, $alternate) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255);
        $this->SetTextColor(60, 36, 21);

        $tableWidth = 190;
        $pageWidth = 210;
        $startX = ($pageWidth - $tableWidth) / 2;

        $this->SetX($startX);

        $this->Cell(30, 10, utf8_decode($numsire), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode($nomche), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode($datenache), 1, 0, 'C', true);
        $this->Cell(25, 10, utf8_decode($garrot), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode($race), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode($robe), 1, 0, 'C', true);
        $this->Ln();
    }
}

// Instanciation de la classe Cavalerie
$cavalerie = new Cavalerie();
$listeCavaleries = $cavalerie->CavalerieALL();

// Création de l'instance de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// En-tête du tableau
$pdf->TableHeader();

// Contenu du tableau
$alternate = false;
foreach ($listeCavaleries as $c) {
    if ($c['supprime'] != '1') {
        $race = $cavalerie->CavalerieRace($c['idrace']);
        $robe = $cavalerie->CavalerieRobe($c['idrobe']);
        $pdf->TableRow($c['numsire'], $c['nomche'], $c['datenache'], $c['garrot'], $race, $robe, $alternate);
        $alternate = !$alternate;
    }
}

// Sortie du PDF
$pdf->Output();
?>
