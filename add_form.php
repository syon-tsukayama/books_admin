<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
		<h3>図書データ登録 入力画面</h3>

    <form action="add.php" method="post">
    	図書名：<input type="text" name="book_name" /><br />	
    	図書名カナ：<input type="text" name="book_kana" /><br />
    	著者名：<input type="text" name="author_name" /><br />	
    	著者名カナ：<input type="text" name="author_kana" /><br />

    	<input type="submit" value="登録" />
    	<a href="index.php">図書データ一覧</a>
    </form>

    </body>
</html>
