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
                <h3>利用者データ編集 更新処理</h3>
            </div>
<?php

// 利用者IDチェック
if(empty($_POST['user_id']))
{
    echo '利用者が指定されていません';
    exit;
}

// 氏名のチェック
if(empty($_POST['name']))
{
    echo '氏名が未入力です。';
    exit;
}

// 性別チェック
if(!input_check_gender($_POST['gender']))
{
    exit;
}

// 入力データの半角空白削除
$user_id = trim($_POST['user_id']);
$name = trim($_POST['name']);
$kana = trim($_POST['kana']);
$gender = trim($_POST['gender']);
$tel = trim($_POST['tel']);

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 新規登録SQL作成
    $sql =<<<EOS
UPDATE `users`
SET
  `name` = :name,
  `kana` = :kana,
  `gender` = :gender,
  `tel` = :tel,
  `updated` = NOW()
WHERE `id` = :user_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':kana', $kana);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':tel', $tel);
    $stmt->bindValue(':user_id', $user_id);

    // SQL実行
    if($stmt->execute())
    {
?>
            <div class="alert alert-success">
                <strong>更新成功</strong>
                #<?php echo $user_id; ?>
            </div>
<?php
    }
    else
    {
?>
            <div class="alert alert-danger">
                <strong>更新失敗</strong>
                #<?php echo $user_id; ?>
                <?php echo $stmt->errorInfo(); ?>
            </div>
<?php
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
