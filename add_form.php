<!DOCTYPE html>
<html>
<?php
require_once('common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <div class="container">
            <h3>図書データ登録 入力画面</h3>

            <form action="add.php" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">図書名</label>
                    <div class="col-xs-4">
                        <input type="text" name="book_name" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">図書名カナ</label>
                    <div class="col-xs-4">
                        <input type="text" name="book_kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">著者名</label>
                    <div class="col-xs-4">
                        <input type="text" name="author_name" class="form-control " />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">著者名カナ</label>
                    <div class="col-xs-4">
                        <input type="text" name="author_kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="登録" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">図書データ一覧</a>
                    </div>
                </div>
            </form>
        </div>

        <script src="js/jquery-1.11.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
