<?php

header("X-Robots-Tag: noindex, nofollow", true);

$code = rand(1000, 9999);
$_SESSION['captcha'] = $code;

header('Content-type: image/png');

$image = imagecreatetruecolor(80, 30);
$bg = imagecolorallocate($image, 255, 255, 255);
$fg = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 80, 30, $bg);
imagestring($image, 5, 20, 8, $code, $fg);
imagepng($image);
imagedestroy($image);