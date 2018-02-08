<?php

$datetime = new DateTime();
$date = date('Ymd');

// 一つのpdfにまとめるjpgを格納している画像ディレクトリ
$jpgDir  = '/var/tmp/sample_img/' . $date . '/';
// pdf化した際のファイル名
$pdfFile = $date . '.pdf';

// 画像ディレクトリ内のファイルとディレクトリを配列にする
$imgs = scandir($jpgDir);
// ディレクトリ内に既にPDFがある場合はキーを格納する
$key = key(preg_grep('/pdf/' , $imgs));

if ($key) {
  // pdf作成済み
  echo 'ある';
  return;
} else {
  // pdfを新規に作成する
  echo 'ない';

  $delFile = ['.', '..'];

  $imgs = array_diff($imgs , $delFile);

  $im = new Imagick($imgs); // Imagickオブジェクト作成
  $im->setImageFormat('pdf'); // 変換形式の指定
  $im->writeimages($jpgDir . $pdfFile , true ); // 作成したファイルの出力
}




/*

$images = array("file1.jpg", "file2.jpg");

$pdf = new Imagick($images);
$pdf->setImageFormat('pdf');
$pdf->writeImages('combined.pdf', true);

[Combine JPG's into one PDF with PHP - Stack Overflow](https://stackoverflow.com/questions/25680490/combine-jpgs-into-one-pdf-with-php)
*/
