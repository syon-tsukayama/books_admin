<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
<?php

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

?>
    <a href="add_form.php">図書データ新規登録フォーム</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>図書名</th>
            <th>著者名</th>
        </tr>
<?php

// 検索結果取得
while($row = $stmt->fetch()) 
{
?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['book_name'] ?></td>
        <td><?php echo $row['author_name'] ?></td>
    </tr>
    <?php
}
?>
    </table>
    </body>
</html>
