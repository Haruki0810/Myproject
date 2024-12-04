<?php
require_once 'db.php'; // データベース接続ファイル

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $breed = $_POST['breed'] ?? '';
    $comment = $_POST['comment'] ?? '';

    if (empty($title) || empty($breed) || empty($comment)) {
        http_response_code(400);
        echo 'すべての項目を入力してください。';
        exit;
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO posts (title, breed, comment, created_at) VALUES (:title, :breed, :comment, NOW())');
        $stmt->execute([
            ':title' => $title,
            ':breed' => $breed,
            ':comment' => $comment,
        ]);

        // 新しい投稿のHTMLを生成
        $newPostHTML = "<div class='post'>
            <h3>" . htmlspecialchars($title) . "</h3>
            <p><strong>犬種:</strong> " . htmlspecialchars($breed) . "</p>
            <p>" . nl2br(htmlspecialchars($comment)) . "</p>
            <p class='date'>" . date('Y-m-d H:i:s') . "</p>
        </div>";

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'newPost' => $newPostHTML]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'エラーが発生しました: ' . $e->getMessage();
    }
}