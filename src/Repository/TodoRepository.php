<?php

namespace App\Repository {

    require_once  __DIR__ . "/../Interface/TodoRepositoryInterface.php";

    use APP\Entity\Todo;
    use App\Interfaces\TodoRepositoryInterface;
    use PDO;

    class TodoRepository implements TodoRepositoryInterface
    {
        private PDO $connection;

        public function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        public function getById(int $id): ?array
        {
            // Implement fetching Todo by ID from the database using PDO
            $query = "SELECT * FROM todoLIST WHERE id = ?";
            $statement = $this->connection->prepare($query);
            $statement->execute([$id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            return $result;
        }

        public function getAll(): array
        {
            // Implement fetching all Todos from the database using PDO
            $query = "SELECT * FROM todoLIST";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }


        public function create(Todo $todo): bool
        {
            // Implement creating a new Todo in the database using PDO
            $query = "INSERT INTO todoLIST (title, todo, schedule) VALUES(?,?,?) ";
            $statement = $this->connection->prepare($query);

            $title = $todo->getTitle();
            $listTodo = $todo->getTodo();
            $schedule = $todo->getSchedule();

            $result = $statement->execute([$title, $listTodo, $schedule]);

            return $result;
        }

        public function update(Todo $todo): bool
        {
            // Implement updating a Todo in the database using PDO
            $query = "UPDATE todoLIST SET title = ?, todo = ?, schedule = ? WHERE id = ?";
            $statement = $this->connection->prepare($query);

            $id = $todo->getId();
            $title = $todo->getTitle();
            $listTodo = $todo->getTodo();
            $schedule = $todo->getSchedule();

            $result = $statement->execute([$title, $listTodo, $schedule, $id]);

            return $result;
        }

        public function delete(int $id): bool
        {
            // Implement deleting a Todo from the database using PDO
            $query = "DELETE FROM todoLIST WHERE id = ?";
            $statement = $this->connection->prepare($query);

            $result = $statement->execute([$id]);

            return $result;
        }
    }
}
