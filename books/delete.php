<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <h3>図書データ削除 削除処理</h3>
    <?php

    // 図書IDチェック
    if(empty($_GET['book_id']))
    {
        echo '図書が指定されていません';
        exit;
    }

    // 入力データの半角空白削除
    $book_id = trim($_GET['book_id']);

    // データベース接続
    $conn = connect_database();

    if(!$conn)
    {
        echo '接続失敗';
    }

    // 新規登録SQL作成
    $sql =<<<EOS
DELETE FROM `books` WHERE `id` = :book_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':book_id', $book_id);

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
    ?>

        <a href="index.php" class="btn btn-default">図書データ一覧</a>

<?php
// フッタ出力
output_html_footer();
?>
    </body>

</html>
