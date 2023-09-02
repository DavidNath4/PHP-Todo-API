<?php

namespace App\Controller {

    require_once __DIR__ . "/../../Helper/Helper.php";

    use App\Interfaces\TodoServiceInterface;
    use Exception;
    use Helper\Helper;

    class TodoController
    {
        private $todoService;

        public function __construct(TodoServiceInterface $todoService)
        {
            $this->todoService = $todoService;
        }

        // Implement methods to handle HTTP requests, call appropriate service methods, and return responses

        /**
         * Getting All TODOs.
         * @param int $id
         */
        public function getTodoByIdAction(int $id)
        {
            try {
                Helper::validateRequestMethod('GET');

                $todo = $this->todoService->getTodoById($id);

                if ($todo === null) {
                    throw new Exception('Todo item not found', 404);
                }

                Helper::respondWithJson($todo, 200);
            } catch (Exception $exception) {
                Helper::handleException($exception);
            }
        }


        /**
         * Getting All TODOs.
         */
        public function getAllTodosAction()
        {
            try {
                Helper::validateRequestMethod('GET');

                $todos = $this->todoService->getAllTodos();

                if (empty($todos)) {
                    throw new Exception('No Todo items found', 404);
                }

                Helper::respondWithJson($todos, 200);
            } catch (Exception $exception) {
                Helper::handleException($exception);
            }
        }


        /**
         * Create a new Todo item.
         */
        public function createTodoAction()
        {
            try {
                Helper::validateRequestMethod('POST');

                $requestData = json_decode(file_get_contents('php://input'), true);

                if ($requestData === null) {
                    throw new Exception('Invalid JSON data', 400);
                }

                $title = $requestData['title'] ?? '';
                $todo = $requestData['todo'] ?? '';
                $schedule = $requestData['schedule'] ?? '';

                if (empty($title) || empty($todo) || empty($schedule)) {
                    Helper::respondWithErrorMessage('Incomplete data', 400);
                }

                $success = $this->todoService->createTodo($title, $todo, $schedule);

                if ($success) {
                    Helper::respondWithSuccessMessage('Todo item created successfully', 201);
                } else {
                    Helper::respondWithErrorMessage('Failed to create Todo item', 400);
                }
            } catch (Exception $exception) {
                Helper::handleException($exception);
            }
        }

        /**
         * Create a new Todo item.
         */
        public function updateTodoAction(int $id)
        {
            try {

                Helper::validateRequestMethod(['PUT', 'PATCH']);

                $requestData = json_decode(file_get_contents('php://input'), true);

                if ($requestData === null) {
                    Helper::respondWithErrorMessage('Invalid JSON data', 400);
                }

                $existingTodo = $this->todoService->getTodoById($id);

                if (!$existingTodo) {
                    Helper::respondWithErrorMessage('Todo item not found', 404);
                }

                $success = $this->todoService->updateTodo(
                    $id,
                    $requestData['title'] ?? $existingTodo['title'],
                    $requestData['todo'] ?? $existingTodo['todo'],
                    $requestData['schedule'] ?? $existingTodo['schedule']
                );

                if ($success) {
                    Helper::respondWithSuccessMessage('Todo item updated successfully', 200);
                } else {
                    Helper::respondWithErrorMessage('Failed to update Todo item', 400);
                }
            } catch (Exception $exception) {
                Helper::handleException($exception);
            }
        }

        /**
         * Create a new Todo item.
         */
        public function deleteTodoAction(int $id)
        {
            try {
                Helper::validateRequestMethod('DELETE');

                $existingTodo = $this->todoService->getTodoById($id);

                if (!$existingTodo) {
                    Helper::respondWithErrorMessage('Todo item not found', 404);
                }

                $success = $this->todoService->deleteTodo($id);
                if ($success) {
                    Helper::respondWithSuccessMessage('Todo item deleted successfully', 200);
                } else {
                    Helper::respondWithErrorMessage('Failed to delete Todo item', 400);
                }
            } catch (Exception $exception) {
                Helper::handleException($exception);
            }
        }
    }
}
