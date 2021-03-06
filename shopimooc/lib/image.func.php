<?php
// 通过GD库做验证码
// 创建画布
function verifyImage($type=1,$length=4,$pixel=0,$line=0,$sess_name='verify'){
$width = 80;
$height = 28;
$image = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
// 用填充矩形填充画布
imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
$chars= buildRandomString($type,$length); // 创建字符串
$_SESSION[$sess_name] = $chars;
$fontfiles = array(
    "PALA.TTF"  
);
//逐个数字输出
 for($i =0;$i<4;$i++) {
    $size = mt_rand(14, 18);
    $angle = mt_rand(-15, 15);
    $x =5+$i*$size;
    $y = mt_rand(20, 26);
    $fontfile = "../fonts/" . $fontfiles[0];
    $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
    $text = substr($chars,$i,1);
    imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
}
$pixel=0;
if($pixel){
for($i=0;$i<$pixel;$i++){
    imagesetpixel($image, mt_rand(0,$width-1), mt_rand(0,$height-1), $black);
 } 
}
$line=0;
if($line){
    for($i=1;$i<$line;$i++){
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        imageline($image, mt_rand(0,$width-1), mt_rand(0,$height-1),mt_rand(0,$width-1),mt_rand(0,$height-1), $color);
    }
}
ob_clean(); 
Header ( "content-type:image/gif" );
imagegif ( $image );
imagedestroy ( $image ); 
}
?>
