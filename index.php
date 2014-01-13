<?php
session_start();
if(isset($_SESSION['rol'])){
   $rol_ynd=$_SESSION['rol'];
    switch ($rol_ynd){
        case 1:
            header('location:ana.php');
            break;
        case 2:
            header('location:teacher_page.php');
            break;
        case 3:
            header('location:student_page.php');
            break;
    }
}

echo "
<!DOCTYPE html>
<html lang='tr'>
<html>
<head>
    <meta charset='utf-8' />
    <script type='text/javascript' src='js/jquery-2.0.3.min.js'></script>
    <script type='text/javascript' src='js/bootstrap.min.js'></script>
    <script type='text/javascript' src='js/denetlemeler.js'></script>
    <link href='css/bootstrap.min.css' rel='stylesheet' type='text/css' />
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
<body class='tum'>
<div style='width:600px; margin: 250px auto'>
    <form class='form-horizontal' action='index.php' method='post'>
        <div class='control-group'>
            <label class='control-label'>Kullanıcı Adını:</label>
            <div class='controls'>
                <input type='text' name='username' placeholder='Kullanıcı Adınızı Giriniz' required='required' x-moz-errormessage='Kullanıcı Adınızı Girmediniz.' title ='Kullanıcı Adınızı Girmediniz'>
            </div>
        </div>
        <div class='control-group'>
            <label class='control-label'>Şifre:</label>
            <div class='controls'>
                <input type='password' name='psw' placeholder='Şifrenizi Giriniz' required='required'x-moz-errormessage='Şifrenizi Girmediniz.' title='Şifrenizi Girmediniz.'>
            </div>
        </div>
        <div class='control-group'>
            <div class='controls'>
                <button type='submit' class='btn btn-primary'>GİRİŞ</button>
            </div>
        </div>";

        if(isset($_POST['username'])&& isset($_POST['psw'])){
            $username=$_POST['username'];
            $psw=$_POST['psw'];
            include 'connection.php';
            $query_control=mysql_query("select * from users where username='$username'");
            $sonuc=mysql_fetch_array( $query_control);
            if (($username==$sonuc['username']) && ($psw== $sonuc['password']))
            {
                $_SESSION['id']=$sonuc['U_ID'];
                $_SESSION['rol']=$sonuc['role'];
                $rol=$sonuc['role'];
                switch ($rol){
                    case '1':
                        header('location:ana.php');
                        break;
                    case '2':
                        header('location:teacher_page.php');
                        break;
                    case '3':
                        header('location:student_page.php');
                        break;
                }
            }else{
                echo "<div class='alert alert-danger'style='width: 250px;margin: 10px auto;text-align: center;'>Kullanıcı adı ve şifreniz hatalı</div>";

            }

        }
        ?>

</div>
</form>
</div>
</body>
</html>