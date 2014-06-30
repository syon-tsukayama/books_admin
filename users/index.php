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
    // 検索条件有無フラグ
    $is_search_option = false;

    // 検索条件取得
    if(isset($_GET['name']))
    {
        $name = trim($_GET['name']);
        $is_search_option = true;
    }
    else
    {
        $book_name = '';
    }
    if(isset($_GET['asterisk_front_name']))
    {
        $asterisk_front_name = trim($_GET['asterisk_front_name']);
    }
    else
    {
        $asterisk_front_name = '';
    }
    if(isset($_GET['asterisk_end_name']))
    {
        $asterisk_end_name = trim($_GET['asterisk_end_name']);
    }
    else
    {
        $asterisk_end_name = '';
    }

    if(isset($_GET['kana']))
    {
        $kana = trim($_GET['kana']);
        $is_search_option = true;
    }
    else
    {
        $kana = '';
    }
    if(isset($_GET['asterisk_front_kana']))
    {
        $asterisk_front_kana = trim($_GET['asterisk_front_kana']);
    }
    else
    {
        $asterisk_front_kana = '';
    }
    if(isset($_GET['asterisk_end_kana']))
    {
        $asterisk_end_kana = trim($_GET['asterisk_end_kana']);
    }
    else
    {
        $asterisk_end_kana = '';
    }

    if(isset($_GET['tel']))
    {
        $tel = trim($_GET['tel']);
        $is_search_option = true;
    }
    else
    {
        $tel = '';
    }
    if(isset($_GET['asterisk_front_tel']))
    {
        $asterisk_front_tel = trim($_GET['asterisk_front_tel']);
    }
    else
    {
        $asterisk_front_tel = '';
    }
    if(isset($_GET['asterisk_end_tel']))
    {
        $asterisk_end_tel = trim($_GET['asterisk_end_tel']);
    }
    else
    {
        $asterisk_end_tel = '';
    }

    if(isset($_GET['gender']))
    {
        $gender = trim($_GET['gender']);
        $is_search_option = true;
    }
    else
    {
        $gender = '';
    }

    if(isset($_GET['created_from']))
    {
        $created_from = trim($_GET['created_from']);
        $is_search_option = true;
    }
    else
    {
        $created_from = '';
    }

    if(isset($_GET['created_to']))
    {
        $created_to = trim($_GET['created_to']);
        $is_search_option = true;
    }
    else
    {
        $created_to = '';
    }

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
SELECT `id`, `name`, `kana`, `gender`, `tel`, `created`, `updated` FROM `users`
EOS;

    // SQL条件句作成
    if($is_search_option)
    {
        $wheres = array();

        if(!empty($name))
        {
            $wheres[] = '`name` LIKE :name';
        }

        if(!empty($kana))
        {
            $wheres[] = '`kana` LIKE :kana';
        }

        if(!empty($tel))
        {
            $wheres[] = '`tel` LIKE :tel';
        }

        if(!empty($gender))
        {
            $wheres[] = '`gender` = :gender';
        }

        if(!empty($created_from))
        {
            $wheres[] = '`created` >= :created_from';
        }

        if(!empty($created_to))
        {
            $wheres[] = '`created` <= :created_to';
        }

        if(!empty($wheres))
        {
            $sql .= ' WHERE '.implode(' AND ', $wheres);
        }
    }

    // SQL実行準備
    $stmt = $conn->prepare($sql);

    // SQL条件値設定
    if($is_search_option)
    {
        if(!empty($name))
        {
            if(!empty($asterisk_front_name))
            {
                $name = '%'.$name;
            }
            if(!empty($asterisk_end_name))
            {
                $name = $name.'%';
            }
            $stmt->bindValue(':name', $name);
        }

        if(!empty($kana))
        {
            if(!empty($asterisk_front_kana))
            {
                $kana = '%'.$kana;
            }
            if(!empty($asterisk_end_kana))
            {
                $kana = $kana.'%';
            }
            $stmt->bindValue(':kana', $kana);
        }

        if(!empty($tel))
        {
            if(!empty($asterisk_front_tel))
            {
                $tel = '%'.$tel;
            }
            if(!empty($asterisk_end_tel))
            {
                $tel = $tel.'%';
            }
            $stmt->bindValue(':tel', $tel);
        }

        if(!empty($gender))
        {
            $stmt->bindValue(':gender', $gender);
        }

        if(!empty($created_from))
        {
            $stmt->bindValue(':created_from', $created_from);
        }

        if(!empty($created_to))
        {
            $stmt->bindValue(':created_to', $created_to);
        }
    }

    // SQL実行
    $result = $stmt->execute();

?>

            <div class="row">
                <div class="col-md-12">

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>カナ</th>
                            <th>性別</th>
                            <th>電話番号</th>
                            <th>登録日時</th>
                            <th>更新日時</th>
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
                            <td><?php echo $row['kana']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['created']; ?></td>
                            <td><?php echo $row['updated']; ?></td>
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
