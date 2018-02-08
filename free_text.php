<?php
ob_start(function($buf){ return mb_convert_encoding($buf, 'SJIS', 'UTF-8'); });
$color           = 'yellow';
$backgroundColor = 'transparent'; //透過
$numImgDir  = '/var/tmp/number_img/';
// $argv → 引数
$text = $argv[1];
$textFile = $text . '.png';
// $idraw->setFont('/usr/share/fonts/bitstream-vera/A-OTF-ShinMGoPro-DeBold.otf');// font
$idraw = new ImagickDraw();
$im    = new Imagick();

$idraw->setFontSize(50);// font size
$idraw->setGravity(Imagick::GRAVITY_CENTER);// gravity
$idraw->setFillColor($color);// fontcolor
$idraw->setStrokeColor($color);// rinkaku
$idraw->annotation(0, 0, $text);
$metrics = $im->queryFontMetrics($idraw, $text);//get the size of string

$im->newImage($metrics['textWidth'], $metrics['textHeight'], $backgroundColor);
$im->drawImage($idraw);
$im->setImageFormat('png');
$im->writeimages($numImgDir . $textFile , true ); // file shuturyoku
header('Content-Type: image/png');
// echo $im;
$im->destroy();
$idraw->destroy();