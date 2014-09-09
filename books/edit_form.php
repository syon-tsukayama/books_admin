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
                <h3>図書データ更新 編集画面</h3>
            </div>

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

// データベース接続確認
if(!is_null($conn))
{
    // 検索SQL作成
    $sql =<<<EOS
SELECT `id`, `book_name`, `book_kana`, `author_name`, `author_kana`, `isbn` FROM `books`
WHERE `id` = :book_id
EOS;

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // 登録するデータを設定
    $stmt->bindValue(':book_id', $book_id);

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
                #<?php echo $book_id; ?>は存在しません。
            </div>
<?php
        }
        else
        {
?>
            <form action="edit.php" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>" />

                <div class="form-group">
                    <label class="col-md-2 control-label">ISBN</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="isbn" class="form-control" id="input_isbn" value="<?php echo $row['isbn']; ?>" />
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" id="btn_search_isbn">検索</button>
                                <script>
$(function()
{
    $('#btn_search_isbn').click(function()
    {
        if($('#input_isbn').val() != '')
        {
            $.ajax(
            {
                url: 'http://<?php echo $_base_url; ?>/shells/get_rss.php?isbn=' + $('#input_isbn').val()
            }
            ).done(function(data)
            {
                var input_isbn = $('#input_isbn').val();
                var obj = jQuery.parseJSON(data);

                $('input[name="book_name"]').val(obj[input_isbn].title);
                $('input[name="author_name"]').val(obj[input_isbn].author);
            }
            );
        }
    });
});
                                </script>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">図書名</label>
                    <div class="col-md-4">
                        <input type="text" name="book_name" class="form-control" value="<?php echo $row['book_name']; ?>" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label">図書名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="book_kana" class="form-control" value="<?php echo $row['book_kana']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">著者名</label>
                    <div class="col-md-4">
                        <input type="text" name="author_name" class="form-control" value="<?php echo $row['author_name']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">著者名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="author_kana" class="form-control" value="<?php echo $row['author_kana']; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="更新" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">図書データ一覧</a>
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
                #<?php echo $book_id; ?>
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
