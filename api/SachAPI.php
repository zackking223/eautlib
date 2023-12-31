<?php

namespace myapp\api;

use myapp\models\Sach;

class SachAPI
{
  public static function getById()
  {
    $id = $_GET["id"] ?? '';
    header('Content-type: application/json');
    if ($id) {
      $sach = Sach::getById($id);

      echo json_encode($sach);
    } else {
      echo json_encode(['error' => 'Không có id!']);
    }
  }

  public static function addBookToCard()
  {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $bookId = (int)$_POST["bookid"] ?? '';
    $cardId = (int)$_POST["cardid"] ?? '';

    header('Content-type: application/json');

    if (!$_SESSION["auth"]) {
      echo json_encode([
        'success' => false,
        'error' => 'Chưa đănh nhập!'
      ]);
    }

    if ($bookId && $cardId) {
      $result = Sach::borrow($bookId, $cardId);
      $sach = Sach::getById($bookId);

      echo json_encode([
        'success' => $result,
        'book' => $sach
      ]);
    } else {
      echo json_encode([
        'success' => false,
        'error' => 'Thiếu id!'
      ]);
    }
  }

  public static function removeBookFromCard()
  {
    $_POST = json_decode(file_get_contents('php://input'), true);
    $bookId = (int)$_POST["bookid"] ?? '';
    $cardId = (int)$_POST["cardid"] ?? '';

    header('Content-type: application/json');

    if (!$_SESSION["auth"]) {
      echo json_encode([
        'success' => false,
        'error' => 'Chưa đănh nhập!'
      ]);
    }

    if ($bookId && $cardId) {
      $result = Sach::unborrow($bookId, $cardId);

      echo json_encode(['success' => $result]);
    } else {
      echo json_encode([
        'success' => false,
        'error' => 'Thiếu id!'
      ]);
    }
  }
}
