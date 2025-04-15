<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

include "db.php";
// Vérification de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"] ?? '';
$motDePasse = $data["mot_de_passe"] ?? '';

if (empty($email) || empty($motDePasse)) {
    echo json_encode(["success" => false, "message" => "Champs requis manquants"]);
    exit;
}

// Requête sur la table client
$stmt = $pdo->prepare("SELECT * FROM client WHERE mail = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
    echo json_encode([
        "success" => true,
        "message" => "Connexion réussie",
        "idClient" => $user['idClient'],
        "nom" => $user['nom'],
        "prenom" => $user['prenom'],
        "mail" => $user['mail'],
        "adresse" => $user['adresse'],
        "telephone" => $user['telephone'],
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect"]);
}
