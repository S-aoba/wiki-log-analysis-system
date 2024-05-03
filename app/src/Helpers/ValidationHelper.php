<?php

namespace Helpers;


class ValidationHelper
{
  public static function isNumber(string $value): bool
  {
    return is_numeric($value);
  }

  public static function isPureString(string $value): bool
  {
    // 正規表現パターン: 文字列は、数字、記号、空白を含まずに構成される必要があります。
    $pattern = '/^[^\d\s!@#$%^&*()_+=\-[\]{};:"\\|,.<>\/?]*$/';
    return preg_match($pattern, $value) === 1;
  }
}
