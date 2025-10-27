<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Models/Todo.php';

class TodoRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function findByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll();

        $todos = [];
        foreach ($rows as $row) {
            $todos[] = new Todo(
                $row['id'],
                $row['user_id'],
                $row['title'],
                $row['description'],
                (bool)$row['is_completed'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return $todos;
    }

    public function createTodo(int $userId, string $title, ?string $description): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO todos (user_id, title, description, is_completed, created_at, updated_at) VALUES (:user_id, :title, :description, 0, NOW(), NOW())');
        return $stmt->execute(['user_id' => $userId, 'title' => $title, 'description' => $description]);
    }

    public function updateTodo(int $id, string $title, ?string $description, bool $isCompleted): bool
    {
        $stmt = $this->pdo->prepare('UPDATE todos SET title = :title, description = :description, is_completed = :is_completed, updated_at = NOW() WHERE id = :id');
        return $stmt->execute(['title' => $title, 'description' => $description, 'is_completed' => $isCompleted ? 1 : 0, 'id' => $id]);
    }

    public function deleteTodo(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM todos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function findById(int $id): ?Todo
    {
        $stmt = $this->pdo->prepare('SELECT * FROM todos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new Todo(
                $row['id'],
                $row['user_id'],
                $row['title'],
                $row['description'],
                (bool)$row['is_completed'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return null;
    }

    public function markAsCompleted(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE todos SET is_completed = 1, updated_at = NOW() WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function markAsUncompleted(int $id): bool
    {
        $stmt = $this->pdo->prepare('UPDATE todos SET is_completed = 0, updated_at = NOW() WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}