<?php

require_once __DIR__ . '/../../config/Connection.php';
require_once __DIR__ . '/../Models/Todo.php';

class TodoService
{
    private $todoRepo;

    public function __construct() {
        $this->todoRepo = new TodoRepository();
    }

    public function getTodosByUserId(int $userId): array
    {
        return $this->todoRepo->findByUserId($userId);
    }

    public function createTodo(int $userId, string $title, ?string $description): bool
    {
        return $this->todoRepo->createTodo($userId, $title, $description);
    }

    public function updateTodo(int $id, string $title, ?string $description, bool $isCompleted): bool
    {
        return $this->todoRepo->updateTodo($id, $title, $description, $isCompleted);
    }

    public function deleteTodo(int $id): bool
    {
        return $this->todoRepo->deleteTodo($id);
    }

    public function getTodoById(int $id): ?Todo
    {
        return $this->todoRepo->findById($id);
    }

    public function toggeleTodoCompletion(int $id): bool
    {
        $todo = $this->todoRepo->findById($id);
        if ($todo) {
            $newStatus = !$todo->isCompleted();
            return $this->todoRepo->updateTodo($id, $todo->getTitle(), $todo->getDescription(), $newStatus);
        }
        return false;
    }
}