<?php

require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Task.php');
require_once(__DIR__ . '/Log.php');

class Analysis
{
  static function run()
  {
    $db = new DB();

    $db->createPageViewsTable();
    // $db->loadDataInPageViews();

    while (true) {
      // ユーザーにタスクを選択してもらう
      echo "1. 指定したドメインコードに対して人気順にソートする" . PHP_EOL;
      echo "2. トップビュー数が多い順にソートする" . PHP_EOL;
      echo "3. 終了する" . PHP_EOL;
      echo "タスクを選択してください: ";
      $userAction = trim(fgets(STDIN));
      // 選択されたタスクを実行
      switch ($userAction) {
        case '1':
          // 指定したドメインコードに対して、人気順にソートして表示するタスク
          echo "ドメインコードを入力してください: ";
          $domainCode = trim(fgets(STDIN));
          $res = $db->getPopularPages($domainCode);
          Log::displayPopularPages($res);
          break;
        case '2':
          // 指定した記事数分だけビュー数が多い順にソートして表示するタスク
          echo "件数を入力してください: ";
          $limit = trim(fgets(STDIN));
          $res = $db->getTopPageViews($limit);
          Log::displayTopPageViews($res);
          break;
        case '3':
          echo "処理を終了します" . PHP_EOL;
          return;
        default:
          echo "無効な値です" . PHP_EOL;
      }
    }

    $db->closeDB();
  }
}
