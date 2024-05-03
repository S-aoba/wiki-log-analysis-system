<?php

require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/TopPageViews.php');
require_once(__DIR__ . '/PopularPages.php');

class Analysis
{
  static function run()
  {
    $db = new DB();

    $db->createPageViewsTable();
    $db->loadDataInPageViews();

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
          $popularPages = new PopularPages();
          $popularPages->execute($db);
          break;
        case '2':
          $topPageViews = new TopPageViews();
          $topPageViews->execute($db);
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
