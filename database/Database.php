<?php
namespace myapp\database;

class Database
{
  public static \mysqli $pdo; // PHP data object

  public static function init()
  {
    $config = parse_ini_file("config.ini");
    self::$pdo = new \mysqli($config["host"], $config["username"], $config["password"], $config["dbname"]);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát
    if (self::$pdo->connect_errno) {
      die("Không thể kết nối: " . self::$pdo->connect_error);
      exit();
    }
  }

  public static function close() {
    self::$pdo->close();
  }
}

