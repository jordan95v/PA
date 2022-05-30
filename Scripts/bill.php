<?php
header("Content-Type: Image/png");
$img = imagecreate(500, 300);
$black = imagecolorallocate($img, 255, 255, 255);
imagesetthickness($img, 10);
$x = 20;

for ($i = 0; $x < 500; $i++) {
    imageline($img, $x, 10, $x, 250, imagecolorallocate($img, 0, 0, 0));
    $x += rand(15, 30);
}
imagettftext($img, 25, 0, 130, 290, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", "Salut");
imagepng($img);
