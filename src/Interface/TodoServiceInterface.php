<?php

namespace App\Interfaces {

    interface TodoServiceInterface
    {
        public function getTodoById(int $id): ?array;
        public function getAllTodos(): array;
        public function createTodo(string $title, string $listTodo, ?string $schedule): bool;
        public function updateTodo(int $id, string $title, string $listTodo, ?string $schedule): bool;
        public function deleteTodo(int $id): bool;
    }
}
