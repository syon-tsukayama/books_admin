<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <h3>利用者データ登録 登録処理</h3>
    <?php

    // 図書名のチェック
    if(empty($_POST['name']))
    {
        echo '氏名が未入力です。';
        exit;
    }

    // 性別チェック
    $genders = array('男', '女');
    if(!empty($_POST['gender']) && !in_array($_POST['gender'], $genders))
    {
        echo 'なぞの性別です。';
        exit;
    }

    // 入力データの半角空白削除
    $name = trim($_POST['name']);
    $kana = trim($_POST['kana']);
    $gender = trim($_POST['gender']);
    $tel = trim($_POST['tel']);

    // データベース接続
    $conn = connect_database();

    if(!$conn)
    {
        echo '接続失敗';
    }

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
    $result = $stmt->execute();

    if($result)
    {
        echo '登録成功';
    }
    else
    {
        echo '登録失敗';
    }
    ?>

        <a href="index.php" class="btn btn-default">利用者データ一覧</a>

        <?php
        // フッタ出力
        output_html_footer();
        ?>
    </body>

</html>
