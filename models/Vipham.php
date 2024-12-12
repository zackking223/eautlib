<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Vipham
{
    public ?int $MAVIPHAM = null;
    public ?int $MABANDOC = null;
    public ?int $MAADMIN = null;
    public ?string $NOIDUNG = null;
    public ?string $NGAYTHEM = null;

    public function load($data)
    {
        $this->MAVIPHAM = (int) $data["MAVIPHAM"] ?? null;
        $this->MABANDOC = (int) $data["MABANDOC"] ?? null;
        $this->MAADMIN = (int) $data["MAADMIN"] ?? null;
        $this->NOIDUNG = $data["NOIDUNG"] ?? '';
        $this->NGAYTHEM = $data["NGAYTHEM"] ?? '';
    }

    public function save(string $flag = "create")
    {
        $errors = [];

        if (!$this->NOIDUNG) {
            $errors[] = 'Nội dung không được bỏ trống!';
        }

        if (empty($errors)) {
            if ($flag === 'create') {
                //Them
                $errorMsg = Vipham::create($this);
                if ($errorMsg) {
                    $errors[] = $errorMsg;
                }
            } else {
                //Cap nhat
                $errorMsg = Vipham::update($this);
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
        $noidungSearch = "%" . $search["noidung"] . "%";
        $hotenSearch = "%" . $search["hoten"] . "%";
        $usernameSearch = "%" . $search["username"] . "%";
        $statement = Database::$pdo->prepare("SELECT vipham.`MAVIPHAM`, vipham.`NOIDUNG`, admin.`MAADMIN`, vipham.`NGAYTHEM`, bandoc.MABANDOC, admin.USERNAME, bandoc.HOTEN FROM `vipham` INNER JOIN admin ON vipham.MAADMIN = admin.MAADMIN INNER JOIN bandoc ON vipham.MABANDOC = bandoc.MABANDOC WHERE vipham.NOIDUNG LIKE ? AND admin.USERNAME LIKE ? AND bandoc.HOTEN LIKE ?");
        $statement->bind_param("sss", $noidungSearch, $usernameSearch, $hotenSearch);

        $statement->execute();

        return $statement->get_result();
    }

    public static function getById(int $id)
    {
        $statement = Database::$pdo->prepare("SELECT vipham.`MAVIPHAM`, vipham.`NOIDUNG`, admin.`MAADMIN`, vipham.`NGAYTHEM`, bandoc.MABANDOC, admin.USERNAME, bandoc.HOTEN FROM `vipham` INNER JOIN admin ON vipham.MAADMIN = admin.MAADMIN INNER JOIN bandoc ON vipham.MABANDOC = bandoc.MABANDOC WHERE vipham.MAVIPHAM=?");
        $statement->bind_param("i", $id);

        $statement->execute();

        //Tra ve du lieu vi pham
        return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
    }

    public static function isGood(int $id) : bool
    {
        $statement = Database::$pdo->prepare("SELECT COUNT(*) AS `SOLANVIPHAM` FROM vipham WHERE MABANDOC = ?;");
        $statement->bind_param("i", $id);

        $statement->execute();

        //Tra ve du lieu vi pham
        $resultArr = $statement->get_result()->fetch_array(MYSQLI_ASSOC);

        return $resultArr["SOLANVIPHAM"] < 2;
    }

    public static function create(Vipham $vipham): string
    {
        $statement = Database::$pdo->prepare("INSERT INTO vipham(MABANDOC, MAADMIN, NOIDUNG) VALUES (?, ?, ?)");
        $statement->bind_param("iis", $vipham->MABANDOC, $vipham->MAADMIN, $vipham->NOIDUNG);

        try {
            $statement->execute();
            return '';
        } catch (Exception $e) {
            return 'Mã vi phạm đã tồn tại!';
            // return $e->getMessage();
        }
    }

    public static function update(Vipham $vipham): string
    {
        $statement = Database::$pdo->prepare("UPDATE vipham SET NOIDUNG = ? , MABANDOC = ? , MAADMIN = ? WHERE MAVIPHAM = ?");
        $statement->bind_param("siii", $vipham->NOIDUNG, $vipham->MABANDOC, $vipham->MAADMIN, $vipham->MAVIPHAM);
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
        $statement = Database::$pdo->prepare("DELETE FROM vipham WHERE MAVIPHAM = ?");
        $statement->bind_param("i", $id);

        return $statement->execute();
    }

    public static function getThisMonth()
    {
        return Database::query("SELECT vipham.MAVIPHAM as 'Mã vi phạm', vipham.NOIDUNG as 'Nội dung', vipham.NGAYTHEM as 'Ngày thêm', bandoc.HOTEN as 'Bạn đọc', bandoc.MABANDOC as 'Mã bạn đọc', admin.USERNAME as 'Thủ thư' FROM vipham INNER JOIN bandoc ON vipham.MABANDOC = bandoc.MABANDOC INNER JOIN admin ON admin.MAADMIN = vipham.MAADMIN WHERE vipham.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND vipham.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
    }
}
