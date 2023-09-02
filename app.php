<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/src/Controller/TodoController.php';
require_once __DIR__ . '/src/Repository/TodoRepository.php';
require_once __DIR__ . '/src/Service/TodoService.php';
require_once __DIR__ . '/src/Router/Router.php';

use App\Controller\TodoController;
use App\Repository\TodoRepository;
use App\Router\Router;
use App\Service\TodoService;
use Config\Database;

$connection = Database::getConnection();

$todoRepository = new TodoRepository($connection);
$todoService = new TodoService($todoRepository);
$todoController = new TodoController($todoService);

$router = new Router();

$router->addRoute('/app.php/createTodo', 'POST', 'createTodoAction');
$router->addRoute('/app.php/getAllTodo', 'GET', 'getAllTodosAction');
$router->addRoute('/app.php/getTodo', 'GET', 'getTodoByIdAction');
$router->addRoute('/app.php/updateTodo', 'PUT', 'updateTodoAction');
$router->addRoute('/app.php/deleteTodo', 'DELETE', 'deleteTodoAction');

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = $router->matchRoute($requestPath, $requestMethod);

if ($action !== null) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Call the appropriate controller action
        $todoController->{$action}($id);
    }
} else {
    http_response_code(404); // Not Found
    echo json_encode(['message' => 'Endpoint not found']);
}

Database::closeConnection();
