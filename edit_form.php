<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
		<h3>図書データ更新 編集画面</h3>

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

        // 検索SQL作成
        $sql =<<<EOS
SELECT `id`, `book_name`, `book_kana`, `author_name`, `author_kana` FROM `books`
WHERE `id` = :book_id
EOS;

        // SQL実行準備
        $stmt = $conn->prepare($sql);

        // 登録するデータを設定
        $stmt->bindValue(':book_id', $book_id);

        // SQL実行
        if($stmt->execute())
        {
            // 検索結果取得
            $row = $stmt->fetch();
        }
        else
        {
            $row = array();
        }
        ?>

    <form action="add.php" method="post">
        <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
    	図書名：<input type="text" name="book_name" value="<?php echo $row['book_name']; ?>" /><br />	
    	図書名カナ：<input type="text" name="book_kana" value="<?php echo $row['book_kana']; ?>" /><br />
    	著者名：<input type="text" name="author_name" value="<?php echo $row['author_name']; ?>" /><br />	
    	著者名カナ：<input type="text" name="author_kana" value="<?php echo $row['author_kana']; ?>" /><br />

    	<input type="submit" value="更新" />
    	<a href="index.php">図書データ一覧</a>
    </form>

    </body>
</html>
