<?php

/**
 * Retourne la liste des projets
 * @return array Liste des projets
 */
function getAllProjects(int $limit = 999): array {
    global $connexion;

    $query = "SELECT
                projet.*,
                DATE_FORMAT(projet.date_debut, '%d/%m/%Y') AS date_debut_format,
                REPLACE(FORMAT(projet.prix, 'currency', 'de_DE'), '.', ' ') AS prix_format,
                categorie.libelle AS categorie,
                COUNT(participation.id) AS nb_participants,
                IFNULL(SUM(participation.montant), 0) AS montant_participations,
                AVG(notation.note) AS note_moyenne
            FROM projet
            INNER JOIN categorie ON categorie.id = projet.categorie_id
            LEFT JOIN participation ON participation.projet_id = projet.id
            LEFT JOIN notation ON notation.projet_id = projet.id
            GROUP BY projet.id
            ORDER BY projet.date_debut DESC
            LIMIT :limit;";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":limit", $limit);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getProject(int $id): array {
    global $connexion;

    $query = "SELECT
                projet.*,
                DATE_FORMAT(projet.date_debut, '%d/%m/%Y') AS date_debut_format,
                REPLACE(FORMAT(projet.prix, 'currency', 'de_DE'), '.', ' ') AS prix_format,
                categorie.libelle AS categorie,
                COUNT(participation.id) AS nb_participants,
                IFNULL(SUM(participation.montant), 0) AS montant_participations,
                AVG(notation.note) AS note_moyenne
            FROM projet
            INNER JOIN categorie ON categorie.id = projet.categorie_id
            LEFT JOIN participation ON participation.projet_id = projet.id
            LEFT JOIN notation ON notation.projet_id = projet.id
            WHERE projet.id = :id;";

    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}

function insertProjet(string $titre, string $image, string $date_debut, string $date_fin, float $prix, string $description, int $categorie_id): int {
    /* @var $connexion PDO */
    global $connexion;
    
    $query = "INSERT INTO projet (titre, image, date_debut, date_fin, description, prix, categorie_id) VALUES (:titre, :image, :date_debut, :date_fin, :description, :prix, :categorie_id)";
    
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":titre", $titre);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":prix", $prix);
    $stmt->bindParam(":categorie_id", $categorie_id);
    $stmt->execute();
    
    return $connexion->lastInsertId();
}

function updateProjet(int $id, string $titre, string $image, string $date_debut, string $date_fin, float $prix, string $description, int $categorie_id): int {
    /* @var $connexion PDO */
    global $connexion;
    
    $query = "UPDATE projet
                SET titre = :titre,
                    image = :image,
                    date_debut = :date_debut,
                    date_fin = :date_fin,
                    prix = :prix,
                    description = :description,
                    categorie_id = :categorie_id
                WHERE id = :id
            ";
    
    $stmt = $connexion->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":titre", $titre);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":date_debut", $date_debut);
    $stmt->bindParam(":date_fin", $date_fin);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":prix", $prix);
    $stmt->bindParam(":categorie_id", $categorie_id);
    $stmt->execute();
    
    return $connexion->lastInsertId();
}