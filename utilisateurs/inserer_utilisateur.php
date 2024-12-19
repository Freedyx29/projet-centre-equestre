<?php
try {
    // Connexion à la base de données
    require_once('../include/bdd.inc.php');
    $con = connexionPDO();

    // Supprime les anciens utilisateurs
    $con->query("TRUNCATE TABLE utilisateurs");

    // Création des trois admins
    $admins = [
        [
            'email' => 'admin1@gmail.com',
            'nom' => 'Admin1',
            'prenom' => 'User1',
            'password' => 'admin123'
        ],
        [
            'email' => 'admin2@gmail.com',
            'nom' => 'Admin2',
            'prenom' => 'User2',
            'password' => 'admin456'
        ],
        [
            'email' => 'admin3@gmail.com',
            'nom' => 'Admin3',
            'prenom' => 'User3',
            'password' => 'admin789'
        ],
        [
            'email' => 'admin4@gmail.com',
            'nom' => 'Admin4',
            'prenom' => 'User4',
            'password' => 'admin101112'
        ]
    ];

    $sql = "INSERT INTO utilisateurs (mailuti, nomuti, prenomuti, mdputi) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    foreach ($admins as $admin) {
        $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);
        $stmt->execute([$admin['email'], $admin['nom'], $admin['prenom'], $hashedPassword]);
        
        echo "Admin créé avec succès!<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "Mot de passe: " . $admin['password'] . "<br><br>";
    }

    echo "Tous les administrateurs ont été créés avec succès!";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
