<?php
set_include_path(__DIR__ . '/../');
require 'vendor/autoload.php';
require 'src/database.php'; // データベース接続関数の読み込み
require 'src/MessageController.php';
require 'src/MessageModel.php';

// アプリはここから開始
try {
    // データベース接続
    $config = include __DIR__ . '/../config/config.php';
    $pdo = createPDO($config);

    // Modelの生成
    $messageModel = new MessageModel($pdo);

    // Controllerの生成
    $controller = new MessageController($messageModel);

    // リクエストの処理
    $controller->handleRequest();
} catch (Exception $e) {
    error_log("Exception caught: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    http_response_code(500);
    echo "Internal Server Error. Please try again later.";
}define( 'FILENAME', './message.txt');

// タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

if( !empty($_POST['btn_submit']) ) {
	
	if( $file_handle = fopen( FILENAME, "a") ) {

	    // 書き込み日時を取得
		$current_date = date("Y-m-d H:i:s");
	
		// 書き込むデータを作成
		$data = "'".$_POST['view_name']."','".$_POST['message']."','".$current_date."'\n";
	
		// 書き込み
		fwrite( $file_handle, $data);
	
		// ファイルを閉じる
		fclose( $file_handle);
	}		
}
?>
