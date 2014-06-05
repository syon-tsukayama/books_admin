<?php
/**
 * 共通機能
 */

// システムの共通URL設定
$_base_url = 'localhost/books_admin';

// 各機能のディレクトリ名
$_url_dirs = array(
    'books' => '図書データ管理',
    'users' => '利用者データ管理'
    );

// 性別チェックのための設定
$_genders = array('男', '女');

/**
 * HTMLヘッダ出力処理
 */
function output_html_header()
{
    global $_base_url;
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="http://<?php echo $_base_url; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://<?php echo $_base_url; ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <style type="text/css">
body
{
    padding-top: 50px;
}
        </style>
        <script type="text/javascript" src="http://<?php echo $_base_url; ?>/js/jquery-1.11.1.js"></script>
    </head>
<?php
}


/**
 * HTMLフッタ出力処理
 */
function output_html_footer()
{
    global $_base_url;
?>
        <script type="text/javascript" src="http://<?php echo $_base_url; ?>/js/moment-with-langs.js"></script>
        <script type="text/javascript" src="http://<?php echo $_base_url; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://<?php echo $_base_url; ?>/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
$(function()
{
    // datetimepicker使用設定
    // class属性にdatetimepickerが指定されているHTMLタグについて
    // datetimepicker機能を利用できるよう設定する
    $('.datetimepicker').datetimepicker(
    {
        language: 'ja',
        format: 'YYYY-MM-DD HH:mm',
        useSeconds: false
    }
    );
});
        </script>
<?php
}


/**
 * ナビゲーションバー出力処理
 */
function output_html_navbar()
{
    global $_base_url;
    global $_url_dirs;

    // 実行中のphpプログラム取得
    // $_SERVER['SCRIPT_NAME']: phpファイル名
    // script_dir: phpファイルがあるディレクトリ名
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">図書貸出管理システム</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
<?php
    foreach($_url_dirs as $dir_name => $title)
    {
        // 実行中のphpプログラムのURLとディレクトリ名比較
        // 一致する場合は、<li>タグにclass="active"を設定
        if(preg_match('/'.$dir_name.'$/', $script_dir))
        {
            $class_active = ' class="active"';
        }
        else
        {
            $class_active = '';
        }
?>
                        <li<?php echo $class_active; ?>>
                            <a href="http://<?php echo $_base_url.'/'.$dir_name; ?>"><?php echo $title; ?></a>
                        </li>
<?php
    }
?>
                    </ul>
                </div>
            </div>
        </nav>
<?php
}


/**
 * データベース接続処理
 */
function connect_database()
{
    // データベース接続情報設定
    $dsn = 'mysql:dbname=books_admin;host=localhost;charset=utf8';

    $db_username = 'root';
    $db_password = '';

    // データベース接続失敗時に「例外」が発生するので、
    // 「例外」発生時にエラーメッセージを表示する
    try
    {
        // データベース接続
        $conn = new PDO($dsn, $db_username, $db_password);

        if($conn == null)
        {
?>
            <div class="alert alert-danger">
                <strong>接続失敗</strong>
            </div>
<?php
        }
    }
    catch(PDOException $e)
    {
        // エラーメッセージ表示
?>
            <div class="alert alert-danger">
                <strong>接続失敗</strong>
                <?php echo $e->getMessage(); ?>
            </div>
<?php
    }

    return $conn;
}


/**
 * 入力チェック_性別
 *
 * @param string
 *
 * @return bool
 */
function input_check_gender($value)
{
    global $_genders;

    if(empty($value) || in_array($value, $_genders))
    {
        // 未入力 or 性別チェックの配列に含まれる値の場合、問題なしとする。
        // 未入力をさせたくない場合は、別途、empty()のチェックを追記する。
        $return_value = true;
    }
    else
    {
        // エラーメッセージ表示
        $return_value = false;
?>
            <div class="alert alert-warning">
                <strong>なぞの性別です。</strong>
                <?php echo $value; ?>
            </div>
<?php
    }

    return $return_value;
}

