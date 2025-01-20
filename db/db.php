<?php
$host = 'localhost';
$dbname = 'todo_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Kapcsolódva az adatbázishoz!";
} catch (PDOException $e) {
    echo "Hiba történt a kapcsolat létrehozásakor: " . $e->getMessage();
    die();
}

return $pdo;
