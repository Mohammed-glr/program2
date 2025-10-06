<?php

require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $is_completed = isset($_POST['is_completed']) ? true : false;
    $due_date = $_POST['due_date'] ? $_POST['due_date'] : null;
    $updated_at = date('Y-m-d H:i:s');
    $created_at = date('Y-m-d H:i:s');

    $sql = "UPDATE management_todos 
            SET title = :title, 
                description = :description, 
                is_completed = :is_completed, 
                due_date = :due_date, 
                updated_at = :updated_at 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':is_completed' => $is_completed,
        ':due_date' => $due_date,
        ':updated_at' => $updated_at,
        ':id' => $id,
    ]);
    header('Location: ../view/index.php');
    exit();
}
header('Location: ../view/index.php');
exit();