<?php

require_once(__DIR__ . '/Interface/Task.php');
require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Log.php');

class TopPageViews implements Task
{
  public function execute(DB $db)
  {
    // 指定した記事数分だけビュー数が多い順にソートして表示するタスク
    echo "件数を入力してください: ";
    $limit = trim(fgets(STDIN));
    $res = $db->getTopPageViews($limit);
    Log::displayTopPageViews($res);
  }
}
