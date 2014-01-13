<?php
//database bilgileri
$db_host='localhost';
$db_name='okul';
$db_username='root';
$db_password ='';

//db bağlantı
$db = mysql_connect($db_host,$db_username,$db_password) or die (mysql_error());
$kontrol=mysql_select_db($db_name,$db);
mysql_query("SET NAMES ´utf-8´");
mysql_query("SET CHARACTER SET utf-8");
if(!$kontrol){
    echo 'Çort';
}
?>