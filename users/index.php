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
?>
    <!-- 検索フォーム -->
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">

            <!-- タイトル部分 -->
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">検索</a>
                </h4>
            </div>

            <!-- 入力フォーム部分 -->
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">

                    <form action="index.php" method="get" class="form-horizontal" role="form">

                        <!-- フォーム1行目 -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">氏名</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_front_name))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_front_name" value="on"<?php echo $checked; ?>>
                                    </span>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_end_name))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_end_name" value="on"<?php echo $checked; ?>>
                                    </span>
                                </div>
                            </div>
                            <label class="col-md-2 control-label">氏名（カナ）</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_front_kana))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_front_kana" value="on"<?php echo $checked; ?>>
                                    </span>
                                    <input type="text" name="kana" class="form-control" value="<?php echo $kana; ?>" />
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_end_kana))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_end_kana" value="on"<?php echo $checked; ?>>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- フォーム2行目 -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">電話番号</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_front_tel))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_front_tel" value="on"<?php echo $checked; ?>>
                                    </span>
                                    <input type="text" name="tel" class="form-control" value="<?php echo $tel; ?>" />
                                    <span class="input-group-addon">
                                        <?php
                                        if(empty($asterisk_end_tel))
                                        {
                                            $checked = '';
                                        }
                                        else
                                        {
                                            $checked = ' checked';
                                        }
                                        ?>
                                        <input type="checkbox" name="asterisk_end_tel" value="on"<?php echo $checked; ?>>
                                    </span>
                                </div>
                            </div>
                            <label class="col-md-2 control-label">性別</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>" />
                                </div>
                            </div>
                        </div>

                        <!-- フォーム3行目 -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">登録日時（開始）</label>
                            <div class="col-md-4">
                                <div class="datetimepicker input-group date">
                                    <input type="text" name="created_from" class="form-control" value="<?php echo $created_from; ?>" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <label class="col-md-2 control-label">登録日時（終了）</label>
                            <div class="col-md-4">
                                <div class="datetimepicker input-group date">
                                    <input type="text" name="created_to" class="form-control" value="<?php echo $created_to; ?>" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- フォーム4行目 -->
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <input type="submit" value="検索" class="btn btn-primary" />
                                <a href="add_form.php" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-file"></span> 利用者データ新規登録フォーム
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


<?php
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
