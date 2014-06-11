<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>

<?php
// ナビゲーションバー出力
output_html_navbar();
?>

        <div class="container">
            <div class="page-header">
                <h3>貸出 貸出可能図書一覧</h3>
            </div>

<?php
// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 検索SQL作成
    // 貸し出し中のデータ
    $sql =<<<EOS
SELECT
`id`, `book_id`, `user_id`, `issued_datetime`, `return_date`, `returned_datetime`
FROM `circulations`
WHERE `returned_datetime` IS NULL
EOS;

    // 検索SQL作成
    // 貸し出し中でない図書データ
    $sql =<<<EOS
SELECT
`id`, `book_name`, `book_kana`, `author_name`, `author_kana`, `created`, `updated`
FROM `books`
WHERE `id` NOT IN (
    SELECT
    `book_id`
    FROM `circulations`
    WHERE `returned_datetime` IS NULL
    GROUP BY `book_id`
)
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
            <a href="add_form.php" class="btn btn-primary">
                <span class="glyphicon glyphicon-file"></span> 貸出データ登録フォーム
            </a>

            <div class="row">
                <div class="col-md-12">

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>図書名</th>
                            <th>図書名カナ</th>
                            <th>著者名</th>
                            <th>著者名カナ</th>
                            <th>登録日時</th>
                            <th>更新日時</th>
                        </tr>
<?php
    // SQL実行結果確認
    if($result)
    {
        $count = 0;

        // 検索結果取得
        while($row = $stmt->fetch())
        {
            $count++;

            $book_id = $row['id'];
?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $book_id; ?></td>
                            <td><?php echo $row['book_name']; ?></td>
                            <td><?php echo $row['book_kana']; ?></td>
                            <td><?php echo $row['author_name']; ?></td>
                            <td><?php echo $row['author_kana']; ?></td>
                            <td><?php echo $row['created']; ?></td>
                            <td><?php echo $row['updated']; ?></td>
                        </tr>
<?php
        }
    }
?>
                    </table>
                    <?php echo '検索結果：'.$count.'件'; ?>
                </div>
            </div>
<?php
}
?>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>
</html>
