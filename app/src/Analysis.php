<?php

require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Task.php');

class Analysis
{
  static function run()
  {
    $db = new DB();

    $db->createPageViewsTable();
    $db->loadDataInPageViews();

    // ユーザーにタスクを選択してもらう

    // 選択されたタスクを実行
    echo "処理を終了します" . PHP_EOL;
  }
}
