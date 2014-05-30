<?php
/**
 * 共通機能
 */

/**
 * HTMLヘッダ出力処理
 */
function output_html_header()
{
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    </head>
<?php
}

/**
 * HTMLフッタ出力処理
 */
function output_html_footer()
{
?>
        <script src="../js/jquery-1.11.1.js"></script>
        <script src="../js/bootstrap.min.js"></script>
<?php
}


/**
 * データベース接続処理
 */
function connect_database()
{
	// データベース接続情報設定
	$dsn = 'mysql:dbname=books_admin;host=localhost;charset=utf8';

	$db_username = 'root';
	$db_password = '';

	// データベース接続
	$conn = new PDO($dsn, $db_username, $db_password);

	if(!$conn)
	{
    	echo '接続失敗';
	}

	return $conn;
}


