<?php

require_once '../config.php';

$sql = "INSERT INTO crud (naam) VALUES (:naam)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':naam', $_POST['naam'], PDO::PARAM_STR);
$stmt->execute();

header('Location: ../view/index.php');
exit();


