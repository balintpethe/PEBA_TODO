<?php

class TaskModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTask($user_id, $title)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, title) VALUES (:user_id, :title)");
        $stmt->execute(['user_id' => $user_id, 'title' => $title]);
    }

    public function deleteTask($task_id, $user_id)
    {
        if ($user_id) {
            $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :task_id AND user_id = :user_id");
            $stmt->execute(['task_id' => $task_id, 'user_id' => $user_id]);
        } else {
            $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :task_id");
            $stmt->execute(['task_id' => $task_id]);
        }
    }

    public function updateTask($task_id, $user_id, $title)
    {
        if ($user_id) {
            $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title WHERE id = :task_id AND user_id = :user_id");
            $stmt->execute(['title' => $title, 'task_id' => $task_id, 'user_id' => $user_id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title WHERE id = :task_id");
            $stmt->execute(['title' => $title, 'task_id' => $task_id]);
        }
    }

    public function getTasksByUserId($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTasks()
    {
        $stmt = $this->pdo->prepare("SELECT tasks.id, tasks.title, tasks.created_at, users.username 
                                 FROM tasks 
                                 LEFT JOIN users ON tasks.user_id = users.id 
                                 ORDER BY tasks.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
