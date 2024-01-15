<?php

namespace myapp\helpers;

use mysqli_result;

class ExportCSV
{
  private function array2csv(mysqli_result &$data)
  {
    if ($data->num_rows == 0) {
      return null;
    }
    ob_start();
    $df = fopen("php://output", 'w');
    fprintf($df, chr(0xEF) . chr(0xBB) . chr(0xBF));
    fputcsv($df, array_keys($data->fetch_array(MYSQLI_ASSOC)));
    foreach ($data as $row) {
      fputcsv($df, $row);
    }
    fclose($df);
    return ob_get_clean();
  }

  private function download_send_headers($filename)
  {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: UTF-8");
  }

  public function export($data, string $filename)
  {
    $this->download_send_headers($filename . "_" . date("Y-m-d") . ".csv");
    echo $this->array2csv($data);
    die();
  }
}
