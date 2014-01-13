<?php
/**
 * Created by PhpStorm.
 * User: irfan
 * Date: 09.01.2014
 * Time: 01:15
 */
include ("connection.php");
$username=$_POST["veri"];
$query=mysql_query('select count(*) as sayi from users where username="'.$username.'"');
$sonuc=mysql_fetch_array($query);
echo $sonuc["sayi"];

?>