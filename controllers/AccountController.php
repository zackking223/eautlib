<?php

namespace myapp\controllers;

use myapp\models\Admin;
use myapp\Router;

class AccountController
{
  public static function index(Router $router)
  {
    $search = $_GET['search'] ?? '';

    if ($_SESSION["role"] === "QUAN_TRI") {
      $accounts = Admin::get($search);
      $router->renderAdminPanel('admin/accounts/index', [
        'accounts' => $accounts,
        'search' => $search
      ]);
    } else if ($_SESSION["role"] = "THU_THU") {
      $router->renderAdminPanel('admin/accounts/index', [
        'accounts' => [],
        'search' => $search
      ]);
    } else {
      header("location: /");
      exit;
    }
  }

  public static function create(Router $router)
  {
    if ($_SESSION["role"] === "QUAN_TRI") {
      $errors = [];

      $accountData = [
        'MAADMIN' => null,
        'MATKHAU' => '',
        'ROLE' => '',
        'USERNAME' => ''
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accountData['MAADMIN'] = $_POST['MAADMIN'] ?? null;
        $accountData['MATKHAU'] = $_POST['MATKHAU'] ?? '';
        $accountData['ROLE'] = $_POST['ROLE'] ?? '';
        $accountData['USERNAME'] = $_POST['USERNAME'] ?? '';

        $account = new Admin();
        $account->load($accountData);
        $errors = $account->save();

        if (empty($errors)) {
          header("location: /admin/accounts");
          exit;
        }
      }

      $router->renderAdminPanel('admin/accounts/them', [
        'account' => $accountData,
        'errors' => $errors
      ]);
    } else {
      header("location: /");
      exit;
    }
  }

  public static function update(Router $router)
  {
    if ($_SESSION["role"] === "QUAN_TRI") {
      $MAADMIN = $_GET['id'] ?? null;
      if (!$MAADMIN) {
        header('location:: /admin/accounts');
        exit;
      }
      $accountData = Admin::getById($MAADMIN);
      $errors = [];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accountData['MAADMIN'] = $_POST['MAADMIN'] ?? null;
        $accountData['MATKHAU'] = $_POST['MATKHAU'] ?? '';
        $accountData['ROLE'] = $_POST['ROLE'] ?? '';
        $accountData['USERNAME'] = $_POST['USERNAME'] ?? '';
        
        $account = new Admin();
        $account->load($accountData);
        $errors = $account->save('update');

        if (empty($errors)) {
          header("location: /admin/accounts");
          exit;
        }
      }

      $router->renderAdminPanel('admin/accounts/sua', [
        'account' => $accountData,
        'errors' => $errors
      ]);
    } else {
      header("location: /");
      exit;
    }
  }

  public static function delete(Router $router)
  {
    $MAADMIN = $_POST['MAADMIN'] ?? null;
    if (!$MAADMIN) {
      header('location: /admin/accounts');
      exit;
    }
    Admin::delete($MAADMIN);
    header('location: /admin/accounts');
    exit;
  }

  public static function changePass(Router $router)
  {
    $errors = [];
    $MAADMIN = (int)$_GET['id'] ?? null;
    if (!$MAADMIN) {
      header('location: /admin/accounts');
      exit;
    }

    if ($MAADMIN === $_SESSION["maadmin"]) {
      $accountData = Admin::getById($MAADMIN);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errorsMsg = Admin::changePass($accountData["USERNAME"], $_POST["MATKHAUMOI"]);

        if ($errorsMsg) {
          $errors[] = $errorsMsg;
        } else {
          header("location: /admin/accounts");
          exit;
        }
      }

      $router->renderAdminPanel("admin/accounts/doimk", [
        'account' => $accountData,
        'errors' => $errors
      ]);
    } else {
      header("location: /admin/accounts");
      exit;
    }
  }
}
