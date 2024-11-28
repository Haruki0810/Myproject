<?php
require 'db.php';

// 投稿データを取得
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// HTMLテンプレートにデータを渡す
require 'template.php';
