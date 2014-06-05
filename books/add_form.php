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
                <h3>図書データ登録 入力画面</h3>
            </div>

            <form action="add.php" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-2 control-label">図書名</label>
                    <div class="col-md-4">
                        <input type="text" name="book_name" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">図書名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="book_kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">著者名</label>
                    <div class="col-md-4">
                        <input type="text" name="author_name" class="form-control " />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">著者名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="author_kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="登録" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">図書データ一覧</a>
                    </div>
                </div>
            </form>
        </div>

<?php
// フッタ出力
output_html_footer();
?>
    </body>
</html>
