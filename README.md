books_admin：簡易図書貸出管理システム
===========

## はじめに

簡易図書貸出管理システムを作成することで、以下の技術の学習を目的とします。

1. PHP
2. HTML
3. SQL

## ディレクトリ構成

```
books/          # 図書データ管理機能
circulations/   # 貸出データ管理機能
css/            # 外部CSSファイル置き場
doc/            # プログラム以外の文書など置き場
fonts/          # フォント？置き場
js/             # 外部javascriptファイル置き場
users/          # 利用者データ管理機能
README.md       # このファイル
common.php      # 共通機能
```

## 使用設定

1. ソースコードをダウンロードします。
2. データベースを作成し、~/doc/books_admin.sqlを実行してテーブルを作成します。
3. common.phpの設定を変更します。
 * $_base_url: 設置場所によって変わります。
 * $db_username: データベース接続に使用するユーザ名
 * $db_password: データベース接続に使用するパスワード


## 使用ライブラリ

- [Eonasdan/bootstrap-datetimepicker](https://github.com/Eonasdan/bootstrap-datetimepicker)
- [jQuery](http://jquery.com/)
- [Moment.js](http://momentjs.com/)
- [Twitter Bootstrap](http://getbootstrap.com/)
