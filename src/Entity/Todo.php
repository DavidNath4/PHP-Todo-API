<?php

namespace App\Entity {

    use InvalidArgumentException;

    class Todo
    {
        private $id;
        private $title;
        private $todo;
        private $schedule;

        public function __construct($title, $todo, $schedule)
        {
            $this->title = $title;
            $this->todo = $todo;
            $this->schedule = $schedule;
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function setId(int $id): void
        {
            if ($id <= 0) {
                throw new InvalidArgumentException('Invalid ID');
            }
            $this->id = $id;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function setTitle(string $title): void
        {
            // Add validation for title (e.g., length, allowed characters)
            if (strlen($title) < 1) {
                throw new InvalidArgumentException('Title cannot be empty');
            }

            $this->title = $title;
        }

        public function getTodo(): string
        {
            return $this->todo;
        }

        public function setTodo(string $todo): void
        {
            // Add validation for todo (e.g., length, allowed characters)
            if (strlen($todo) < 1) {
                throw new InvalidArgumentException('Todo description cannot be empty');
            }

            $this->todo = $todo;
        }

        public function getSchedule(): ?string
        {
            return $this->schedule;
        }

        public function setSchedule(?string $schedule): void
        {
            // Add validation for schedule (e.g., date format)
            if ($schedule !== null && !strtotime($schedule)) {
                throw new InvalidArgumentException('Invalid date format for schedule');
            }

            $this->schedule = $schedule;
        }
    }
}
