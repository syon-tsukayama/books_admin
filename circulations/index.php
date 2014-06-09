<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <div class="container">
            <h3>貸出データ一覧</h3>

<?php
// データベース接続
$conn = connect_database();

if(!$conn)
{
    echo '接続失敗';
    exit;
}

// 図書データ取得
$sql =<<<EOS
SELECT `id`, `book_name` FROM `books`
EOS;

// SQL実行準備
$stmt = $conn->prepare($sql);
// SQL実行
$result = $stmt->execute();

$book_names = array();
// 検索結果取得
while($row = $stmt->fetch())
{
	$book_names[$row['id']] = $row['book_name'];
}

// 利用者データ取得
$sql =<<<EOS
SELECT `id`, `name` FROM `users`
EOS;

// SQL実行準備
$stmt = $conn->prepare($sql);
// SQL実行
$result = $stmt->execute();

$user_names = array();
// 検索結果取得
while($row = $stmt->fetch())
{
	$user_names[$row['id']] = $row['name'];
}

// 検索SQL作成
$sql =<<<EOS
SELECT
`id`, `book_id`, `user_id`, `issued_datetime`
FROM `circulations`
EOS;

/*
 * LEFT JOIN を利用したSQL サンプル
SELECT
`circulations`.`id`,
`book_id`, `user_id`,
`issued_datetime`, `books`.`book_name`,
`users`.`name`
FROM `circulations`
LEFT JOIN `books`
ON `books`.`id` = `circulations`.`book_id`
LEFT JOIN `users`
ON `users`.`id` = `circulations`.`user_id`
 */

// SQL実行準備
$stmt = $conn->prepare($sql);

// SQL実行
$result = $stmt->execute();

?>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>図書ID</th>
            <th>図書名</th>
            <th>利用者ID</th>
            <th>利用者氏名</th>
            <th>貸出日時</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
<?php
// 検索結果取得
while($row = $stmt->fetch())
{
    $circulation_id = $row['id'];
?>
    <tr>
        <td><?php echo $circulation_id; ?></td>
        <td><?php echo $row['book_id']; ?></td>
        <td>
        <?php
        if(array_key_exists($row['book_id'], $book_names))
        {
        	echo $book_names[$row['book_id']];
        }
        ?>
        </td>
        <td><?php echo $row['user_id']; ?></td>
        <td>
        <?php
        if(array_key_exists($row['user_id'], $user_names))
        {
        	echo $user_names[$row['user_id']];
        }
        ?>
        </td>
        <td><?php echo $row['issued_datetime']; ?></td>
        <td>
            <a href="edit_form.php?circulation_id=<?php echo $circulation_id; ?>" class="btn btn-default">
                <i class="glyphicon glyphicon-edit"></i> 編集
            </a>
        </td>
        <td>
            <a href="delete.php?circulation_id=<?php echo $circulation_id; ?>" class="btn btn-default" onclick="if(confirm('削除しますよー？')){return true;} return false;">
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
