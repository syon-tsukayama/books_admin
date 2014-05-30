<!DOCTYPE html>
<html>
<?php
require_once('../common.php');
// ヘッダ出力
output_html_header();
?>

    <body>
        <div class="container">
            <h3>利用者データ登録 入力画面</h3>

            <form action="add.php" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">氏名</label>
                    <div class="col-xs-4">
                        <input type="text" name="name" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">氏名カナ</label>
                    <div class="col-xs-4">
                        <input type="text" name="kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">性別</label>
                    <div class="col-xs-4">
                        <input type="text" name="gender" class="form-control " />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">電話番号</label>
                    <div class="col-xs-4">
                        <input type="text" name="tel" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="登録" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">利用者データ一覧</a>
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
