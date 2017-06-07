<?php
session_start();
header("Content-type:image/png");

$img_width = 120;
$img_height = 20;

srand(microtime() * 100000);
for($i = 0;$i < 4; $i++) {
  $new_number.= dechex(rand(0, 35));
}

$code_name = '_captcha_code';
$_SESSION[$code_name] = $new_number;


$new_number = imageCreate($img_width, $img_height);
ImageColorAllocate($new_number, 255, 255, 255);

for($i=0; $i < strlen($_SESSION[$code_name]); $i++) {
  $font = mt_rand(3, 5);
  $x = mt_rand(1, 8) + $img_width * $i / 6;
  $y = mt_rand(1, $img_height / 4);
  $color = imageColorAllocate($new_number, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
  imageString($new_number,$font, $x, $y, $_SESSION[$code_name][$i], $color);
}

ImagePng($new_number);
ImageDestroy($new_number);
?>