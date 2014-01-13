<?php
/**
 * Created by PhpStorm.
 * User: irfan
 * Date: 09.01.2014
 * Time: 00:02
 */
header("Content-type: image/gif");
include("connection.php");
for ($i=1;$i<4;$i++){
    $query1 = mysql_query("select count(*) from users where role='$i'");
    $sonuc1 = mysql_fetch_array($query1);
    $pasta[$i-1]=$sonuc1[0];
}
$veri= array("Admin","Ogretmen","Ogrenci");
$toplam=array_sum($pasta);
$width=420;
$height=240;
$img=imagecreate($width,$height);
$bg=imagecolorallocate($img,255,255,255);
$width=200;
$height=200;
$cx=$width/2;
$cy=$height/2;
for ($m = ($height/2)+20;$m>($height/2);$m--){
    $start=0;
    $j=10;
    for($i=0;$i<count($pasta);$i++){
        $e=round(($pasta[$i]/$toplam)*100,2);
        $end=round(($e*360)/100);
        $renk =imagecolorallocate($img,(8*$j),(160+$j),(15*$j));
        imagefilledarc($img,$cx,$m,$width,$height/2,$start,$start+$end,$renk,IMG_ARC_PIE);
        $start+=$end;
        $j+=20;
    }
}
$start=0; $j=10;
for($i=0;$i<count($pasta);$i++){
    $e=round(($pasta[$i]/$toplam)*100,2);
    $end=round(($e*360)/100);
    $renk =imagecolorallocate($img,(8*$j)+15,(160+$j+15),(15*$j)+15);
    imagefilledarc($img,$cx,$m,$width,$height/2,$start,$start+$end,$renk,IMG_ARC_PIE);
    imagefilledrectangle($img,250,50+($i*20),264,64+($i*20),$renk);
    imagestring($img,3,276,52+($i*20),$veri[$i].'[%'.$e.']',$renk);
    $start+=$end;
    $j+=20;
}
imagegif($img);
imagedestroy($img);

?>