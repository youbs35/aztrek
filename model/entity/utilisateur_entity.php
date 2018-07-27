<?php

function getOneUtilisateurByEmailPassword(string $email, string $password) {
    global $connexion;
    
    $query = "SELECT * FROM utilisateur WHERE email = :email AND mot_de_passe = SHA1(:password)";
    
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    return $stmt->fetch();
}

function insertUtilisateur(string $nom, string $prenom, string $email, string $mot_de_passe, string $photo): int {
    global $connexion;
    
    $query = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, photo, admin) VALUES (:nom, :prenom, :email, SHA1(:mot_de_passe), :photo, 0);";
    
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":mot_de_passe", $mot_de_passe);
    $stmt->bindParam(":photo", $photo);
    $stmt->execute();
    
    return $connexion->lastInsertId();
}