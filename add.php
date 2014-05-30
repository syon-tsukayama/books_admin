<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
    	<h3>図書データ登録 登録処理</h3>
    <?php

    // 図書名のチェック
    if(empty($_POST['book_name']))
    {
    	echo '図書名が未入力です。';
    	exit;
    }

    // 著者名のチェック
    if(empty($_POST['author_name']))
    {
    	echo '著者名が未入力です。';
    	exit;
    }

    // 入力データの半角空白削除
	$book_name = trim($_POST['book_name']);
	$book_kana = trim($_POST['book_kana']);
	$author_name = trim($_POST['author_name']);
	$author_kana = trim($_POST['author_kana']);

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

	// 新規登録SQL作成
	$sql =<<<EOS
INSERT INTO  `books`
(`book_name`, `book_kana`, `author_name`, `author_kana`, `created`, `updated`)
VALUES (:book_name, :book_kana, :author_name, :author_kana, NOW(), NOW())
EOS;

	// SQL実行準備
	$stmt = $conn->prepare($sql);

	// 登録するデータを設定
	$stmt->bindValue(':book_name', $book_name);
	$stmt->bindValue(':book_kana', $book_kana);
	$stmt->bindValue(':author_name', $author_name);
	$stmt->bindValue(':author_kana', $author_kana);

	// SQL実行
	$result = $stmt->execute();

	if($result) 
	{
		echo '登録成功';
	}
	else
	{
		echo '登録失敗';
	}
    ?>

        <a href="index.php">図書データ一覧</a>
    </body>

</html>
