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
                <h3>利用者データ一覧</h3>
            </div>

<?php

// データベース接続
$conn = connect_database();

// データベース接続確認
if(!is_null($conn))
{
    // 検索SQL作成
    $sql =<<<EOS
SELECT `id`, `name`, `tel` FROM `users`
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // SQL実行
    $result = $stmt->execute();

?>
            <a href="add_form.php" class="btn btn-primary">
                <span class="glyphicon glyphicon-file"></span> 利用者データ新規登録フォーム
            </a>

            <div class="row">
                <div class="col-md-12">

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>電話番号</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
<?php
    // SQL実行結果確認
    if($result)
    {
        // 検索結果取得
        while($row = $stmt->fetch())
        {
            $user_id = $row['id'];
?>
                        <tr>
                            <td><?php echo $user_id; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td>
                                <a href="edit_form.php?user_id=<?php echo $user_id; ?>" class="btn btn-default">
                                    <span class="glyphicon glyphicon-edit"></span> 編集
                                </a>
                            </td>
                            <td>
                                <a href="delete.php?user_id=<?php echo $user_id; ?>" class="btn btn-default" onclick="return confirm('削除しますよー？')">
                                    <span class="glyphicon glyphicon-trash"></span> 削除
                                </a>
                            </td>
                        </tr>
<?php
        }
    }
?>
                    </table>
                </div>
            </div>
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
