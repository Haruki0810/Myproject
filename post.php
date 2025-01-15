<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $breed = $_POST['breed'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // 必須項目がすべて埋まっているかチェック
    if ($title && $breed && $comment) {
        // 投稿内容をフォーマット
        $post = "タイトル: $title" . PHP_EOL;
        $post .= "犬種: $breed" . PHP_EOL;
        $post .= "コメント: $comment" . PHP_EOL;
        $post .= str_repeat('-', 30) . PHP_EOL;

        // ファイルに追記
        file_put_contents('dog.html', $post, FILE_APPEND);

        // 保存後に元のページにリダイレクト
        header('Location: dog.html');
        exit;
    } else {
        echo '全ての項目を埋めてください。';
    }
} else {
    echo '不正なアクセスです。';
}
