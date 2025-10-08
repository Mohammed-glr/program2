<?php

require_once '../config.php';

$sql = "INSERT INTO todos 
        (id, title, description, is_completed, due_date, created_at, updated_at) 
        VALUES (NULL, :title, :description, :is_completed, :due_date, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':title' => $_POST['title'],
    ':description' => $_POST['description'],
    ':is_completed' => isset($_POST['is_completed']) ? true : false,
    ':due_date' => $_POST['due_date'] ? $_POST['due_date'] : null,
    ':created_at' => date('Y-m-d H:i:s'),
    ':updated_at' => date('Y-m-d H:i:s'),
]);

header('Location: ../view/index.php');
exit();
 


