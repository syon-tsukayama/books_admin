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
                <h3>貸出データ登録 入力画面</h3>
            </div>

            <form action="add.php" method="post" class="form-horizontal" role="form">

                <div class="form-group">
                    <label class="col-md-2 control-label">図書ID</label>
                    <div class="col-md-4">
                        <input type="text" name="book_id" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">利用者ID</label>
                    <div class="col-md-4">
                        <input type="text" name="user_id" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">貸出日時</label>
                    <div class="col-md-4">
                        <div class="datetimepicker input-group date">
                            <input type="text" name="issued_datetime" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">返却予定日</label>
                    <div class="col-md-4">
                        <div class="datepicker input-group date">
                            <input type="text" name="return_date" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">返却日時</label>
                    <div class="col-md-4">
                        <div class="datetimepicker input-group date">
                            <input type="text" name="returned_datetime" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="登録" class="btn btn-primary" />

                        <a href="index.php" class="btn btn-default">貸出データ一覧</a>
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
