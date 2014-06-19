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
                <h3>貸出データ更新 編集画面</h3>
            </div>

<?php

// 貸出IDチェック
if(empty($_GET['circulation_id']))
{
    echo '貸出IDが指定されていません';
    exit;
}

// 入力データの半角空白削除
$circulation_id = trim($_GET['circulation_id']);

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 検索SQL作成
    $sql =<<<EOS
SELECT `id`, `book_id`, `user_id`, `issued_datetime`, `return_date`
FROM `circulations`
WHERE `id` = :circulation_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':circulation_id', $circulation_id);

    // SQL実行
    if($stmt->execute())
    {
        // 検索結果取得
        $row = $stmt->fetch();

        if(empty($row))
        {
?>
            <div class="alert alert-danger">
                <strong>検索失敗</strong>
                #<?php echo $circulation_id; ?>は存在しません。
            </div>
<?php
        }
        else
        {
?>
            <form action="edit.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="circulation_id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label class="col-md-2 control-label">図書ID</label>
                    <div class="col-md-4">
                        <input type="text" name="book_id" class="form-control" value="<?php echo $row['book_id']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">利用者ID</label>
                    <div class="col-md-4">
                        <input type="text" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">貸出日時</label>
                    <div class="col-md-4">
                        <input type="text" name="issued_datetime" class="form-control" value="<?php echo $row['issued_datetime']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">返却予定日</label>
                    <div class="col-md-4">
                        <input type="text" name="return_date" class="form-control" value="<?php echo $row['return_date']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="返却" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">貸出データ一覧</a>
                    </div>
                </div>

            </form>
<?php
        }
    }
    else
    {
?>
            <div class="alert alert-danger">
                <strong>検索失敗</strong>
                #<?php echo $circulation_id; ?>
                <?php print_r($stmt->errorInfo()); ?>
            </div>
<?php
    }
}
?>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>
</html>
