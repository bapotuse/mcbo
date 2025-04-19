<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

try {
    $pdo = new PDO("mysql:host=localhost;dbname=mcboo;charset=utf8", "root", "");

    $data = json_decode(file_get_contents("php://input"));

    $nom = $data->nom ?? '';
    $prenom = $data->prenom ?? '';
    $email = $data->email ?? '';
    $mot_de_passe = $data->mot_de_passe ?? '';
    $adresse = $data->adresse ?? '';
    $telephone = $data->telephone ?? '';

    if (!$nom || !$prenom || !$email || !$mot_de_passe || !$adresse || !$telephone) {
        echo json_encode(["success" => false, "message" => "Tous les champs sont requis."]);
        exit;
    }

    // Vérifie si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM client WHERE mail = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(["success" => false, "message" => "Cet email est déjà utilisé."]);
        exit;
    }

    // Hash du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Insertion
    $insert = $pdo->prepare("INSERT INTO client (nom, prenom, mail, mot_de_passe, adresse, telephone) VALUES (?, ?, ?, ?, ?, ?)");
    $success = $insert->execute([$nom, $prenom, $email, $mot_de_passe_hash, $adresse, $telephone]);

    if ($success) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'inscription."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur PDO : " . $e->getMessage()]);
}
