<?php
session_start();
$rol=$_SESSION['rol'];
if($rol!=2){
    header('Location:unauthorized.php');
    exit;
}
if(isset( $_GET['islem'])){
    $islem=$_GET['islem'];
    if($islem=='logout'){
        session_destroy();
        header('Location:index.php');
    }
}
?>