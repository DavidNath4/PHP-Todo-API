<?php

namespace App\Service {

    require_once __DIR__ . "/../Interface/TodoServiceInterface.php";
    require_once __DIR__ . "/../Entity/Todo.php";

    use App\Interfaces\TodoServiceInterface;
    use App\Interfaces\TodoRepositoryInterface;
    use App\Entity\Todo;

    class TodoService implements TodoServiceInterface
    {
        private $todoRepository;

        public function __construct(TodoRepositoryInterface $todoRepository)
        {
            $this->todoRepository = $todoRepository;
        }

        public function getTodoById(int $id): ?array
        {
            return $this->todoRepository->getById($id);
        }

        public function getAllTodos(): array
        {
            return $this->todoRepository->getAll();
        }

        public function createTodo(string $title, string $listTodo, ?string $schedule): bool
        {
            $todo = new Todo($title, $listTodo, $schedule);

            return $this->todoRepository->create($todo);
        }

        public function updateTodo(int $id, string $title, string $listTodo, ?string $schedule): bool
        {
            $todo = new Todo(title: $title, todo: $listTodo, schedule: $schedule);
            $todo->setId($id);

            return $this->todoRepository->update($todo);
        }


        public function deleteTodo(int $id): bool
        {
            return $this->todoRepository->delete($id);
        }
    }
}
