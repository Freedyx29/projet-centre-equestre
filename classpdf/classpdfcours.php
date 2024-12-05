<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.cours.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21);
        $this->Cell(0, 20, utf8_decode('Liste des Cours'), 0, 1, 'C');
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

        // Calculer la position pour centrer le tableau
        $this->SetX((210 - 180) / 2);

        $this->Cell(40, 10, utf8_decode('ID Cours'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Libellé'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Heure début'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Heure fin'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Jour'), 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($idcours, $libcours, $hdebut, $hfin, $jour, $alternate) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255);
        $this->SetTextColor(60, 36, 21);

        $this->SetX((210 - 180) / 2);

        $this->Cell(40, 10, utf8_decode($idcours), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode($libcours), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode($hdebut), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode($hfin), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode($jour), 1, 0, 'C', true);
        $this->Ln();
    }
}

// Instanciation de la classe Cours
$cours = new Cours();
$listeCours = $cours->CoursAll();

// Création de l'instance de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// En-tête du tableau
$pdf->TableHeader();

// Contenu du tableau
$alternate = false;
foreach ($listeCours as $c) {
    if ($c['supprime'] != '1') {
        $pdf->TableRow($c['idcours'], $c['libcours'], $c['hdebut'], $c['hfin'], $c['jour'], $alternate);
        $alternate = !$alternate;
    }
}

// Sortie du PDF
$pdf->Output();
?>
