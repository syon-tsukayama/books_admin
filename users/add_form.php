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
                <h3>利用者データ登録 入力画面</h3>
            </div>

            <form action="add.php" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-2 control-label">氏名</label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">氏名カナ</label>
                    <div class="col-md-4">
                        <input type="text" name="kana" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">性別</label>
                    <div class="col-md-4">
<?php
if(is_array($_genders))
{
    foreach($_genders as $gender)
    {
?>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="<?php echo $gender; ?>">
                                <?php echo $gender; ?>
                            </label>
                        </div>
<?php
    }
}
?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">電話番号</label>
                    <div class="col-md-4">
                        <input type="text" name="tel" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
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
