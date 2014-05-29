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

// 検索SQL作成
$sql =<<<EOS
SELECT `id`, `book_name`, `author_name` FROM `books`
EOS;

// SQL実行準備
$stmt = $conn->prepare($sql);

// SQL実行
$result = $stmt->execute();

// 検索結果取得
while($row = $stmt->fetch()) 
{
	print_r($row);
	echo '<hr />';
}

?>
	</body>
</html>