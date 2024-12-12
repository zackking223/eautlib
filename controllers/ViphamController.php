<?php

namespace myapp\controllers;

use myapp\models\Admin;
use myapp\models\Bandoc;
use myapp\Router;
use myapp\models\Vipham;

class ViphamController
{
    public static function index(Router $router)
    {
        $search = [
            'noidung' => $_GET['noidung'] ?? '',
            'username' => $_GET['username'] ?? '',
            'hoten' => $_GET['hoten'] ?? ''
        ];
        
        $violations = Vipham::get($search);
        
        $router->renderAdminPanel('admin/violations/trangchu', [
            'violations' => $violations,
            'search' => $search
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $violationData = [
            'MAVIPHAM' => null,
            'MABANDOC' => null,
            'MAADMIN' => null,
            'NOIDUNG' => '',
            'NGAYTHEM' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $violationData['MAVIPHAM'] = $_POST['MAVIPHAM'] ?? null;
            $violationData['MABANDOC'] = $_POST['MABANDOC'] ?? null;
            $violationData['MAADMIN'] = $_POST['MAADMIN'] ?? null;
            $violationData['NOIDUNG'] = $_POST['NOIDUNG'];

            $violation = new Vipham();
            $violation->load($violationData);
            $errors = $violation->save();
            if (empty($errors)) {
                header("location: /admin/violations");
                exit;
            }
        }

        $admins = Admin::get();
        $readers = Bandoc::get();

        $router->renderAdminPanel('admin/violations/them', [
            'violation' => $violationData,
            'errors' => $errors,
            'admins' => $admins,
            'readers' => $readers
        ]);
    }

    public static function update(Router $router)
    {
        $MAVIPHAM = $_GET['id'] ?? null;
        if (!$MAVIPHAM) {
            header('location: /admin/violations');
            exit;
        }
        $violationData = Vipham::getById($MAVIPHAM);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $violationData['NOIDUNG'] = $_POST['NOIDUNG'];
            $violationData['MAADMIN'] = $_POST['MAADMIN'];
            $violationData['MABANDOC'] = $_POST['MABANDOC'];

            $violation = new Vipham();
            $violation->load($violationData);
            $errors = $violation->save('update');

            if (empty($errors)) {
                header('location: /admin/violations');
                exit;
            }
        }

        $admins = Admin::get();
        $readers = Bandoc::get();

        $router->renderAdminPanel('admin/violations/sua', [
            'violation' => $violationData,
            'errors' => $errors,
            'admins' => $admins,
            'readers' => $readers
        ]);
    }

    public static function delete(Router $router)
    {
        $MAVIPHAM = $_POST['MAVIPHAM'] ?? null;
        if (!$MAVIPHAM) {
            header('location: /violations');
            exit;
        }
        Vipham::delete($MAVIPHAM);
        header('location: /violations');
        exit;
    }
}
