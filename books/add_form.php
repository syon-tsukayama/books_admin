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
                    <label class="col-md-2 control-label">ISBN</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="isbn" class="form-control" id="input_isbn" />
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
