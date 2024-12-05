<?php
require('../fpdf186/fpdf.php');
include_once '../class/class.cavaliers.php';

class PDF extends FPDF {
    // En-tête
    function Header() {
        // Ajout du logo
        $this->Image('../photos/equip.png', 10, 10, 30); // Chemin, x, y, largeur
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(60, 36, 21); // Couleur du texte : #3C2415
        $this->Cell(0, 20, utf8_decode('Liste des Cavaliers'), 0, 1, 'C');
        $this->Ln(10); // Espacement après l'en-tête
        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 287, $this->GetY()); // Ajusté pour le paysage
        $this->Ln(10);
    }

    // Pied de page
    function Footer() {
        $this->SetY(-30); // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 287, $this->GetY()); // Ajusté pour le paysage
        $this->Ln(5); // Espacement après la ligne
        // Affiche la date et le numéro de page
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, utf8_decode('Vu le : ') . date('d/m/Y H:i:s') . utf8_decode(' | Page ') . $this->PageNo(), 0, 0, 'C');
    }

    // En-tête du tableau
     function TableHeader() {
        $this->SetFont('Arial', 'B', 8);
        $this->SetFillColor(60, 36, 21);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(60, 36, 21);
        $tableWidth = 270;
        $pageWidth = 297;
        $startX = ($pageWidth - $tableWidth) / 2; // Centrer le tableau
        $this->SetX($startX);
        
        // Ajustement des largeurs
        $this->Cell(20, 10, utf8_decode('Nom Cav.'), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode('Prénom Cav.'), 1, 0, 'C', true);
        $this->Cell(18, 10, utf8_decode('Date Naiss.'), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode('Num Lic.'), 1, 0, 'C', true);
        $this->Cell(12, 10, utf8_decode('Galop'), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode('Nom Resp.'), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode('Prénom Resp.'), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode('Rue'), 1, 0, 'C', true);
        $this->Cell(45, 10, utf8_decode('Ville Resp.'), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode('CP'), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode('Tél'), 1, 0, 'C', true);
        $this->Cell(38, 10, utf8_decode('Email Resp.'), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode('Ass.'), 1, 0, 'C', true);
        $this->Ln();
    }

    function TableRow($nomcava, $prenomcava, $datenacava, $numlic, $galop, $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp, $emailresp, $assurance, $alternate) {
        $this->SetFont('Arial', '', 8);
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255);
        $this->SetTextColor(60, 36, 21);
        
        $tableWidth = 270;
        $pageWidth = 297;
        $startX = ($pageWidth - $tableWidth) / 2; // Centrer le tableau
        $this->SetX($startX);

        $datenacava = date('d/m/Y', strtotime($datenacava));

        // Mêmes largeurs que dans TableHeader
        $this->Cell(20, 10, utf8_decode($nomcava), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode($prenomcava), 1, 0, 'C', true);
        $this->Cell(18, 10, utf8_decode($datenacava), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode($numlic), 1, 0, 'C', true);
        $this->Cell(12, 10, utf8_decode($galop), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode($nomresp), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode($prenomresp), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode($rueresp), 1, 0, 'C', true);
        $this->Cell(45, 10, utf8_decode($vilresp), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode($cpresp), 1, 0, 'C', true);
        $this->Cell(20, 10, utf8_decode($telresp), 1, 0, 'C', true);
        $this->Cell(38, 10, utf8_decode($emailresp), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode($assurance), 1, 0, 'C', true);
        $this->Ln();
    }
}

// Instanciation de la classe Cavaliers
$cavaliers = new Cavaliers();
$listeCavaliers = $cavaliers->CavaliersAll();

// Création de l'instance de PDF
$pdf = new PDF('L', 'mm', 'A4'); // 'L' pour paysage
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// En-tête du tableau
$pdf->TableHeader();

// Contenu du tableau
$alternate = false; // Pour les couleurs alternées des lignes
foreach ($listeCavaliers as $c) {
    if ($c['supprime'] != '1') {
        $galop = $cavaliers->CavaliersGalop($c['idgalop']);
        $pdf->TableRow($c['nomcava'], $c['prenomcava'], $c['datenacava'], $c['numlic'], $galop, $c['nomresp'], $c['prenomresp'], $c['rueresp'], $c['vilresp'], $c['cpresp'], $c['telresp'], $c['emailresp'], $c['assurance'], $alternate);
        $alternate = !$alternate;
    }
}

// Sortie du PDF
$pdf->Output();
?>
