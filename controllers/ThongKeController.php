<?php

namespace myapp\controllers;

use myapp\database\Database;
use myapp\helpers\ExportCSV;
use myapp\Router;

class ThongKeController
{
  public static function index(Router $router)
  {
    $data = [];

    $data["SACHCHUATRA"] = Database::query("SELECT themuontra.MATHEMUON, sach.MASACH, sach.TENSACH,themuontra.NGAYMUON, themuontra.NGAYTRA, bandoc.HOTEN, bandoc.MABANDOC, admin.USERNAME FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Chưa trả'");
    $data["SACHCHUATRA_ROWS"] = $data["SACHCHUATRA"]->num_rows;

    $data["SACHQUAHAN"] = Database::query("SELECT themuontra.MATHEMUON, sach.MASACH, sach.TENSACH,themuontra.NGAYMUON, themuontra.NGAYTRA, bandoc.HOTEN, bandoc.MABANDOC, admin.USERNAME FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Quá hạn'");
    $data["SACHQUAHAN_ROWS"] = $data["SACHQUAHAN"]->num_rows;

    $data["BANDOCTHANGNAY"] = Database::query("SELECT * FROM bandoc WHERE NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
    $data["BANDOCTHANGNAY_ROWS"] = $data["BANDOCTHANGNAY"]->num_rows;

    $data["SACHTHANGNAY"] = Database::query("SELECT sach.MASACH, sach.MATHELOAI, sach.MATACGIA, sach.`TENSACH`, sach.`SOLUONG`, sach.`VITRI`, sach.`TOMTAT`, sach.`ANHSACH`, sach.`NGAYTHEM`, sach.`NGAYCAPNHAT`, tacgia.`BUTDANH`, theloai.`TEN`, tacgia.MATACGIA, theloai.MATHELOAI FROM `sach` INNER JOIN tacgia on sach.MATACGIA = tacgia.MATACGIA INNER JOIN theloai on sach.MATHELOAI = theloai.MATHELOAI WHERE sach.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND sach.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
    $data["SACHTHANGNAY_ROWS"] = $data["SACHTHANGNAY"]->num_rows;

    $data["VPTHANGNAY"] = Database::query("SELECT vipham.MAVIPHAM, vipham.NOIDUNG, vipham.NGAYTHEM, bandoc.HOTEN, bandoc.MABANDOC, admin.USERNAME FROM vipham INNER JOIN bandoc ON vipham.MABANDOC = bandoc.MABANDOC INNER JOIN admin ON admin.MAADMIN = vipham.MAADMIN WHERE vipham.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND vipham.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
    $data["VPTHANGNAY_ROWS"] = $data["VPTHANGNAY"]->num_rows;

    $router->renderAdminPanel('admin/analytics/trangchu', [
      'data' => $data
    ]);
  }

  public static function download()
  {
    $flag = $_GET["target"] ?? "";

    if ($flag && $_SESSION["auth"]) {
      $exportCSV = new ExportCSV();
      switch ($flag) {
        case "chuatra":
          $data = Database::query("SELECT themuontra.MATHEMUON AS 'Mã thẻ mượn', sach.MASACH as 'Mã sách', sach.TENSACH AS 'Tên sách', themuontra.NGAYMUON AS 'Ngày mượn', themuontra.NGAYTRA AS 'Ngày trả', bandoc.HOTEN AS 'Bạn đọc', bandoc.MABANDOC AS 'Mã bạn đọc', admin.USERNAME AS 'Thủ thư' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Chưa trả'");
          $exportCSV->export($data, "SachChuaTra");
          break;
        case "quahan":
          $data = Database::query("SELECT themuontra.MATHEMUON AS 'Mã thẻ mượn', sach.MASACH as 'MÃ sách', sach.TENSACH AS 'Tên sách', themuontra.NGAYMUON AS 'Ngày mượn', themuontra.NGAYTRA AS 'Ngày trả', bandoc.HOTEN AS 'Bạn đọc', bandoc.MABANDOC AS 'Mã bạn đọc', admin.USERNAME AS 'Thủ thư' FROM themuontra INNER JOIN sach_themuontra ON themuontra.MATHEMUON = sach_themuontra.MATHEMUON INNER JOIN sach ON sach.MASACH = sach_themuontra.MASACH INNER JOIN bandoc ON bandoc.MABANDOC = themuontra.MABANDOC INNER JOIN admin ON admin.MAADMIN = themuontra.MAADMIN WHERE themuontra.TINHTRANG = 'Quá hạn'");
          $exportCSV->export($data, "SachQuaHan");
          break;
        case "sach":
          $data = Database::query("SELECT sach.MASACH AS 'Mã sách', sach.MATHELOAI AS 'Mã thể loại', sach.MATACGIA AS 'Mã tác giả', sach.`TENSACH` AS 'Tên sách', sach.`SOLUONG` AS 'Số lượng', sach.`VITRI` AS 'Vị trí', sach.`TOMTAT` AS 'Tóm tắt', sach.`ANHSACH` 'Ảnh sách', sach.`NGAYTHEM` AS 'Ngày thêm', sach.`NGAYCAPNHAT` AS 'Ngày cập nhật', tacgia.`BUTDANH` AS 'Tác giả', theloai.`TEN` AS 'Thể loại' FROM `sach` INNER JOIN tacgia on sach.MATACGIA = tacgia.MATACGIA INNER JOIN theloai on sach.MATHELOAI = theloai.MATHELOAI WHERE sach.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND sach.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
          $exportCSV->export($data, "SachMoiThangNay");
          break;
        case "bandoc":
          $data = Database::query("SELECT `MABANDOC` as 'Mã bạn đọc', `HOTEN` as 'Họ tên', `NGAYSINH` as 'Ngày sinh', `DIACHI` as 'Địa chỉ', `SDT` as 'Số điện thoại', `NGAYTHEM` as 'Ngày thêm' FROM `bandoc` WHERE NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
          $exportCSV->export($data, "BanDocThangNay");
          break;
        case "vipham":
          $data = Database::query("SELECT vipham.MAVIPHAM as 'Mã vi phạm', vipham.NOIDUNG as 'Nội dung', vipham.NGAYTHEM as 'Ngày thêm', bandoc.HOTEN as 'Bạn đọc', bandoc.MABANDOC as 'Mã bạn đọc', admin.USERNAME as 'Thủ thư' FROM vipham INNER JOIN bandoc ON vipham.MABANDOC = bandoc.MABANDOC INNER JOIN admin ON admin.MAADMIN = vipham.MAADMIN WHERE vipham.NGAYTHEM >= LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND vipham.NGAYTHEM <  LAST_DAY(CURDATE()) + INTERVAL 1 DAY");
          $exportCSV->export($data, "ViPhamThangNay");
          break;
        default:
          header("Content-type: application/json");
          echo json_encode([
            "message" => "Lựa chọn không tồn tại!"
          ]);
          break;
      }
    } else {
      header("Content-type: application/json");
      echo json_encode([
        "message" => "Quyền truy cập bị từ chối!"
      ]);
    }
  }
}
