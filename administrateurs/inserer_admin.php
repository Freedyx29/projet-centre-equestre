<?php
try {
    // Connexion à la base de données
    require_once('../include/bdd.inc.php');
    $con = connexionPDO();

    // Supprime les anciens admins
    $con->query("TRUNCATE TABLE administrateurs");

    // Création des trois admins
    $admins = [
        [
            'email' => 'admin1@gmail.com',
            'nom' => 'Admin1',
            'prenom' => 'User1',
            'password' => '8f#G@2bXq5Z!'
        ],
        [
            'email' => 'ayarouan52@gmail.com',
            'nom' => 'Rouan',
            'prenom' => 'Aya',
            'password' => '1234'
        ],
        [
            'email' => 'MelikeKiris24@gmail.com ',
            'nom' => 'Kiris',
            'prenom' => 'Melike',
            'password' => '1234'
        ],
        [
            'email' => 'lukasgrimaud31@gmail.com',
            'nom' => 'Grimaud',
            'prenom' => 'Lukas',
            'password' => '1234'
        ],
        [
            'email' => 'prof@gmail.com',
            'nom' => 'Prof',
            'prenom' => 'User4',
            'password' => '7Z#p@W3k!9Xq',
        ]
    ];

    $sql = "INSERT INTO administrateurs (mailadmin, nomadmin, prenomadmin, passwordadmin) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    foreach ($admins as $admin) {
        $hashedPassword = password_hash($admin['password'], PASSWORD_DEFAULT);
        $stmt->execute([$admin['email'], $admin['nom'], $admin['prenom'], $hashedPassword]);
        
        echo "Admin créé avec succès!<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "Mot de passe: " . $admin['password'] . "<br><br>";
    }

    echo "Tous les administrateurs ont été créés avec succès !";

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
