<?php

require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "INSERT INTO todos 
                (title, description, is_completed, due_date) 
                VALUES (:title, :description, :is_completed, :due_date)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':title' => $_POST['title'],
            ':description' => $_POST['description'],
            ':is_completed' => isset($_POST['is_completed']) ? 1 : 0,
            ':due_date' => !empty($_POST['due_date']) ? $_POST['due_date'] : null,
        ]);

        header('Location: ../view/index.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

header('Location: ../view/index.php');
exit();
 


