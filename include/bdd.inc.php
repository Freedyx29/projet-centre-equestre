<?php
function connexionPDO() {
    try{
        $db = "equihorizon";
        $User = "root";
        $Pass = "";
        $Serveur = "localhost";
        $Con = new PDO("mysql:host=$Serveur;dbname=$db", $User, $Pass);
        return $Con;
        //new PDO("mysql:host=$Serveur;dbname=$db,$User",$Pass);
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}