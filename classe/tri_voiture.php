<?php
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/voiture.php';

header('Content-Type: application/json');

$dbInstance = new Database();
$db = $dbInstance->getConnection();

$voitureInstance = new Voiture($db);

$tri = isset($_GET['tri']) ? $_GET['tri'] : 'nom';

$voitures = $voitureInstance->getAllVoitures($tri);

echo json_encode($voitures);
