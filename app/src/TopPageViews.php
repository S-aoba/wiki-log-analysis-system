<?php

use Helpers\ValidationHelper;

require_once(__DIR__ . '/Interface/Task.php');
require_once(__DIR__ . '/DB.php');
require_once(__DIR__ . '/Log.php');

require_once(__DIR__ . '/Helpers/ValidationHelper.php');

class TopPageViews implements Task
{
  public function execute(DB $db)
  {
    // 表示する件数を取得
    $limit = $this->getLimitNumberByUser();

    // データベースからデータを取得する
    $res = $db->getTopPageViews($limit);

    // ターミナルに表示する
    Log::displayTopPageViews($res);
  }

  private function getLimitNumberByUser(): int
  {
    $limit = 3;
    while (true) {
      echo "件数を入力してください: ";
      $limit = trim(fgets(STDIN));

      // 入力された値が数値以外であるかどうかを検証する
      $isNumber = ValidationHelper::isNumber($limit);

      if ($isNumber) {
        break;
      }
      echo "不正な値が入力されました" . PHP_EOL;
    }

    return $limit;
  }
}
