<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");


include "db.php";
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

$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE mail = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && $motDePasse === $user['mot_de_passe']){
    echo json_encode([
        "success" => true,
        "message" => "Connexion réussie",
        "id" => $user['idUtilisateur'],
        "nom" => $user['nom'],
        "prenom" => $user['prenom'],
        "mail" => $user['mail'],
        "adresse" => $user['adresse'],
        "telephone" => $user['telephone'],
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect"]);
}
