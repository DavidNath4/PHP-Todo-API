<?php

namespace App\Interfaces {

    use APP\Entity\Todo;

    interface TodoRepositoryInterface
    {
        public function getById(int $id): ?array;
        public function getAll(): array;
        public function create(Todo $todo): bool;
        public function update(Todo $todo): bool;
        public function delete(int $id): bool;
    }
}
