<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;
use myapp\helpers\UltiHelper;

class Sach
{
  public ?int $MASACH = null;
  public ?int $MATHELOAI = null;
  public ?int $MATACGIA = null;
  public ?string $TENSACH = '';
  public ?int $SOLUONG = null;
  public ?string $VITRI = '';
  public ?string $TOMTAT = '';
  public ?string $ANHSACH = '';
  public ?string $NGAYTHEM = '';
  public ?string $NGAYCAPNHAT = '';
  public ?array $imageFile = null;

  public function load($data)
  { //create ko bao gom image va id
    $this->MASACH = $data['MASACH'] ?? null;
    $this->MATHELOAI = $data['MATHELOAI'] ?? null;
    $this->MATACGIA = $data['MATACGIA'] ?? null;
    $this->TENSACH = $data['TENSACH'];
    $this->SOLUONG = $data['SOLUONG'];
    $this->VITRI = $data['VITRI'] ?? '';
    $this->TOMTAT = $data['TOMTAT'];
    $this->imageFile = $data['imageFile'] ?? null;
    $this->ANHSACH = $data['ANHSACH'] ?? '';
  }

  public function save(string $flag = "create")
  {
    $errors = [];
    if ($flag != "update") {
      if (!$_FILES['imageFile']) {
        $errors[] = 'Ảnh sách không được bỏ trống!';
      }
    }
    if (!$this->MATHELOAI) {
      $errors[] = 'Thể loại không được bỏ trống!';
    }
    if (!$this->MATACGIA) {
      $errors[] = 'Tác giả không được bỏ trống!';
    }
    if (!$this->TENSACH) {
      $errors[] = 'Tên sách không được bỏ trống!';
    }
    if (!$this->SOLUONG) {
      $errors[] = 'Số lượng không được bỏ trống!';
    }
    if (!$this->VITRI) {
      $errors[] = 'Vị trí không được bỏ trống!';
    }
    if (!$this->TOMTAT) {
      $errors[] = 'Tóm tắt không được bỏ trống!';
    }

    if (!is_dir(__DIR__ . '/../src/public/uploads')) {
      mkdir(__DIR__ . '/../src/public/uploads');
    }

    if (empty($errors)) {
      $this->imageFile = $_FILES['imageFile'] ?? null;
      if ($this->imageFile && $this->imageFile['tmp_name'] && $this->imageFile['name']) {

        if ($this->ANHSACH) {
          $pathArr = explode("/", $this->ANHSACH);
          array_pop($pathArr);
          $dirPath = implode("/", $pathArr);

          //Delete the file then the folder
          unlink(__DIR__ . '/../src' . $this->ANHSACH);
          rmdir(__DIR__ . '/../src' . $dirPath);
        }

        $this->ANHSACH = "/public/uploads/" . UltiHelper::randomString(8) . "/" . $this->imageFile['name'];
        mkdir(dirname(__DIR__ . '/../src' . $this->ANHSACH));
        move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../src' . $this->ANHSACH);
      }

      if ($this->MASACH) {
        $errMsg = Sach::update($this);
        if ($errMsg) $errors[] = $errMsg;
      } else {
        $errMsg = Sach::create($this);
        if ($errMsg) $errors[] = $errMsg;
      }
    }
    return $errors;
  }

  public static function get($search = [
    'name' => '',
    'genre' => '',
    'author' => ''
  ])
  {
    $queryStr = "SELECT sach.MASACH, sach.MATHELOAI, sach.MATACGIA, sach.`TENSACH`, sach.`SOLUONG`, sach.`VITRI`, sach.`TOMTAT`, sach.`ANHSACH`, sach.`NGAYTHEM`, sach.`NGAYCAPNHAT`, tacgia.`BUTDANH`, theloai.`TEN`, tacgia.MATACGIA, theloai.MATHELOAI FROM `sach` INNER JOIN tacgia on sach.MATACGIA = tacgia.MATACGIA INNER JOIN theloai on sach.MATHELOAI = theloai.MATHELOAI WHERE sach.TENSACH LIKE " . "'%" . $search["name"] . "%'";

    if ($search["genre"]) $queryStr = $queryStr . " AND theloai.MATHELOAI = " . $search["genre"];
    if ($search["author"]) $queryStr = $queryStr . " AND tacgia.MATACGIA = " . $search["author"];
    $statement = Database::$pdo->prepare($queryStr);

    $statement->execute();

    return $statement->get_result();
  }

  public static function getById(int $id)
  {
    $statement = Database::$pdo->prepare("SELECT sach.MASACH, sach.MATHELOAI, sach.MATACGIA, sach.`TENSACH`, sach.`SOLUONG`, sach.`VITRI`, sach.`TOMTAT`, sach.`ANHSACH`, sach.`NGAYTHEM`, sach.`NGAYCAPNHAT`, tacgia.`BUTDANH`, theloai.`TEN`, tacgia.MATACGIA, theloai.MATHELOAI FROM `sach` INNER JOIN tacgia on sach.MATACGIA = tacgia.MATACGIA INNER JOIN theloai on sach.MATHELOAI = theloai.MATHELOAI WHERE sach.MASACH=?");
    $statement->bind_param("i", $id);

    $statement->execute();

    return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
  }

