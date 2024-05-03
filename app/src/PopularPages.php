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
    while (true) {
      // 検索するdomain_codeを取得
      $domainCodeArr = $this->getDomainCodeByUser();

      // データベースからデータを取得
      $res = $db->getPopularPages($domainCodeArr);

      // データが存在していない場合の処理
      if (count($res) === 0) {
        echo "指定したドメインコードは存在していません" . PHP_EOL;
        continue;
      };

      // // ターミナルに表示する
      Log::displayPopularPages($res);
      break;
    }
  }

  private function getDomainCodeByUser(): array
  {
    echo "ドメインコードを入力してください: ";
    $domainCode = trim(fgets(STDIN));

    // スペース区切りで複数のdomainCodeを配列に直して取得する
    $domainCodeArr = $this->convertArray($domainCode);

    return $domainCodeArr;
  }

  private function convertArray(string $inputVal): array
  {
    $output = [];
    $inputValLen = strlen($inputVal);
    $domainCode = '';

    for ($i = 0; $i < $inputValLen; $i++) {
      $char = $inputVal[$i];

      // 半角の空白ならそれまでのdomainCodeを配列に追加する
      if ($this->containsHalfWidthSpace($char)) {
        array_push($output, $domainCode);
        $domainCode = '';
      } else {
        $domainCode .= $char;
      }
    }
    array_push($output, $domainCode);

    return $output;
  }

  private function containsHalfWidthSpace($str)
  {
    return strpos($str, ' ') !== false;
  }
}
