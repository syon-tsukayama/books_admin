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
                <h3>貸出データ登録 登録処理</h3>
            </div>
<?php

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
    // 新規登録SQL作成
    $sql =<<<EOS
INSERT INTO  `circulations`
(`book_id`, `user_id`, `issued_datetime`, `return_date`, `returned_datetime`, `created`, `updated`)
VALUES (:book_id, :user_id, :issued_datetime, :return_date, :returned_datetime, NOW(), NOW())
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
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
                <strong>登録成功</strong>
                #<?php echo $conn->lastInsertId(); ?>
            </div>
<?php
    }
    else
    {
?>
            <div class="alert alert-danger">
                <strong>登録失敗</strong>
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
