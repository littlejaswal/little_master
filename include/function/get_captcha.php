<?php
session_start();
$dir = 'fonts/';

$image = imagecreatetruecolor(70, 35);

// random number 1 or 2
$num = rand(1,2);
if($num==1)
{
	$font = "courbd.ttf"; // font style
}
else
{
	$font = "courbd.ttf";// font style
}

// random number 1 or 2
$num2 = rand(1,2);
if($num2==1)
{
	$color = imagecolorallocate($image, 113, 193, 217);// color
}
else
{
	$color = imagecolorallocate($image, 163, 197, 82);// color
}

$white = imagecolorallocate($image, 255, 255, 255); // background color white
imagefilledrectangle($image,0,0,399,99,$white);

imagettftext ($image, 15, 0, 5, 20, $color, $dir.$font, $_SESSION['captcha_sum']);

header("Content-type: image/png");
imagepng($image);
?>