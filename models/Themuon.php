<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Themuon
{
  public ?int $MATHEMUON = null;
  public ?int $MABANDOC = null;
  public ?int $MAADMIN = null;
  public ?string $NGAYMUON = '';
  public ?string $NGAYTRA = '';
  public ?string $TINHTRANG = '';
  public ?string $NGAYCAPNHAT = '';
  public $SACHMUON = [];

  public function load($data)
  {
    $this->MATHEMUON = (int) $data["MATHEMUON"] ?? null;
    $this->MABANDOC = (int) $data["MABANDOC"] ?? null;
    $this->MAADMIN = (int) $data["MAADMIN"] ?? null;
    $this->NGAYMUON = $data["NGAYMUON"];
    $this->NGAYTRA = $data["NGAYTRA"];
    $this->TINHTRANG = $data["TINHTRANG"];
    $this->NGAYCAPNHAT = $data["NGAYCAPNHAT"] ?? '';
    $this->SACHMUON = $data["SACHMUON"] ?? [];
  }

  public function save(string $flag = "create")
  {
    $errors = [];

    if (!$this->MABANDOC) {
      $errors[] = "Mã bạn đọc không được bỏ trống!";
    }

    if (!$this->MAADMIN) {
      $errors[] = "Mã thủ thư không được bỏ trống!";
    }

    if (!$this->NGAYMUON) {
      $errors[] = "Ngày mượn không được bỏ trống";
    }

    if (!$this->NGAYTRA) {
      $errors[] = "Ngày trả không được bỏ trống";
    }

    if ($flag == "create" && $this->NGAYMUON < date("Y-m-d")) {
      $errors[] = "Ngày mượn phải lớn hơn hoặc bằng hôm nay";
    }

    if (strtotime($this->NGAYTRA) <= strtotime($this->NGAYMUON)) {
      $errors[] = "Ngày mượn không được lớn hơn hoặc bằng ngày trả";
    }

    if (!$this->TINHTRANG) {
      $errors[] = "Tình trạng không được bỏ trống";
    }

    if (empty($this->SACHMUON)) {
      $errors[] = "Phải thêm sách muốn mượn";
    }

    if (!Vipham::isGood($this->MABANDOC)) {
      $errors[] = "Bạn đọc vi phạm quá nhiều!";
    }

    if (empty($errors)) {
      if ($flag === 'create') {
        $errorMsg = Themuon::create($this);
        if ($errorMsg) {
          $errors[] = $errorMsg;
        }
      } else {
        $errorMsg = Themuon::update($this);
        if ($errorMsg) {
          $errors[] = $errorMsg;
        }
      }
    }

    return $errors;
  }

  /** 
   * @var array<string,string>
   */
  public static function get($search)
  {
    $queryStr = "SELECT themuontra.`MATHEMUON`, themuontra.`NGAYTHEM`, themuontra.NGAYMUON, themuontra.NGAYTRA, themuontra.TINHTRANG, themuontra.NGAYCAPNHAT, admin.MAADMIN, bandoc.MABANDOC, admin.USERNAME, bandoc.HOTEN FROM `themuontra` INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC WHERE 1";
    if ($search["cardid"]) $queryStr = $queryStr . " AND themuontra.MATHEMUON = " . $search["cardid"];
    if ($search["hoten"]) $queryStr = $queryStr . " AND bandoc.HOTEN LIKE " . "'%" . $search["hoten"] . "%'";
    if ($search["username"]) $queryStr = $queryStr . " AND admin.USERNAME LIKE " . "'%" . $search["username"] . "%'";
    if ($search["tinhtrang"]) $queryStr = $queryStr . " AND themuontra.TINHTRANG LIKE " . "'%" . $search["tinhtrang"] . "%'";

    $statement = Database::$pdo->prepare($queryStr);

    $statement->execute();

    $result = $statement->get_result();
    $newArr = [];
    foreach($result as $card) {
      $card["SACHMUON"] = Sach::getRelated($card["MATHEMUON"]);
      $newArr[] = $card; 
    }

    return $newArr;
  }

  public static function getById(int $id)
  {
    $statement = Database::$pdo->prepare("SELECT themuontra.`MATHEMUON`, themuontra.`NGAYTHEM`, themuontra.NGAYMUON, themuontra.NGAYTRA, themuontra.TINHTRANG, themuontra.NGAYCAPNHAT, admin.MAADMIN, bandoc.MABANDOC, admin.USERNAME, bandoc.HOTEN FROM `themuontra` INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC WHERE themuontra.MATHEMUON = ?");
    $statement->bind_param("i", $id);

    $statement->execute();

    $result = $statement->get_result()->fetch_array(MYSQLI_ASSOC);
    $result["SACHMUON"] = Sach::getRelated($result["MATHEMUON"]);

    return $result;
  }

  public static function create(Themuon $theMuon): string
  {
    $ngayMuon = date("Y-m-d", strtotime($theMuon->NGAYMUON));
    $ngayTra = date("Y-m-d", strtotime($theMuon->NGAYTRA));

    $statement = Database::$pdo->prepare("INSERT INTO `themuontra`(`MATHEMUON`, `MABANDOC`, `MAADMIN`, `NGAYMUON`, `NGAYTRA`, `TINHTRANG`) VALUES (? ,? ,? , ?, ?, ?)");
    $statement->bind_param("iiisss", $theMuon->MATHEMUON, $theMuon->MABANDOC, $theMuon->MAADMIN, $ngayMuon, $ngayTra, $theMuon->TINHTRANG);

    try {
      $statement->execute();

      foreach ($theMuon->SACHMUON as $sach) {
        Sach::borrow((int)$sach, (int)$statement->insert_id);
      };

      return '';
    } catch (Exception $e) {
      return 'Mã thẻ mượn đã tồn tại!';
      // return $e->getMessage();
    }
  }

  public static function update(Themuon $theMuon): string
  {
    $ngayMuon = date("Y-m-d", strtotime($theMuon->NGAYMUON));
    $ngayTra = date("Y-m-d", strtotime($theMuon->NGAYTRA));

    $statement = Database::$pdo->prepare("UPDATE `themuontra` SET `MABANDOC`= ?,`MAADMIN`= ?,`NGAYMUON`= ?,`NGAYTRA`= ?,`TINHTRANG`= ?, `NGAYCAPNHAT`= NOW() WHERE MATHEMUON = ?");
    $statement->bind_param("iisssi", $theMuon->MABANDOC, $theMuon->MAADMIN, $ngayMuon, $ngayTra, $theMuon->TINHTRANG, $theMuon->MATHEMUON);
    $statement->execute();
    try {
      $statement->execute();
      return '';
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public static function returnCard($theMuon) {
    $statement = Database::$pdo->prepare("UPDATE `themuontra` SET `TINHTRANG`= 'Đã trả', `NGAYCAPNHAT`= NOW() WHERE MATHEMUON = ?");
    $statement->bind_param("i", $theMuon["MATHEMUON"]);
    $statement->execute();

    foreach($theMuon["SACHMUON"] as $bookId) {
      Sach::dec((int)$bookId);
    }
  }

  public static function delete(int $id): bool
  {
    $statement = Database::$pdo->prepare("DELETE FROM `themuontra` WHERE MATHEMUON = ?");
    $statement->bind_param("i", $id);

    return $statement->execute();
  }
}
