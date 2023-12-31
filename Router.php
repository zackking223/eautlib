<?php

namespace myapp;

class Router
{
  public array $getRoutes = [];
  public array $postRoutes = [];

  public function get($url, $func)
  {
    $this->getRoutes[$url] = $func;
  }

  public function post($url, $func)
  {
    $this->postRoutes[$url] = $func;
  }

  public function resolve()
  {
    $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; //khi dung php server


    // $currentUrl = $_SERVER['REQUEST_URI'] ?? '/'; //apache virtual host
    // if (strpos($currentUrl, '?') !== false) {
    //     $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
    // }

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
      $func = $this->getRoutes[$currentUrl] ?? null;
    } else if ($method === 'POST') {
      $func = $this->postRoutes[$currentUrl] ?? null;
    }

    if ($func) {
      call_user_func($func, $this);
    } else {
      echo "Không tìm thấy trang";
    }
  }

  public function renderView($view, $data = []) //Params: 'view name', ['customer' => $variable]
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once __DIR__ . "\\views\\$view.php";
    $content = ob_get_clean();
    include_once __DIR__ . "\\views\\_layout.php";
  }

  public function renderAuth($view, $data = [])
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once __DIR__ . "\\views\\$view.php";
    $content = ob_get_clean();
    include_once __DIR__ . "\\views\\auth\\_layout.php";
  }

  public function renderAdminPanel($view, $data = [])
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once __DIR__ . "\\views\\$view.php";
    $content = ob_get_clean();
    include_once __DIR__ . "\\views\\admin\\_layout.php";
  }
}
