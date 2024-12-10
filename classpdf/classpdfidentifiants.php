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
        $this->Cell(0, 20, utf8_decode('Identifiants du Cavalier'), 0, 1, 'C');
        $this->Ln(10); // Espacement après l'en-tête
        // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY()); // Ajusté pour le portrait
        $this->Ln(10);
    }

    // Pied de page
    function Footer() {
        $this->SetY(-30); // Ligne de séparation
        $this->SetDrawColor(212, 164, 94); // #D4A45E
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY()); // Ajusté pour le portrait
        $this->Ln(5); // Espacement après la ligne
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
        $tableWidth = 160;
        $pageWidth = 210;
        $startX = ($pageWidth - $tableWidth) / 2; // Centrer le tableau
        $this->SetX($startX);

        // Ajustement des largeurs
        $this->Cell(80, 12, utf8_decode('Email'), 1, 0, 'C', true);
        $this->Cell(80, 12, utf8_decode('Mot de passe'), 1, 0, 'C', true);
        $this->Ln();
    }

    // Ligne du tableau
    function TableRow($email, $password) {
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(60, 36, 21);

        $tableWidth = 160;
        $pageWidth = 210;
        $startX = ($pageWidth - $tableWidth) / 2; // Centrer le tableau
        $this->SetX($startX);

        // Mêmes largeurs que dans TableHeader
        $this->Cell(80, 12, utf8_decode($email), 1, 0, 'C', true);
        $this->Cell(80, 12, utf8_decode($password), 1, 0, 'C', true);
        $this->Ln();
    }
}

if (isset($_GET['idcava'])) {
    $idcava = $_GET['idcava'];
    $cavaliers = new Cavaliers();
    $cavalier = $cavaliers->getCavalierById($idcava); // Ensure this method is implemented

    if ($cavalier) {
        $pdf = new PDF('P', 'mm', 'A4'); // 'P' pour portrait
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->TableHeader();
        $pdf->TableRow($cavalier['emailresp'], $cavalier['password']);
        $pdf->Output();
    } else {
        echo "Cavalier non trouvé.";
    }
} else {
    echo "ID du cavalier non spécifié.";
}
?>
