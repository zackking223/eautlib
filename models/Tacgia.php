<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Tacgia
{
  public ?int $MATACGIA = null;
  public ?string $BUTDANH = null;
  public ?string $NGAYTHEM = null;

  public function load($data)
  {
    $this->MATACGIA = (int) $data["MATACGIA"] ?? null;
    $this->BUTDANH = $data["BUTDANH"] ?? '';
    $this->NGAYTHEM = $data["NGAYTHEM"] ?? '';
  }

  public function save(string $flag = "create")
  {
    $errors = [];

    // if (!$this->MATACGIA) {
    //   $errors[] = 'Mã TG không được bỏ trống!';
    // }

    if (!$this->BUTDANH) {
      $errors[] = 'Bút danh không được bỏ trống!';
    }


    if (empty($errors)) {
      if ($flag === 'create') {
        //Them
        $errorMsg = Tacgia::create($this);
        if ($errorMsg) {
          $errors[] = $errorMsg;
        }
      } else {
        //Cap nhat
        $errorMsg = Tacgia::update($this);
        if ($errorMsg) {
          $errors[] = $errorMsg;
        }
      }
    }

    return $errors;
  }

  public static function get(string $search = '')
  {
    if ($search) {
      $search = "%" . $search . "%";
      $statement = Database::$pdo->prepare("SELECT * FROM tacgia WHERE BUTDANH LIKE ?");
      $statement->bind_param("s", $search);
    } else {
      $statement = Database::$pdo->prepare("SELECT * FROM tacgia");
    }

    $statement->execute();

    return $statement->get_result();
  }

  public static function getById(int $id)
  {
    $statement = Database::$pdo->prepare("SELECT * FROM tacgia WHERE MATACGIA=?");
    $statement->bind_param("i", $id);

    $statement->execute();

    //Tra ve du lieu tac gia
    return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
  }

  public static function create(Tacgia $tacgia): string
  {
    $statement = Database::$pdo->prepare("INSERT INTO tacgia(MATACGIA, BUTDANH) VALUES (?, ?)");
    $statement->bind_param("is", $tacgia->MATACGIA, $tacgia->BUTDANH);

    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return 'Mã tác giả đã tồn tại!';
      // return $e->getMessage();
    }
  }

  public static function update(Tacgia $tacgia): string
  {
    $statement = Database::$pdo->prepare("UPDATE tacgia SET BUTDANH = ? WHERE MATACGIA = ?");
    $statement->bind_param("si", $tacgia->BUTDANH, $tacgia->MATACGIA);
    $statement->execute();
    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function delete(int $id): bool
  {
    $statement = Database::$pdo->prepare("DELETE FROM tacgia WHERE MATACGIA = ?");
    $statement->bind_param("i", $id);

    return $statement->execute();
  }
}
