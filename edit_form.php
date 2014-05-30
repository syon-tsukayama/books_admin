<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
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
            exit;
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

            <form action="edit.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label class="col-sm-2 control-label">図書名</label>
                    <div class="col-xs-4">
                        <input type="text" name="book_name" class="form-control" value="<?php echo $row['book_name']; ?>" />
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">図書名カナ</label>
                    <div class="col-xs-4">
                        <input type="text" name="book_kana" class="form-control" value="<?php echo $row['book_kana']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">著者名</label>
                    <div class="col-xs-4">
                        <input type="text" name="author_name" class="form-control" value="<?php echo $row['author_name']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">著者名カナ</label>
                    <div class="col-xs-4">
                        <input type="text" name="author_kana" class="form-control" value="<?php echo $row['author_kana']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="更新" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">図書データ一覧</a>
                    </div>
                </div>

            </form>
        </div>

        <script src="js/jquery-1.11.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
