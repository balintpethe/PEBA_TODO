<?php

require_once '../models/TaskModel.php';
class TaskController
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../public/login");
            exit;
        }

        $user_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_GET['action']) && $_GET['action'] === 'updatetask') {
                $this->updateTask($user_id);
            }
            elseif (isset($_GET['action']) && $_GET['action'] === 'createtask') {
                $this->createTask($user_id);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
            $this->deleteTask($user_id);
        }

        $this->listTasks($user_id);
    }

    private function createTask($user_id)
    {
        $title = $_POST['title'];
        $task = new TaskModel($this->pdo);
        $task->createTask($user_id, $title);
        header("Location: ../public/tasks");
        exit;
    }

    private function updateTask($user_id)
    {
        $task_id = $_POST['id'];
        $title = $_POST['title'];
        $task = new TaskModel($this->pdo);
        $task->updateTask($task_id, isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? null : $user_id, $title);
        $redirectUrl = isset($_GET['redirect']) ? $_GET['redirect'] : '../public/tasks';
        header("Location: $redirectUrl");
        exit;
    }

    private function deleteTask($user_id)
    {
        $task_id = $_GET['id'];
        $task = new TaskModel($this->pdo);
        $task->deleteTask($task_id, isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? null : $user_id);
        $redirectUrl = isset($_GET['redirect']) ? $_GET['redirect'] : '../public/tasks';
        header("Location: $redirectUrl");
        exit;
    }

    public function listTasks($user_id)
    {
        $taskModel = new TaskModel($this->pdo);
        $tasks = $taskModel->getTasksByUserId($user_id);
        $_SESSION['tasks'] = $tasks;
        require_once '../views/tasks.php';
        exit;
    }

    public function listAllTasks()
    {
        header("Location: ../public/admin");
        exit;
    }
}
