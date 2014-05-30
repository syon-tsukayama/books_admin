<?php
/**
 * 共通機能
 */

/**
 * HTMLヘッダ出力処理
 */
function output_html_header()
{
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    </head>
<?php
}

/**
 * HTMLフッタ出力処理
 */
function output_html_footer()
{
?>
        <script src="../js/jquery-1.11.1.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
$(function()
{
    $.extend($.fn.datetimepicker.dates , {
        ja: {
            days: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日'],
            daysShort: ['日', '月', '火', '水', '木', '金', '土', '日'],
            daysMin: ['日', '月', '火', '水', '木', '金', '土', '日'],
            months: ['1月', '2月', '3月', '4月', '5月', '6月','7月', '8月', '9月', '10月', '11月', '12月'],
            monthsShort: ['1月', '2月', '3月', '4月', '5月', '6月','7月', '8月', '9月', '10月', '11月', '12月']
        }
    });

    $('.datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm',
        language: 'ja',
        pickSeconds: false
    });
});
        </script>
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

    // データベース接続
    $conn = new PDO($dsn, $db_username, $db_password);

    if(!$conn)
    {
        echo '接続失敗';
    }

    return $conn;
}


