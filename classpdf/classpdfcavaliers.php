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
        $this->Cell(0, 20, 'Liste des Cavaliers', 0, 1, 'C');
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
        $this->Cell(0, 10, 'Vu le : ' . date('d/m/Y H:i:s') . ' | Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // En-tête du tableau
    function TableHeader() {
        $this->SetFont('Arial', 'B', 8); // Réduction de la taille de la police
        $this->SetFillColor(60, 36, 21); // Couleur de fond : #3C2415
        $this->SetTextColor(255, 255, 255); // Couleur du texte : blanc
        $this->SetDrawColor(60, 36, 21); // Couleur des bordures : #3C2415
        // Calculer la position pour centrer le tableau
        $tableWidth = 270; // Largeur totale des cellules
        $pageWidth = 297; // Largeur de la page en paysage
        $startX = ($pageWidth - $tableWidth) / 2 - 10; // Déplacer légèrement vers la gauche
        $this->SetX($startX);
        $this->Cell(20, 10, 'Nom Cav.', 1, 0, 'C', true); // Fond activé avec true
        $this->Cell(20, 10, 'Prenom Cav.', 1, 0, 'C', true);
        $this->Cell(20, 10, 'JJ/MM/AAAA', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Num Licence', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Galop', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Nom Resp.', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Prenom Resp.', 1, 0, 'C', true);
        $this->Cell(15, 10, 'Rue Resp.', 1, 0, 'C', true); // Colonne réduite
        $this->Cell(35, 10, 'Ville Resp.', 1, 0, 'C', true); // Colonne élargie
        $this->Cell(20, 10, 'CP Resp.', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Tel Resp.', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Email Resp.', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Assurance', 1, 0, 'C', true);
        $this->Ln();
    }

    // Contenu du tableau
    function TableRow($nomcava, $prenomcava, $datenacava, $numlic, $galop, $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp, $emailresp, $assurance, $alternate) {
        $this->SetFont('Arial', '', 8); // Réduction de la taille de la police
        $this->SetFillColor($alternate ? 240 : 255, $alternate ? 240 : 255, $alternate ? 240 : 255); // Nuances de beige
        $this->SetTextColor(60, 36, 21); // Couleur du texte : #3C2415
        // Calculer la position pour centrer le tableau
        $tableWidth = 270; // Largeur totale des cellules
        $pageWidth = 297; // Largeur de la page en paysage
        $startX = ($pageWidth - $tableWidth) / 2 - 10; // Déplacer légèrement vers la gauche
        $this->SetX($startX);

        // Reformater la date de naissance au format européen
        $datenacava = date('d/m/Y', strtotime($datenacava));

        $this->Cell(20, 10, $nomcava, 1, 0, 'C', true); // Utilisation du fond
        $this->Cell(20, 10, $prenomcava, 1, 0, 'C', true);
        $this->Cell(20, 10, $datenacava, 1, 0, 'C', true);
        $this->Cell(20, 10, $numlic, 1, 0, 'C', true);
        $this->Cell(20, 10, $galop, 1, 0, 'C', true);
        $this->Cell(20, 10, $nomresp, 1, 0, 'C', true);
        $this->Cell(20, 10, $prenomresp, 1, 0, 'C', true);
        $this->Cell(15, 10, $rueresp, 1, 0, 'C', true); // Colonne réduite
        $this->Cell(35, 10, $vilresp, 1, 0, 'C', true); // Colonne élargie
        $this->Cell(20, 10, $cpresp, 1, 0, 'C', true);
        $this->Cell(20, 10, $telresp, 1, 0, 'C', true);
        $this->Cell(30, 10, $emailresp, 1, 0, 'C', true);
        $this->Cell(25, 10, $assurance, 1, 0, 'C', true);
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
        $alternate = !$alternate; // Alterne entre deux fonds
    }
}

// Sortie du PDF
$pdf->Output();
?>
