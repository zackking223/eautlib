<?php

namespace myapp\controllers;

use myapp\models\Admin;
use myapp\Router;

class AuthController
{
  public static function login(Router $router)
  {
    $errors = [];
    $loginData = [
      'USERNAME' => '',
      'MATKHAU' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $loginData['USERNAME'] = $_POST['USERNAME'];
      $loginData['MATKHAU'] = $_POST['MATKHAU'];

      $admin = new Admin();
      $admin->load($loginData);
      $errors = $admin->verify();

      if (empty($errors)) {
        header("location: /");
        exit;
      }
    }

    $router->renderAuth('auth/dangnhap', [
      'errors' => $errors
    ]);
  }

  public static function logout()
  {
    session_unset();
    session_destroy();
    header("location: /");
  }
}
