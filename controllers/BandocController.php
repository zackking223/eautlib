<?php

namespace myapp\controllers;

use myapp\Router;
use myapp\models\Bandoc;

class BandocController
{
    public static function index(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $readers = Bandoc::get($search);

        $router->renderAdminPanel('admin/readers/trangchu', [
            'readers' => $readers,
            'search' => $search
        ]);
    }
    public static function create(Router $router)
    {
        $errors = [];
        $readerData = [
            'MABANDOC' => null,
            'HOTEN' => '',
            'NGAYSINH' => '',
            'DIACHI' => '',
            'SDT' => '',
            'NGAYTHEM' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $readerData['MABANDOC'] = $_POST['MABANDOC'] ?? null;
            $readerData['HOTEN'] = $_POST['HOTEN'];
            $readerData['NGAYSINH'] = $_POST['NGAYSINH'];
            $readerData['DIACHI'] = $_POST['DIACHI'];
            $readerData['SDT'] = $_POST['SDT'];
            $readerData['NGAYTHEM'] = $_POST['NGAYTHEM'];

            $reader = new Bandoc();
            $reader->load($readerData);
            $errors = $reader->save();
            if (empty($errors)) {
                header("location: /admin/readers");
                exit;
            }
        }

        $router->renderAdminPanel('admin/readers/them', [
            'reader' => $readerData,
            'errors' => $errors
        ]);
    }
    public static function update(Router $router)
    {
        $MABANDOC = $_GET['id'] ?? null;
        if (!$MABANDOC) {
            header('location: /admin/readers');
            exit;
        }
        $readerData = Bandoc::getById($MABANDOC);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $readerData['HOTEN'] = $_POST['HOTEN'];
            $readerData['NGAYSINH'] = $_POST['NGAYSINH'];
            $readerData['DIACHI'] = $_POST['DIACHI'];
            $readerData['SDT'] = $_POST['SDT'];
            $readerData['NGAYTHEM'] = $_POST['NGAYTHEM'];

            $reader = new Bandoc();
            $reader->load($readerData);
            $errors = $reader->save('update');

            if (empty($errors)) {
                header('location: /admin/readers');
                exit;
            }
        }

        $router->renderAdminPanel('admin/readers/sua', [
            'reader' => $readerData
        ]);
    }
    public static function delete(Router $router)
    {
        $MABANDOC = $_POST['MABANDOC'] ?? null;
        if ($MABANDOC) {
            Bandoc::delete($MABANDOC);
        }
        header('location: /admin/readers');
        exit;
    }
}