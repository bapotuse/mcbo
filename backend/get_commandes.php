<?php
// Connexion à la base de données
include '../db.php';

// Récupérer toutes les commandes
$sql = "SELECT idCommande, nomClient, statutCommande, dateCommande, totalCommande FROM commande ORDER BY dateCommande DESC";
$result = $conn->query($sql);

$commandes = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commandes[] = $row;
    }
}

// Retourner en JSON
header('Content-Type: application/json');
echo json_encode($commandes);

$conn->close();
?>
