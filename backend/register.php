<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = "localhost";
$dbname = "mcboo";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erreur de connexion à la base de données."]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $data["mail"] ?? "";
    $password = $data["mot_de_passe"] ?? "";

    if (empty($email) || empty($password)) {
        echo json_encode(["success" => false, "error" => "Tous les champs sont requis."]);
        exit();
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO Client (mail, mot_de_passe) VALUES (:mail, :mot_de_passe)");
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":mot_de_passe", $hashedPassword);
        $stmt->execute();

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => "Erreur lors de l'inscription."]);
    }
}
?>