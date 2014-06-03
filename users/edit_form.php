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
                <h3>利用者データ更新 編集画面</h3>
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
    // 検索SQL作成
    $sql =<<<EOS
SELECT `id`, `name`, `kana`, `gender`, `tel` FROM `users`
WHERE `id` = :user_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':user_id', $user_id);

    // SQL実行
    if($stmt->execute())
    {
        // 検索結果取得
        $row = $stmt->fetch();
    }
    else
    {
        $row = array();
        print_r($stmt->errorInfo());
    }
?>

            <form action="edit.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label class="col-md-2 control-label">氏名</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label">氏名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="kana" class="form-control" value="<?php echo $row['kana']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">性別</label>
                    <div class="col-md-4">
                        <input type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">電話番号</label>
                    <div class="col-md-4">
                        <input type="text" name="tel" class="form-control" value="<?php echo $row['tel']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="更新" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">利用者データ一覧</a>
                    </div>
                </div>

            </form>
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
