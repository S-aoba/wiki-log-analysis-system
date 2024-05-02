<?php

require_once(__DIR__ . '/Interface/Task.php');
require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Log.php');

class PopularPages implements Task
{
  public function execute(DB $db)
  {
    // 指定したドメインコードに対して、人気順にソートして表示するタスク
    echo "ドメインコードを入力してください: ";
    $domainCode = trim(fgets(STDIN));
    $res = $db->getPopularPages($domainCode);
    Log::displayPopularPages($res);
  }
}
