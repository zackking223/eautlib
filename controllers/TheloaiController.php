<?php

namespace myapp\controllers;

use myapp\Router;
use myapp\models\Theloai;

class TheloaiController
{
    public static function index(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $genres = Theloai::get($search);

        $router->renderAdminPanel('admin/genres/trangchu', [
            'genres' => $genres,
            'search' => $search
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $genreData = [
            'MATHELOAI' => null,
            'TEN' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $genreData['MATHELOAI'] = $_POST['MATHELOAI'] ?? null;
            $genreData['TEN'] = $_POST['TEN'];

            $genre = new Theloai();
            $genre->load($genreData);
            $errors = $genre->save();
            if (empty($errors)) {
                header("location: /admin/genres");
                exit;
            }
        }

        $router->renderAdminPanel('admin/genres/them', [
            'genre' => $genreData,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        $MATHELOAI = $_GET['id'] ?? null;
        if (!$MATHELOAI) {
            header('location: /admin/genres');
            exit;
        }
        $genreData = Theloai::getById($MATHELOAI);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $genreData['TEN'] = $_POST['TEN'];

            $genre = new Theloai();
            $genre->load($genreData);
            $errors = $genre->save('update');

            if (empty($errors)) {
                header('location: /admin/genres');
                exit;
            }
        }

        $router->renderAdminPanel('admin/genres/sua', [
            'genre' => $genreData
        ]);
    }

    public static function delete(Router $router)
    {
        $MATHELOAI = $_POST['MATHELOAI'] ?? null;
        if (!$MATHELOAI) {
            header('location: /admin/genres');
            exit;
        }
        Theloai::delete($MATHELOAI);
        header('location: /admin/genres');
        exit;
    }
}
