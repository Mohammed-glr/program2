
<?php

require_once '../config.php';

$sql = "SELECT * FROM crud ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($results);
exit();