<?php

namespace myapp\helpers;

class PasswordHelper
{
  public function CheckMinLength(string $str, int $minLength): bool
  {
    if (strlen($str) < $minLength) {
      return false;
    }

    return true;
  }

  public function HasUpperChar(string $str): bool
  {
    foreach (mb_str_split($str) as $char) {
      if (ctype_upper($char)) {
        return true;
      }
    }

    return false;
  }

  public function HashARGON2ID(string $str): string
  {
    return password_hash($str, PASSWORD_ARGON2ID);
  }

  public function ValidateARGON2ID(string $str, string $hashedStr): bool
  {
    return password_verify($str, $hashedStr);
  }
}
