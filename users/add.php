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
                <h3>利用者データ登録 登録処理</h3>
            </div>
<?php

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
INSERT INTO `users`
(`name`, `kana`, `gender`, `tel`, `created`, `updated`)
VALUES (:name, :kana, :gender, :tel, NOW(), NOW())
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':kana', $kana);
    $stmt->bindValue(':gender', $gender);
    $stmt->bindValue(':tel', $tel);

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

            <a href="index.php" class="btn btn-default">利用者データ一覧</a>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>

</html>
