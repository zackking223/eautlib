<?php

namespace myapp\models;

use Exception;
use myapp\database\Database;

class Theloai
{
    public ?int $MATHELOAI = null;
    public ?string $TEN = null;

    public function load($data)
    {
        $this->MATHELOAI = (int) $data["MATHELOAI"] ?? null;
        $this->TEN = $data["TEN"] ?? '';
    }

    public function save(string $flag = "create")
    {
        $errors = [];
        
        if (!$this->TEN) {
            $errors[] = 'Tên không được bỏ trống!';
        }

        if (empty($errors)) {
            if ($flag === 'create') {
                //Them
                $errorMsg = Theloai::create($this);
                if ($errorMsg) {
                    $errors[] = $errorMsg;
                }
            } else {
                //Cap nhat
                $errorMsg = Theloai::update($this);
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
            $statement = Database::$pdo->prepare("SELECT * FROM theloai WHERE TEN LIKE ?");
            $statement->bind_param("s", $search);
        } else {
            $statement = Database::$pdo->prepare("SELECT * FROM theloai");
        }

        $statement->execute();

        return $statement->get_result();
    }

    public static function getById(int $id)
    {
        $statement = Database::$pdo->prepare("SELECT * FROM theloai WHERE MATHELOAI=?");
        $statement->bind_param("i", $id);

        $statement->execute();

        //Tra ve du lieu the loai
        return $statement->get_result()->fetch_array(MYSQLI_ASSOC);
    }

    public static function create(Theloai $Theloai): string
    {
        $statement = Database::$pdo->prepare("INSERT INTO theloai(MATHELOAI, TEN) VALUES (?, ?)");
        $statement->bind_param("is", $Theloai->MATHELOAI, $Theloai->TEN);

        try {
            $statement->execute();
            return '';
        } catch (Exception $e) {
            return 'Mã thể loại đã tồn tại!';
            // return $e->getMessage();
        }
    }

    public static function update(Theloai $Theloai): string
    {
        $statement = Database::$pdo->prepare("UPDATE theloai SET TEN = ? WHERE MATHELOAI = ?");
        $statement->bind_param("si", $Theloai->TEN, $Theloai->MATHELOAI);
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
        $statement = Database::$pdo->prepare("DELETE FROM theloai WHERE MATHELOAI = ?");
        $statement->bind_param("i", $id);

        return $statement->execute();
    }
}
