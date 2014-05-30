<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
    	<div class="container">
    		<h3>図書データ一覧</h3>

<?php

// データベース接続
$conn = connect_database();

if(!$conn)
{
    echo '接続失敗';
    exit;
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
    <a href="add_form.php" class="btn btn-primary">
    	<i class="glyphicon glyphicon-file"></i> 図書データ新規登録フォーム
    </a>

    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>図書名</th>
            <th>著者名</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
<?php

// 検索結果取得
while($row = $stmt->fetch()) 
{
    $book_id = $row['id'];
?>
    <tr>
        <td><?php echo $book_id; ?></td>
        <td><?php echo $row['book_name']; ?></td>
        <td><?php echo $row['author_name']; ?></td>
        <td>
            <a href="edit_form.php?book_id=<?php echo $book_id; ?>" class="btn btn-default">
            	<i class="glyphicon glyphicon-edit"></i> 編集
            </a>
        </td>
        <td>
            <a href="delete.php?book_id=<?php echo $book_id; ?>" class="btn btn-default">
            	<i class="glyphicon glyphicon-trash"></i> 削除
            </a>
        </td>
    </tr>
    <?php
}
?>
		    </table>
        </div>

        <?php
        // フッタ出力
        output_html_footer();
        ?>
    </body>
</html>
