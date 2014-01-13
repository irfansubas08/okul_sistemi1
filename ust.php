<?php ob_start();?>
<?php session_start();
$rol=$_SESSION['rol'];
if($rol!=1){
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
<!DOCTYPE html>
<html lang="tr">
<html>
<head>
    <meta charset="utf-8" />
    <script type='text/javascript' src="js/jquery-2.0.3.min.js"></script>
    <script type='text/javascript' src="js/bootstrap.min.js"></script>
    <script type='text/javascript' src="js/denetlemeler.js"></script>
    <link href="css/tablesort/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="bootstrap-editable/js/bootstrap-editable.js"></script>
    <title>Otomasyon Sistemi</title>
    <style>
        .well{
            background-color: rgb(244, 248, 255);
        }
        .tum{
            background-color: rgb(91, 142, 145);
        }
    </style>
</head>
<body class="tum">
<div>
<div class="container">
    <div style="float: left">
        <img style="width:790px; height:130px;margin-bottom: 5px" src="img/banner.jpg" >
    </div>


    <div style ="padding-left: 5px ;float: right; margin-bottom: 5px">
        <?php
            include ("connection.php");
            $id=$_SESSION['id'];
            $sorgu=mysql_query("select * from users where U_ID='$id'");
            $veri=mysql_fetch_array($sorgu);
            $image=$veri['image'];
            echo "<img style='width:140px; height:130px' src='$image' class='img-img-thumbnail'  >";
        ?>

    </div>

</div>
<div class="navbar">
    <div class="navbar-inner">
        <div style="float: left; min-width:1024px;">
            <a class="brand"href="ana.php"><i class="icon-home"></i>OKUL OTOMASYON SİSTEMİ</a>
            <ul class="nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i>
                        Kullanıcılar <span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="user.php?islem=insert"><i class='icon-plus'></i>  Kullanıcı Ekle</a></li>
                        <li class="divider"></li>
                        <li><a href="user.php?islem=list"><i class='icon-list-alt'></i>  Kullanıcı Listele</a></li>
                        <li class="divider"></li>
                        <li><a href="user.php?islem=upload_user"><i class='icon-upload'></i>  Kullanıcı Yükle</a></li>
                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-user"></i> Öğrenciler <span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="student.php?islem=insert"><i class='icon-plus'></i>  Öğrenci Ekle</a></li>
                        <li class="divider"></li>
                        <li><a href="student.php?islem=list"><i class='icon-list-alt'></i>  Öğrencileri Listele</a></li>
                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-user"></i> Öğretmenler <span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="teacher.php?islem=insert"><i class='icon-plus'></i>  Öğretmen Ekle</a></li>
                        <li class="divider"></li>
                        <li><a href="teacher.php?islem=list"><i class='icon-list-alt'></i>  Öğretmen Listele</a></li>
                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class='icon-book'></i>  Ders <span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="lesson.php?islem=insert"><i class='icon-plus'></i>  Ders Ekle</a></li>
                        <li class="divider"></li>
                        <li><a href="lesson.php?islem=list"><i class='icon-list-alt'></i>  Ders Listele</a></li>
                        <li class="divider"></li>
                        <li><a href="lesson.php?islem=student_assignment">Öğrenci Ders Atamaları</a></li>
                        <li class="divider"></li>
                        <li><a href="lesson.php?islem=teacher_assignment">Öğretmen Ders Atamaları</a></li>
                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class='icon-tags'></i> Not <span class="caret"></span></a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><i class='icon-plus'></i>  Not Ver</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class='icon-list-alt'></i>  Notları Listele</a></li>
                    </ul>
                </li>
                <div style="width: 40px;float: right; ">
                    <li style="width:40px;height: 40px">
                        <a href="ust.php?islem=logout"><img src="img/logout.png" alt="Çıkış" style="width:40px;height: 40px"></a>
                    </li>
                </div>


            </ul>
            <div style="margin-top:10px; float: right; ">
                <?php
                include ("connection.php");
                $id=$_SESSION['id'];
                $sorgu=mysql_query("select * from users where U_ID='$id'");
                $veri=mysql_fetch_array($sorgu);
                $firstname=$veri['firstname'];
                $lastname=$veri['lastname'];

                echo "<p>&nbsp&nbspOturum Açan Kullanıcı: $firstname&nbsp$lastname</p>"
                ?>

            </div>
        </div>
    </div>

</div>

<div class="container">