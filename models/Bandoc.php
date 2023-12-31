<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Bandoc
{
    public ?int $MABANDOC = null;
    public ?string $HOTEN = null;
    public ?string $NGAYSINH = null;
    public ?string $DIACHI = null;
    public ?string $SDT = null;
    public ?string $NGAYTHEM = null;

    public function load($data)
    {
        $this->MABANDOC = (int) $data["MABANDOC"] ?? null;
        $this->HOTEN = $data["HOTEN"] ?? '';
        $this->NGAYSINH = $data["NGAYSINH"] ?? '';
        $this->DIACHI = $data["DIACHI"] ?? '';
        $this->SDT = $data["SDT"] ?? '';
        $this->NGAYTHEM = $data["NGAYTHEM"] ?? '';
    }
    public function save(string $flag = "create")
    {
        $errors = [];

        // if (!$this->MAKH) {
        //   $errors[] = 'Mã KH không được bỏ trống!';
        // }

        if (!$this->HOTEN) {
            $errors[] = 'Họ tên không được bỏ trống!';
        }

        if (!$this->NGAYSINH) {
            $errors[] = 'Ngày sinh không được bỏ trống';
        }

        if (!$this->DIACHI) {
            $errors[] = 'Địa chỉ không được bỏ trống';
        }

        if (!$this->SDT) {
            $errors[] = 'Số điện thoại không được bỏ trống';
        }
        
        if (empty($errors)) {
            if ($flag === 'create') {
                //Them
                $errorMsg = Bandoc::create($this);
                if ($errorMsg) {
                    $errors[] = $errorMsg;
                }
            } else {
                //Cap nhat
                $errorMsg = Bandoc::update($this);
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
            $statement = Database::$pdo->prepare("SELECT * FROM bandoc WHERE HOTEN LIKE ?");
            $statement->bind_param("s", $search);
        } else {
            $statement = Database::$pdo->prepare("SELECT * FROM bandoc");
        }

        $statement->execute();

        return $statement->get_result();
    }
    public static function getById(int $id)
    {
        $statement = Database::$pdo->prepare("SELECT * FROM bandoc WHERE MABANDOC=?");
        $statement->bind_param("i", $id);

        $statement->execute();

        //Tra ve du lieu ban doc
        return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
    }
    public static function create(Bandoc $bandoc): string
    {
        $statement = Database::$pdo->prepare("INSERT INTO bandoc(MABANDOC, HOTEN, NGAYSINH, DIACHI, SDT) VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("issss", $bandoc->MABANDOC, $bandoc->HOTEN, $bandoc->NGAYSINH, $bandoc->DIACHI, $bandoc->SDT);

        try {
            $statement->execute();
            return '';
        } catch (Exception $e) {
            return 'Mã bạn đọc đã tồn tại!';
            // return $e->getMessage();
        }
    }
    public static function update(Bandoc $bandoc): string
    {
        $statement = Database::$pdo->prepare("UPDATE bandoc SET HOTEN = ? , DIACHI = ? , NGAYSINH = ? , SDT = ? WHERE MABANDOC = ?");
        $statement->bind_param("ssssi", $bandoc->HOTEN, $bandoc->DIACHI, $bandoc->NGAYSINH, $bandoc->SDT, $bandoc->MABANDOC);
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
        $statement = Database::$pdo->prepare("DELETE FROM bandoc WHERE MABANDOC = ?");
        $statement->bind_param("i", $id);

        return $statement->execute();
    }
}

