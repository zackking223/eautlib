<?php

namespace myapp\helpers;

class ExportXLS {
  // Filter Data
  public static function filterData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    // $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
    $str = mb_convert_encoding($str, mb_detect_encoding($str, mb_detect_order(), true), 'UTF-8');
  }
  
  public static function export($data, $file_name) {
    // File Name & Content Header For Download
    $file_name = $file_name . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$file_name\"");
    
    //To define column name in first row.
    $column_names = false;
    // run loop through each row in $customers_data
    foreach ($data as $row) {
      if (!$column_names) {
        echo implode("\t", array_keys($row)) . "\n";
        $column_names = true;
      }
      // The array_walk() function runs each array element in a user-defined function.
      array_walk($row, [self::class, 'filterData']);
      echo implode("\t", array_values($row)) . "\n";
    }
    exit;
  }
}
