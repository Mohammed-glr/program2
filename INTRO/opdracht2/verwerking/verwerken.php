<?php

require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $naam = $_POST['naam'];

    $sql = "UPDATE crud SET naam = :naam WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
    $stmt->execute();

    header('Location: ../view/index.php');
    exit();
}
header('Location: ../view/index.php');
exit();