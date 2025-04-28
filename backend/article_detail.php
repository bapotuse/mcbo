<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include 'db.php';  // Inclut la connexion PDO

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Sécurise l'ID en tant qu'entier

    try {
        $stmt = $pdo->prepare("SELECT id, nom, description, prix, image FROM article WHERE idArticle = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            echo json_encode($article);  // Renvoie l'article au format JSON
        } else {
            echo json_encode(['error' => 'Article non trouvé']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erreur de la requête : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID manquant']);
}
?>
