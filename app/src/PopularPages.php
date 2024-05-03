<?php

use Helpers\ValidationHelper;

require_once(__DIR__ . '/Interface/Task.php');
require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Log.php');

require_once(__DIR__ . '/Helpers/ValidationHelper.php');

class PopularPages implements Task
{
  public function execute(DB $db)
  {
    // 指定したドメインコードに対して、人気順にソートして表示するタスク

    // 検索するdomain_codeを取得
    $domainCode = $this->getDomainCodeByUser();

    // データベースからデータを取得
    $res = $db->getPopularPages($domainCode);
    
    // ターミナルに表示する
    Log::displayPopularPages($res);
  }

  private function getDomainCodeByUser(): string
  {
    $domainCode = '';
    while (true) {
      echo "ドメインコードを入力してください: ";
      $domainCode = trim(fgets(STDIN));

      // 入力された値が文字列かどうかを判定する
      $isString = ValidationHelper::isPureString($domainCode);

      if ($isString) {
        break;
      }

      echo "不正な値が入力されました" . PHP_EOL;
    }

    return $domainCode;
  }
}
