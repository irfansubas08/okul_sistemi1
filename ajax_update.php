<?php
include "connection.php";
$tablo=$_GET["tablo"];
$filtre=$_GET["filtre"];
if(isset($_POST['name'])){
    $id=$_POST['pk'];
    $veri=$_POST['value'];
    $alanadı=explode('__',$_POST['name']);
    $alanadı=$alanadı[0];
    if(mysql_query("UPDATE $tablo SET $alanadı='$veri'

        where $filtre=$id")){

        echo 'ok';
    }
}

?>