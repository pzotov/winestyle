<?php
/**
 * Created by PhpStorm.
 * User: pavelzotov
 * Date: 01.02.16
 * Time: 17:26
 */

$image = str_replace('../', '', $_GET['image']);
$size = $_GET['size'];
$sizes = [
	"big" => [800, 600],
	"med" => [600, 400],
	"min" => [300, 200],
	"mic" => [101, 101]
];
if(!isset($sizes[$size])) $size = "mic";

if(file_exists('images/'.$image)){
	$cache_file = 'cache/'.$image.'.'.$size.'.jpg';
	if(!file_exists($cache_file)){
		$im1 = imagecreatefromstring(file_get_contents('images/'.$image));
		$imsize = getimagesize('images/'.$image);
		$kw = $sizes[$size][0]/$imsize[0];
		$kh = $sizes[$size][1]/$imsize[1];
		if($kw<$kh){
			$w = $sizes[$size][0];
			$h = round($imsize[1]*$kw);
		} else {
			$w = round($imsize[0]*$kh);
			$h = $sizes[$size][1];
		}
		$im2 = imagecreatetruecolor($w, $h);
		imagecopyresampled($im2, $im1, 0, 0, 0, 0, $w, $h, $imsize[0], $imsize[1]);
		imagejpeg($im2, $cache_file, 90);//максимальное качество, хотя
		imagedestroy($im1);
		imagedestroy($im2);
	}
	header('Content-type: image/jpeg');
	header('Content-Disposition: inline; filename="'.$image.'.'.$size.'.jpg"');
	header('Content-length: '.filesize($cache_file));
	readfile($cache_file);
} else {
	header('Content-type: image/png');
	header('Content-length: 9228');
	readfile('no-photo.png');
}