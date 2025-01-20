<?php

require_once '../models/UserModel.php';
class UserController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_GET['action'] ?? '';
            try {
                $this->$action();
            }
            catch (Exception $e) {
                echo "Hiba: " . $e->getMessage();
                exit;
            }
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $action = $_GET['action'] ?? '';
            try {
                $this->$action();
            }
            catch (Exception $e) {
                echo "Hiba: " . $e->getMessage();
                exit;
            }
        }
    }

    private function register()
    {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        try {
            $user = new UserModel($this->pdo);
            $user->createUser($username, $password);
            header("Location: ../views/login.php");
        } catch (PDOException $e) {
            echo "Hiba: A felhasználónév már foglalt!";
            header("Location: ../public/register");
        }
    }

    private function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new UserModel($this->pdo);
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../public/tasks");
            exit;
        } else {
            echo "Hibás felhasználónév vagy jelszó!";
        }
    }

    private function checkAdmin()
    {
        session_start();
        $response = ['isAdmin' => false];
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $response['isAdmin'] = true;
            header("Location: ../public/admin");
        }
        echo json_encode($response);
        exit;
    }

    public function showAdminPanel()
    {
        $userModel = new UserModel($this->pdo);
        $users = $userModel->getAllUsers();

        $taskModel = new TaskModel($this->pdo);
        $tasks = $taskModel->getAllTasks();

        require_once '../views/admin.php';
        exit;
    }

    private function deleteUser()
    {
        $id = $_GET['id'];
        $userModel = new UserModel($this->pdo);
        $userModel->deleteUser($id);
        header("Location: ../public/admin");
        exit;
    }

    public function updateUser()
    {
        $id = $_POST['id'];
        $username = !empty($_POST['username']) ? $_POST['username'] : null;
        $role = !empty($_POST['role']) ? $_POST['role'] : null;
        $password = !empty($_POST['password']) ? $_POST['password'] : null;

        $userModel = new UserModel($this->pdo);
        $userModel->updateUser($id, $username, $role, $password);

        header("Location: ../public/admin");
        exit;
    }

    private function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../public/login");
        exit;
    }
}

