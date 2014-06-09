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
                <h3>貸出データ登録 入力画面</h3>
            </div>

            <form action="add.php" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-2 control-label">図書ID</label>
                    <div class="col-md-4">
                        <input type="text" name="book_id" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">利用者ID</label>
                    <div class="col-md-4">
                        <input type="text" name="user_id" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="登録" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">貸出データ一覧</a>
                    </div>
                </div>
            </form>
<?php
// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
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
`id`, `book_id`, `user_id`, `issued_datetime`, `return_date`, `returned_datetime`
FROM `circulations`
WHERE `book_id` NOT IN (
    SELECT
    `book_id`
    FROM `circulations`
    WHERE `returned_datetime` IS NULL
    GROUP BY `book_id`
)
EOS;

//echo $sql;

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
            <th>返却予定日</th>
            <th>返却日時</th>
            <th>貸出</th>
        </tr>
<?php
    // SQL実行結果確認
    if($result)
    {
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
        <td><?php echo $row['return_date']; ?></td>
        <td><?php echo $row['returned_datetime']; ?></td>
        <td>
            <button  type="button" id="book_id_<?php echo $row['book_id']; ?>" class="btn btn-default">
                <i class="glyphicon glyphicon-edit"></i> 貸出
                </button>
            <script type="text/javascript">
$(function()
{
    $('#book_id_<?php echo $row['book_id']; ?>').click(function()
    {
        $('input[name="book_id"]').val('<?php echo $row['book_id']; ?>');
    });
})
            </script>
        </td>
    </tr>
<?php
        }
    }
?>
            </table>
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
