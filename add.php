<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
    	<h3>図書データ登録 登録処理</h3>
    <?php

    print_r($_POST);

    // 図書名のチェック
    if(empty($_POST['book_name']))
    {
    	echo '図書名が未入力です。';
    	exit;
    }

    // 著者名のチェック
    if(empty($_POST['author_name']))
    {
    	echo '著者名が未入力です。';
    	exit;
    }

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
	else
	{
    	echo '接続成功';
	}




    ?>


    </body>

</html>
