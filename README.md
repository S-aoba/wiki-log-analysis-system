# wiki-log-analysis-system

## 概要

本アプリは、[独学エンジニア](https://dokugaku-engineer.com/, "独学エンジニアHome")のレッスン43の課題となるアプリとなります。

wikipediaから公開されているページアクセスログを解析し、分析した結果を返すアプリとなります。PHP,PDO,DB,SQLを学ぶために作成しました。

## 使用した技術
| 項目 | 内容 |
| --- | --- |
| Backend | PHP8 |
| Test | PHPUnit (後ほど実装) |
| Coding Style | PHPCodeSniffer (後ほど実装) |
| Static Analysis | PHPStan (後ほど実装) |
| DB | Mysql |
| Database Access Layer | PHP PDO |

## 事前準備
1. 以下のWikipediaアクセスログデータダウンロードURLをクリックしてからお好きな日付のデータをご自身のローカルPCへダウンロードしてください。
- https://dumps.wikimedia.org/other/pageviews

2. ダウンロードしたファイルを/app/databasesディレクトリにpage_viewというファイル名に変更して保存をしてください。
- /app/databases/page_view

## 使用方法
事前準備が完了しましたら、ここからDocerを立ち上げてアプリを実行します。
以下のコマンドをご使用のターミナルに打ち込んでください。

> [!WARNING]
> コマンドを打つ前にwiki_log_analysis_systemディレクトリにいることを確認してください。

1. Dockerコンテナの生成及び起動
```
dokcer compose up -d --build
```
2. wiki_log_analysis_systemの起動
```
docker compose exec app php wiki-log-analysis.php
```

起動後は、ガイダンスに従い入力してください。

アプリが必要なくなりましたら以下のコマンドを打ち込んでイメージの削除及びコンテナの削除をお願いします。
- コンテナの停止及び削除
```
docker compose down
```
- イメージの削除
```
docker image rm [imageId]
```

## 実行例
実行ファイル: projectviews-20240503-050000

指定タスク: 指定したドメインコードに対して人気順にソートする
```
docker compose exec app php wiki-log-analysis.php
データベースとの接続に成功しました
データのインポートを開始します...
データのインポートに成功しました
1. 指定したドメインコードに対して人気順にソートする
2. トップビュー数が多い順にソートする
3. 終了する
タスクを選択してください: 1
ドメインコードを入力してください: en de
"en" 2847323
"de" 128791
```

指定タスク: トップビュー数が多い順にソートする
```
docker compose exec app php wiki-log-analysis.php
データベースとの接続に成功しました
データのインポートを開始します...
データのインポートに成功しました
1. 指定したドメインコードに対して人気順にソートする
2. トップビュー数が多い順にソートする
3. 終了する
タスクを選択してください: 2
件数を入力してください: 10
"en.m" "-" 6301483
"en" "-" 2847323
"ja.m" "-" 1057538
"es.m" "-" 784201
"ru.m" "-" 650895
"zh.m" "-" 380273
"ja" "-" 363074
"de.m" "-" 312573
"zh" "-" 251814
"es" "-" 207401
```

## 備考
wikipediaアクセスログデータ全体の解説ページ
- https://dumps.wikimedia.org/other/pageviews/readme.html

wikipediaアクセスログデータのテーブル定義の解説
- https://wikitech.wikimedia.org/wiki/Analytics/Data_Lake/Traffic/Pageviews

PHP PDO 公式ドキュメント
- https://www.php.net/manual/ja/book.pdo.php
