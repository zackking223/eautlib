<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Admin
{
  public ?int $MAADMIN = null;
  public ?string $MATKHAU = null;
  public ?string $ROLE = null;
  public ?string $USERNAME = null;
  public ?string $NGAYTHEM = null;

  public function load($data)
  {
    $this->MAADMIN = (int)$data["MAADMIN"] ?? null;
    $this->MATKHAU = $data["MATKHAU"] ?? null;
    $this->ROLE = $data["ROLE"] ?? null;
    $this->USERNAME = trim($data["USERNAME"]) ?? null;
    $this->NGAYTHEM = $data["NGAYTHEM"] ?? null;
  }

  public function save(string $flag = "create")
  {
    $errors = [];

    if ($flag == "create") {
      if (!$this->MATKHAU) {
        $errors[] = "Mật khẩu không được bỏ trống!";
      }
  
      if (strlen($this->MATKHAU) < 8) {
        $errors[] = "Mật khẩu tối thiểu 8 ký tự!";
      }
    }

    if (!$this->ROLE) {
      $errors[] = "Vai trò không được bỏ trống!";
    }

    if (!$this->USERNAME || trim($this->USERNAME) == "") {
      $errors[] = "Tên đăng nhập không được bỏ trống";
    }

    if (empty($errors)) {
      if ($flag == 'create') {
        //Them
        $errorMsg = Admin::create($this);
        if ($errorMsg) {
          $errors[] = $errorMsg;
        }
      } else {
        $errorMsg = Admin::update($this);
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
      $statement = Database::$pdo->prepare("SELECT `MAADMIN`, `ROLE`, `USERNAME`, `NGAYTHEM` FROM admin WHERE USERNAME LIKE ?");
      $statement->bind_param("s", $search);
    } else {
      $statement = Database::$pdo->prepare("SELECT `MAADMIN`, `ROLE`, `USERNAME`, `NGAYTHEM` FROM admin");
    }

    $statement->execute();

    return $statement->get_result();
  }

  public static function getById(int $id)
  {
    $statement = Database::$pdo->prepare("SELECT `MAADMIN`, `ROLE`, `USERNAME`, `NGAYTHEM` FROM admin WHERE MAADMIN=?");
    $statement->bind_param("i", $id);

    $statement->execute();

    return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
  }

  public static function create(Admin $admin): string
  {
    $hashedPassword = Admin::hashPassword($admin->MATKHAU);
    $statement = Database::$pdo->prepare("INSERT INTO admin(MAADMIN, MATKHAU, ROLE, USERNAME) VALUES (?, ?, ?, ?)");
    $statement->bind_param("isss", $admin->MAADMIN, $hashedPassword, $admin->ROLE, $admin->USERNAME);

    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return 'Tên đăng nhập đã tồn tại!';
    }
  }

  public static function update(Admin $admin): string
  {
    $statement = Database::$pdo->prepare("UPDATE admin SET ROLE = ?, USERNAME = ? WHERE MAADMIN = ?");
    $statement->bind_param("ssi", $admin->ROLE, $admin->USERNAME, $admin->MAADMIN);
    $statement->execute();
    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function hashPassword(string $str)
  {
    return password_hash($str, PASSWORD_ARGON2ID);
  }

  public function verify()
  {
    $errors = [];

    if (!$this->MATKHAU) {
      $errors[] = "Mật khẩu không được bỏ trống";
    }

    if (!$this->USERNAME) {
      $errors[] = "Tên đăng nhập không được bỏ trống";
    }

    if (empty($errors)) {
      $statement = Database::$pdo->prepare("SELECT `MAADMIN`, `MATKHAU`, `ROLE`, `USERNAME`, `NGAYTHEM` FROM admin WHERE USERNAME=?");
      $statement->bind_param("s", $this->USERNAME);
      $statement->execute();

      $result = $statement->get_result()->fetch_array(MYSQLI_ASSOC);

      if (password_verify($this->MATKHAU, $result["MATKHAU"])) {
        $_SESSION['auth'] = true;
        $_SESSION['username'] = $result['USERNAME'];
        $_SESSION['role'] = $result['ROLE'];
        $_SESSION['maadmin'] = $result['MAADMIN'];
      } else {
        $errors[] = "Sai tên đăng nhập hoặc mật khẩu";
      }
    }
    return $errors;
  }

  public static function changePass(string $username, string $newPass): string
  {
    $hashedPassword = Admin::hashPassword($newPass);
    $statement = Database::$pdo->prepare("UPDATE admin SET MATKHAU = ? WHERE USERNAME = ?");
    $statement->bind_param("si", $hashedPassword, $username);
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
    $statement = Database::$pdo->prepare("DELETE FROM admin WHERE MAADMIN = ?");
    $statement->bind_param("i", $id);

    return $statement->execute();
  }
}
