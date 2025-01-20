<?php

class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($username, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $password]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function updateUser($id, $username = null, $role = null, $password = null)
    {
        $query = "UPDATE users SET ";
        $params = [];

        if ($username !== null) {
            $query .= "username = :username, ";
            $params[':username'] = $username;
        }
        if ($role !== null) {
            $query .= "role = :role, ";
            $params[':role'] = $role;
        }
        if ($password !== null) {
            $query .= "password = :password, ";
            $params[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $query = rtrim($query, ", ") . " WHERE id = :id";
        $params[':id'] = $id;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
