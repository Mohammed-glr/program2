<?php

require_once __DIR__ . '/../Services/TodoService.php';

class TodoController
{
    private $todoService;

    public function __construct() {
        $this->todoService = new TodoService();
    }

    public function getTodosByUserId(int $userId): array
    {
        return $this->todoService->getTodosByUserId($userId);
    }

    public function createTodo(int $userId, string $title, ?string $description): bool
    {
        return $this->todoService->createTodo($userId, $title, $description);
    }

    public function updateTodo(int $id, string $title, ?string $description, bool $isCompleted): bool
    {
        return $this->todoService->updateTodo($id, $title, $description, $isCompleted);
    }

    public function deleteTodo(int $id): bool
    {
        return $this->todoService->deleteTodo($id);
    }

    public function getTodoById(int $id): ?Todo
    {
        return $this->todoService->getTodoById($id);
    }

    public function toggleTodoCompletion(int $id): bool
    {
        return $this->todoService->toggeleTodoCompletion($id);
    }
}