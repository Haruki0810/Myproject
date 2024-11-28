<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $content = $_POST['content'];

    if (!empty($username) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO posts (username, content) VALUES (:username, :content)");
        $stmt->execute([
            ':username' => $username,
            ':content' => $content
        ]);
    }
}

header('Location: index.php');
exit;
