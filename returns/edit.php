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
                <h3>貸出データ編集 返却処理</h3>
            </div>
<?php

// 貸出IDチェック
if(empty($_POST['circulation_id']))
{
    echo '貸出データが指定されていません';
    exit;
}

// 入力データの半角空白削除
$circulation_id = trim($_POST['circulation_id']);

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 返却日時登録するSQL作成
    $sql =<<<EOS
UPDATE `circulations`
SET
  `returned_datetime` = NOW(),
  `updated` = NOW()
WHERE `id` = :circulation_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':circulation_id', $circulation_id);

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
                <?php echo $stmt->errorInfo(); ?>
            </div>
<?php
    }
}
?>

            <a href="index.php" class="btn btn-default">図書データ一覧</a>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>

</html>
