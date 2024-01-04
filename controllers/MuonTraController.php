<?php

namespace myapp\controllers;

use myapp\models\Admin;
use myapp\models\Bandoc;
use myapp\models\Sach;
use myapp\models\Themuon;
use myapp\Router;

class MuonTraController
{
  public static function index(Router $router)
  {
    $search = [
      'cardid' => $_GET["cardid"] ?? '',
      'username' => $_GET["username"] ?? '',
      'hoten' => $_GET["hoten"] ?? '',
      'tinhtrang' => $_GET["tinhtrang"] ?? ''
    ];

    $borrowCards = Themuon::get($search);
    $router->renderAdminPanel('admin/borrows/trangchu', [
      'cards' => $borrowCards,
      'search' => $search
    ]);
  }

  public static function create(Router $router)
  {
    $errors = [];
    $cardData = [
      'MATHEMUON' => null,
      'MABANDOC' => null,
      'MAADMIN' => null,
      'NGAYMUON' => '',
      'NGAYTRA' => '',
      'TINHTRANG' => '',
      'SACHMUON' => []
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $cardData['MABANDOC'] = $_POST['MABANDOC'];
      $cardData['MAADMIN'] = $_POST['MAADMIN'];
      $cardData['NGAYMUON'] = $_POST['NGAYMUON'];
      $cardData['NGAYTRA'] = $_POST['NGAYTRA'];
      $cardData['TINHTRANG'] = $_POST['TINHTRANG'];

      if (isset($_POST['SACHMUON'])) {
        $cardData['SACHMUON'] = $_POST['SACHMUON'];
      }

      $card = new Themuon();
      $card->load($cardData);
      $errors = $card->save();

      if (empty($errors)) {
        header("location: /admin/borrows");
        exit;
      }
    }

    $books = Sach::get();
    $readers = Bandoc::get();
    $admins = Admin::get();

    $router->renderAdminPanel('admin/borrows/them', [
      'card' => $cardData,
      'errors' => $errors,
      'books' => $books,
      'readers' => $readers,
      'admins' => $admins
    ]);
  }

  public static function update(Router $router)
  {
    $id = $_GET['id'] ?? null;
    if (!$id) {
      header('locations: /admin/borrows');
      exit;
    }

    $errors = [];
    $cardData = Themuon::getById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $cardData['MABANDOC'] = $_POST['MABANDOC'];
      $cardData['MAADMIN'] = $_POST['MAADMIN'];
      $cardData['NGAYMUON'] = $_POST['NGAYMUON'];
      $cardData['NGAYTRA'] = $_POST['NGAYTRA'];
      $cardData['TINHTRANG'] = $_POST['TINHTRANG'];

      $card = new Themuon();
      $card->load($cardData);
      $errors = $card->save('update');

      if (empty($errors)) {
        header("location: /admin/borrows");
        exit;
      }
    }

    $books = Sach::get();
    $readers = Bandoc::get();
    $admins = Admin::get();

    $router->renderAdminPanel('admin/borrows/sua', [
      'card' => $cardData,
      'errors' => $errors,
      'books' => $books,
      'readers' => $readers,
      'admins' => $admins
    ]);
  }

  public static function delete(Router $router)
  {
    $id = $_POST['MATHEMUON'] ?? null;
    if ($id) {
      Themuon::delete($id);
    }
    header('location: /admin/borrows');
    exit;
  }

  public static function returnCard(Router $router)
  {
    $id = $_POST['MATHEMUON'] ?? null;
    if ($id) {
      $card = Themuon::getById($id);
      Themuon::returnCard($card);
    }
    header('location: /admin/borrows');
    exit;
  }

  public static function removeBook()
  {
    $MATHEMUON = (int)$_POST['MATHEMUON'] ?? null;
    $MASACH = (int)$_POST['MASACH'] ?? null;
    if ($MATHEMUON && $MASACH) {
      Sach::unborrow($MASACH, $MATHEMUON);
    }
    header('location: /admin/borrows');
    exit;
  }
}
