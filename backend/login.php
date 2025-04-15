<?php
session_start(); // ➤ Active les sessions

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

include "db.php";

$data = json_decode(file_get_contents("php://input"));

$mail = $data->mail;
$mot_de_passe = $data->mot_de_passe;

$stmt = $pdo->prepare("SELECT * FROM client WHERE mail = ?");
$stmt->execute([$mail]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
    $_SESSION['user'] = [
        "id" => $user['idClient'],
        "nom" => $user['nom'],
        "prenom" => $user['prenom'],
        "mail" => $user['mail']
    ];
    echo json_encode(["message" => "Connexion réussie", "user" => $_SESSION['user']]);
} else {
    echo json_encode(["error" => "Email ou mot de passe incorrect"]);
}
?>
