<?php

namespace Helpers;


class ValidationHelper
{
  public static function isNumber(string $value): bool
  {
    return is_numeric($value);
  }
}
