<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <div class="container">
            <div class="page-header">
                <h3>利用者データ削除 削除処理</h3>
            </div>
<?php

// 利用者IDチェック
if(empty($_GET['user_id']))
{
    echo '利用者が指定されていません';
    exit;
}

// 入力データの半角空白削除
$user_id = trim($_GET['user_id']);

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 新規登録SQL作成
    $sql =<<<EOS
DELETE FROM `users` WHERE `id` = :user_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':user_id', $user_id);

    // SQL実行
    $result = $stmt->execute();

    if($result)
    {
        echo '削除成功';
    }
    else
    {
        echo '削除失敗<br />';
        print_r($stmt->errorInfo());
    }
}
?>

            <a href="index.php" class="btn btn-default">利用者データ一覧</a>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>

</html>
