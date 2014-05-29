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
    

    ?>


    </body>

</html>
