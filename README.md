# PHP Todo List API

## Description

This PHP Todo List API is a simple and organized backend service for managing todo items. It provides a set of RESTful endpoints to perform CRUD (Create, Read, Update, Delete) operations on todo items, making it easy to integrate with various frontend applications.

## Concept

The project follows the concept of separating concerns into different classes and namespaces, adhering to modern PHP best practices. Key concepts and features include:

- Modular Structure: The codebase is organized into classes and namespaces for the database connection, controller, repository, service, and router, ensuring clean and maintainable code.
- Error Handling: Robust error handling and validation are implemented throughout the codebase to provide informative error messages and HTTP status codes.
- Database Interaction: The API interacts with a MySQL database using PDO, encapsulated within the Database class.
- Validation: Input validation and data integrity checks are performed on incoming data.
- Interfaces: Interfaces define contracts for the repository and service classes, promoting code flexibility and testability.
- Routing: The Router class manages route registration and matching for different HTTP methods and paths.

### API Specs

| Parameter                                  | Method   | API                        |
| :----------------------------------------- | :------- | :------------------------- |
| `body:{title, todo, schedule}`             | `POST`   | `/app.php/createTodo`      |
| `-`                                        | `GET`    | `/app.php/getAllTodo`      |
| `query:{id}`                               | `GET`    | `/app.php/getTodo?id=?`    |
| `query:{id}, body:{title, todo, schedule}` | `PUT`    | `/app.php/updateTodo?id=?` |
| `query:{id}`                               | `DELETE` | `/app.php/deleteTodo?id=?` |

##### Create Todo

`/app.php/createTodo`

```
{
    "title": "Meeting with Client",
    "todo": "Discuss project updates and client requirements",
    "schedule": "2023-09-18"
}

```

##### Create Todo Response

```
{
    "message": "Todo item created successfully"
}
```

##### GET all

`/app.php/getAllTodo`

##### GET all Response

```
[
    {
        "id": 1,
        "title": "Meeting with Client",
        "todo": "Discuss project updates and client requirements",
        "schedule": "2023-09-18 00:00:00",
        "time_update": "2023-09-02 14:15:51",
        "created_at": "2023-09-02 11:18:02"
    },
    {
        "id": 2,
        "title": "Finish coding project",
        "todo": "Complete the remaining tasks in the project",
        "schedule": "2023-09-10 00:00:00",
        "time_update": "2023-09-02 11:41:34",
        "created_at": "2023-09-02 11:41:34"
    },

]
```

##### GET by id

`/app.php/getTodo?id=2`

##### GET by id Response

```
{
    "id": 2,
    "title": "Finish coding project",
    "todo": "Complete the remaining tasks in the project",
    "schedule": "2023-09-10 00:00:00",
    "time_update": "2023-09-02 11:41:34",
    "created_at": "2023-09-02 11:41:34"
}
```

##### Update Todo

`/updateTodo?id=8`

```
{
    "title": "EDITED DATA",
    "todo": "EDITED DATA",
    "schedule": "2023-09-30"
}
```

#### Update Todo Response

```
{
    "message": "Todo item updated successfully"
}
```

#### Delete Todo

`/deleteTodo?id=2`

#### Delete Todo Response

```
{
    "message": "Todo item deleted successfully"
}
```

![index](https://github.com/DavidNath4/PHP-Todo-API/assets/73566173/c32198fb-5bf9-4111-93b9-b38899befb08)
