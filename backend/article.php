<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include "db.php";

$sql = "SELECT * FROM Article";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($articles);
?>