  public static function create(Sach $sach): string
  {
    $statement = Database::$pdo->prepare("INSERT INTO sach(MASACH, MATHELOAI, MATACGIA, TENSACH, SOLUONG, VITRI, TOMTAT, ANHSACH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("iiisisss", $sach->MASACH, $sach->MATHELOAI, $sach->MATACGIA, $sach->TENSACH, $sach->SOLUONG, $sach->VITRI, $sach->TOMTAT, $sach->ANHSACH);

    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return 'Mã sách đã tồn tại!';
    }
  }

  public static function update(Sach $sach): string
  {
    $statement = Database::$pdo->prepare("UPDATE sach SET MATHELOAI = ?, MATACGIA = ?, TENSACH = ?, SOLUONG = ?, VITRI = ?, TOMTAT = ?, ANHSACH = ?, NGAYCAPNHAT = NOW() WHERE MASACH = ?");
    $statement->bind_param("iisisssi", $sach->MATHELOAI, $sach->MATACGIA, $sach->TENSACH, $sach->SOLUONG, $sach->VITRI, $sach->TOMTAT, $sach->ANHSACH, $sach->MASACH);
    $statement->execute();
    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function borrow(int $bookId, int $cardId)
  {
    $statement = Database::$pdo->prepare("INSERT INTO sach_themuontra(MASACH, MATHEMUON) VALUES(?, ?)");
    $statement->bind_param("ii", $bookId, $cardId);
    $statement->execute();

    return Sach::dec($bookId);
  }

  public static function unborrow(int $bookId, int $cardId)
  {
    $statement = Database::$pdo->prepare("DELETE FROM sach_themuontra WHERE MASACH = ? AND MATHEMUON = ?");
    $statement->bind_param("ii", $bookId, $cardId);
    $statement->execute();

    return Sach::inc($bookId);
  }

  public static function getRelated(int $MATHEMUON)
  {
    $statement = Database::$pdo->prepare("SELECT sach_themuontra.`MASACH`, sach_themuontra.`MATHEMUON`, sach_themuontra.`NGAYTHEM`, sach.MASACH, sach.TENSACH FROM `sach_themuontra` INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH WHERE sach_themuontra.MATHEMUON = ?");
    $statement->bind_param("i", $MATHEMUON);
    $statement->execute();
    return $statement->get_result();
  }

  public static function delete(int $id, string $imgPath): bool
  {
    if ($imgPath) {
      $pathArr = explode("/", $imgPath);
      array_pop($pathArr);
      $dirPath = implode("/", $pathArr);

      //delete image file
      unlink(__DIR__ . '/../src' . $imgPath);
      //delete the folder
      rmdir(__DIR__ . '/../src' . $dirPath);
    }

    $statement = Database::$pdo->prepare("DELETE FROM sach WHERE MASACH = ?");
    $statement->bind_param("i", $id);

    return $statement->execute();
  }

  public static function inc(int $id, int $ammount = 1)
  {
    $statement = Database::$pdo->prepare("UPDATE sach SET SOLUONG = SOLUONG + ? WHERE MASACH = ?");
    $statement->bind_param("ii", $ammount, $id);

    return $statement->execute();
  }

  public static function dec(int $id, int $ammount = 1)
  {
    $statement = Database::$pdo->prepare("UPDATE sach SET SOLUONG = SOLUONG - ? WHERE MASACH = ?");
    $statement->bind_param("ii", $ammount, $id);

    return $statement->execute();
  }

  public static function getBorrowedBooks()
  {
    return Database::query("SELECT themuontra.MATHEMUON AS 'Mã thẻ mượn', sach.MASACH as 'Mã sách', sach.TENSACH AS 'Tên sách', themuontra.NGAYMUON AS 'Ngày mượn', themuontra.NGAYTRA AS 'Ngày trả', bandoc.HOTEN AS 'Bạn đọc', bandoc.MABANDOC AS 'Mã bạn đọc', admin.USERNAME AS 'Thủ thư' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Chưa trả'");
  }

  public static function getExpiredBooks()
  {
    return Database::query("SELECT themuontra.MATHEMUON AS 'Mã thẻ mượn', sach.MASACH as 'MÃ sách', sach.TENSACH AS 'Tên sách', themuontra.NGAYMUON AS 'Ngày mượn', themuontra.NGAYTRA AS 'Ngày trả', bandoc.HOTEN AS 'Bạn đọc', bandoc.MABANDOC AS 'Mã bạn đọc', admin.USERNAME AS 'Thủ thư' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Quá hạn'");
  }

  public static function getThisMonth()
  {
    return Database::query("SELECT sach.MASACH AS 'Mã sách', sach.MATHELOAI AS 'Mã thể loại', sach.MATACGIA AS 'Mã tác giả', sach.`TENSACH` AS 'Tên sách', sach.`SOLUONG` AS 'Số lượng', sach.`VITRI` AS 'Vị trí', sach.`TOMTAT` AS 'Tóm tắt', sach.`ANHSACH` 'Ảnh sách', sach.`NGAYTHEM` AS 'Ngày thêm', sach.`NGAYCAPNHAT` AS 'Ngày cập nhật', tacgia.`BUTDANH` AS 'Tác giả', theloai.`TEN` AS 'Thể loại' FROM `sach` INNER JOIN tacgia on sach.MATACGIA = tacgia.MATACGIA INNER JOIN theloai on sach.MATHELOAI = theloai.MATHELOAI WHERE sach.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND sach.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
  }
}
