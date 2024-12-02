<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.pension.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 20); // Chemin, x, y, largeur
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21); // Couleur du texte : #3C2415
        $this->Cell(0, 20, 'Liste des Pensions', 0, 1, 'C');
        $this->Ln(10); // Espacement après l'en-tête

        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(10);
    }

    // Pied de page
    function Footer() {
        $this->SetY(-30);

        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(5); // Espacement après la ligne

        // Affiche la date et le numéro de page
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, 'Vu le : ' . date('Y-m-d H:i:s') . ' | Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // En-tête du tableau
    function TableHeader() {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(60, 36, 21); // Couleur de fond : #3C2415
        $this->SetTextColor(255, 255, 255); // Couleur du texte : blanc
        $this->SetDrawColor(60, 36, 21); // Couleur des bordures : #3C2415

        // Calculer la position pour centrer le tableau
        $tableWidth = 190; // Largeur totale des cellules
        $pageWidth = 210; // Largeur de la page
        $startX = ($pageWidth - $tableWidth) / 2;

        $this->SetX($startX);

        $this->Cell(40, 10, 'Libelle', 1, 0, 'C', true); // Fond activé avec `true`
        $this->Cell(40, 10, 'Date Debut', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Date Fin', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Tarif', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Cheval', 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($libpen, $dateD, $dateF, $tarif, $cheval, $alternate) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255); // Nuances de beige
        $this->SetTextColor(60, 36, 21); // Couleur du texte : #3C2415

        // Calculer la position pour centrer le tableau
        $tableWidth = 190; // Largeur totale des cellules
        $pageWidth = 210; // Largeur de la page
        $startX = ($pageWidth - $tableWidth) / 2;

        $this->SetX($startX);

        $this->Cell(40, 10, $libpen, 1, 0, 'C', true); // Utilisation du fond
        $this->Cell(40, 10, $dateD, 1, 0, 'C', true);
        $this->Cell(40, 10, $dateF, 1, 0, 'C', true);
        $this->Cell(30, 10, $tarif, 1, 0, 'C', true);
        $this->Cell(40, 10, $cheval, 1, 0, 'C', true);
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
$alternate = false; // Pour les couleurs alternées des lignes
foreach ($listePensions as $p) {
    if ($p['supprime'] != '1') {
        $cheval = $pension->PensionNumsire($p['numsire']);
        $pdf->TableRow($p['libpen'], $p['dateD'], $p['dateF'], $p['tarif'], $cheval, $alternate);
        $alternate = !$alternate; // Alterne entre deux fonds
    }
}

// Sortie du PDF
$pdf->Output();
?>
