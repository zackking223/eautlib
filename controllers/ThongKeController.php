<?php

namespace myapp\controllers;

use myapp\database\Database;
use myapp\Router;

class ThongKeController {
  public static function index(Router $router) {
    $data = [];

    $data["SACHCHUATRA"] = Database::query("SELECT COUNT(sach_themuontra.MASACH) AS 'SACHCHUATRA' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON WHERE themuontra.TINHTRANG = 'Chưa trả'")->fetch_array(MYSQLI_ASSOC)["SACHCHUATRA"];
    $data["SACHQUAHAN"] = Database::query("SELECT COUNT(sach_themuontra.MASACH) AS 'SACHQUAHAN' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON WHERE themuontra.TINHTRANG = 'Quá hạn'")->fetch_array(MYSQLI_ASSOC)["SACHQUAHAN"];
    $data["BANDOCTHANGNAY"] = Database::query("SELECT COUNT(bandoc.MABANDOC) AS 'BANDOCTHANGNAY' FROM bandoc WHERE NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY")->fetch_array(MYSQLI_ASSOC)["BANDOCTHANGNAY"];
    $data["VPTHANGNAY"] = Database::query("SELECT COUNT(MAVIPHAM) AS 'VPTHANGNAY' FROM vipham WHERE NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY")->fetch_array(MYSQLI_ASSOC)["VPTHANGNAY"];

    $router->renderAdminPanel('admin/analytics/trangchu', [
      'data' => $data
    ]);
  }
}