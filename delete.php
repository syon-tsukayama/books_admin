<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
    	<h3>図書データ削除 削除処理</h3>
    <?php

    // 図書IDチェック
    if(empty($_GET['book_id']))
    {
        echo '図書が指定されていません';
        exit;
    }

    // 入力データの半角空白削除
	$book_id = trim($_GET['book_id']);

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
DELETE FROM `books` WHERE `id` = :book_id
EOS;

	// SQL実行準備
	$stmt = $conn->prepare($sql);

	// 登録するデータを設定
	$stmt->bindValue(':book_id', $book_id);

	// SQL実行
	$result = $stmt->execute();

	if($result) 
	{
		echo '削除成功';
	}
	else
	{
		echo '削除失敗';
	}
    ?>

        <a href="index.php">図書データ一覧</a>
    </body>

</html>
