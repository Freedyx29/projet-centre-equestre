<?php
try {
    // Connexion à la base de données
    $db = "mysql:host=localhost;dbname=equihorizon";
    $user = "root";
    $pass = "";
    $con = new PDO($db, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Données des administrateurs
    $admins = [
        [
            'mail' => 'admin1@gmail.com',
            'nom' => 'Admin1',
            'prenom' => 'User1',
            'password' => 'adminpass1'
        ],
        [
            'mail' => 'admin2@gmail.com',
            'nom' => 'Admin2',
            'prenom' => 'User2',
            'password' => 'adminpass2'
        ],
        [
            'mail' => 'admin3@gmail.com',
            'nom' => 'Admin3',
            'prenom' => 'User3',
            'password' => 'adminpass3'
        ]
    ];

    $sql = "INSERT INTO utilisateurs (mailuti, nomuti, prenomuti, mdputi) VALUES (:mail, :nom, :prenom, :password)";
    $stmt = $con->prepare($sql);

    foreach ($admins as $admin) {
        $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);
        $stmt->execute([
            ':mail' => $admin['mail'],
            ':nom' => $admin['nom'],
            ':prenom' => $admin['prenom'],
            ':password' => $hashedPassword
        ]);
    }

    echo "Administrateurs ajoutés avec succès !";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>