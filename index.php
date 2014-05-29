<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>

	<body>
<?php

echo 'test:'.date('Y-m-d');

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
else
{
	echo '接続成功';
}



?>
	</body>
</html>