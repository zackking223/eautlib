<?php

namespace myapp\controllers;

use myapp\Router;
use myapp\models\Tacgia;

class TacgiaController
{
    public static function index(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $authors = Tacgia::get($search);

        $router->renderAdminPanel('admin/authors/trangchu', [
            'authors' => $authors,
            'search' => $search
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $authorData = [
            'MATACGIA' => null,
            'BUTDANH' => '',
            'NGAYTHEM' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authorData['MATACGIA'] = $_POST['MATACGIA'] ?? null;
            $authorData['BUTDANH'] = $_POST['BUTDANH'];
            $authorData['NGAYTHEM'] = $_POST['NGAYTHEM'];

            $author = new Tacgia();
            $author->load($authorData);
            $errors = $author->save();
            if (empty($errors)) {
                header("location: /admin/authors");
                exit;
            }
        }

        $router->renderAdminPanel('admin/authors/them', [
            'author' => $authorData,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        $MATACGIA = $_GET['id'] ?? null;
        if (!$MATACGIA) {
            header('location: /admin/authors');
            exit;
        }
        $authorData = Tacgia::getById($MATACGIA);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authorData['BUTDANH'] = $_POST['BUTDANH'];
            $authorData['NGAYTHEM'] = $_POST['NGAYTHEM'];

            $author = new Tacgia();
            $author->load($authorData);
            $errors = $author->save('update');

            if (empty($errors)) {
                header('location: /admin/authors');
                exit;
            }
        }

        $router->renderAdminPanel('admin/authors/sua', [
            'author' => $authorData
        ]);
    }

    public static function delete(Router $router)
    {
        $MATACGIA = $_POST['MATACGIA'] ?? null;
        if (!$MATACGIA) {
            header('location: /admin/authors');
            exit;
        }
        Tacgia::delete($MATACGIA);
        header('location: /admin/authors');
        exit;
    }
}
