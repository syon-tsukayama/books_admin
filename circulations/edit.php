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
                <h3>貸出データ更新 更新処理</h3>
            </div>
<?php

// 貸出IDチェック
if(empty($_POST['circulation_id']))
{
    echo '貸出データが指定されていません';
    exit;
}

// 図書のチェック
if(empty($_POST['book_id']))
{
    echo '図書IDが未入力です。';
    exit;
}

// 利用者のチェック
if(empty($_POST['user_id']))
{
    echo '利用者IDが未入力です。';
    exit;
}

// 貸出日時のチェック
if(empty($_POST['issued_datetime']))
{
    echo '貸出日時が未入力です。';
    exit;
}

// 返却予定日のチェック
if(empty($_POST['return_date']))
{
    echo '返却予定日が未入力です。';
    exit;
}

// 入力データの半角空白削除
$circulation_id = trim($_POST['circulation_id']);
$book_id = trim($_POST['book_id']);
$user_id = trim($_POST['user_id']);
$issued_datetime = trim($_POST['issued_datetime']);
$return_date = trim($_POST['return_date']);
$returned_datetime = trim($_POST['returned_datetime']);

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 返却日時登録するSQL作成
    $sql =<<<EOS
UPDATE `circulations`
SET
  `book_id` = :book_id,
  `user_id` = :user_id,
  `issued_datetime` = :issued_datetime,
  `return_date` = :return_date,
  `returned_datetime` = :returned_datetime,
  `updated` = NOW()
WHERE `id` = :circulation_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':circulation_id', $circulation_id);
    $stmt->bindValue(':book_id', $book_id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':issued_datetime', $issued_datetime);
    $stmt->bindValue(':return_date', $return_date);

    if(empty($returned_datetime))
    {
        // datetime型なので、入力値が空の場合、NULLを設定
        $stmt->bindValue(':returned_datetime', null);
    }
    else
    {
        $stmt->bindValue(':returned_datetime', $returned_datetime);
    }

    // SQL実行
    if($stmt->execute())
    {
?>
            <div class="alert alert-success">
                <strong>更新成功</strong>
                #<?php echo $circulation_id; ?>
            </div>
<?php
    }
    else
    {
?>
            <div class="alert alert-danger">
                <strong>更新失敗</strong>
                #<?php echo $circulation_id; ?>
                <?php print_r($stmt->errorInfo()); ?>
            </div>
<?php
    }
}
?>

            <a href="index.php" class="btn btn-default">貸出データ一覧</a>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>

</html>
