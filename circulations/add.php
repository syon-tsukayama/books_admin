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

// 入力データの半角空白削除
$book_id = trim($_POST['book_id']);
$user_id = trim($_POST['user_id']);

// 貸出日時設定
$issued_datetime = date('Y-m-d H:i:s');
// 返却予定日設定
$return_date = date('Y-m-d', strtotime('+10 days'));

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 新規登録SQL作成
    $sql =<<<EOS
INSERT INTO  `circulations`
(`book_id`, `user_id`, `issued_datetime`, `return_date`, `created`, `updated`)
VALUES (:book_id, :user_id, :issued_datetime, :return_date, NOW(), NOW())
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':book_id', $book_id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':issued_datetime', $issued_datetime);
    $stmt->bindValue(':return_date', $return_date);

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
                <?php echo $stmt->errorInfo(); ?>
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
