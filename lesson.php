<?php
include "ust.php";
include ('connection.php');
?>
<div class="container-fluid">
    <div class="row-fluid">

        <div class="span2">
            <div class="well">

            </div>
        </div>

        <div class="span10">
            <div class="well">
                <div id='div_alert'>
                </div>
<?php
$islem=$_GET['islem'];
switch($islem){

    case 'insert':
        echo "
        <form class='form-horizontal' name='insert' method='POST' action='lesson.php?islem=mysql_insert' enctype='multipart/form-data' >

                <div class='control-group'>
                    <label class='control-label'>Ders Kodu :</label>
                    <div class='control-group'>
                    <input type='text' name='l_kod' value='' required='required' placeholder='Ders Kodu Giriniz'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Ders Adı :</label>
                    <div class='control-group'>
                    <input type='text' name='l_name'  value='' required='required'placeholder='Ders Adı Giriniz'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <div class='controls'>
                    <button type='submit' id='tamam' class='btn btn-primary'>EKLE</button>
                </div></div>
       </form>";
        break;


    case 'edit':
        $id=$_GET['id'];
        $sorgu=mysql_query("select * from lesson where L_ID='$id'");
        $veri=mysql_fetch_array($sorgu);
        $id=$veri['L_ID'];
        $ders_kodu=$veri['lesson_code'];
        $ders_adi=$veri['lesson_name'];

        echo "
        <form class='form-horizontal' name='insert' method='POST' action='lesson.php?islem=mysql_update&id= $id' enctype='multipart/form-data' >

                <div class='control-group'>
                    <label class='control-label'>Ders Kodu :</label>
                    <div class='control-group'>
                    <input type='text' name='l_kod' value='$ders_kodu' required='required' placeholder='Ders Kodu Giriniz'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Ders Adı :</label>
                    <div class='control-group'>
                    <input type='text' name='l_name'  value=' $ders_adi' required='required'placeholder='Ders Adı Giriniz'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <div class='controls'>
                    <button type='submit' id='tamam' class='btn btn-primary'>GÜNCELLE</button>
                </div></div>
       </form>";
        break;

    case 'list':
        echo "<p style='text-align: center;font-weight:bold; '>!!! Düzenleme İşlemlerini Tablo Elemanlarına Tıklayarakta Yapabilirsiniz !!!</p>
               <table id='list_table' class='tablesorter'>
                <thead>
                <tr>
                <th>Kayıt No</th>
                <th>Ders Kodu</th>
                <th>Ders Adı</th>
                <th>İşlem</th>
                </tr>
                </thead>
                <tbody>";
            $query1 = mysql_query("select * from lesson ");
            while($sonuc1 = mysql_fetch_array($query1)){
                echo"<tr>";
                $sayac=1;
                foreach ($sonuc1 as $column => $değer) {
                    if(!is_numeric($column)){
                        if($column!='L_ID'){
                            echo '<td id="edit" ><a href="#" id="'.$column.'__'.$sonuc1["L_ID"].'" data-type="text" data-pk='.$sonuc1["L_ID"].' data-url="ajax_update.php?tablo=lesson&filtre=L_ID" data-title=" Update İşlemi" value="'.$değer.'">'.$değer.'</a></td>';
                        }else{
                            echo '<td id="" ><a href="#" id="'.$column.'__'.$sonuc1["L_ID"].'" value="'.$değer.'">'.$değer.'</a></td>';
                        }
                    }
                }

                echo "<td>
                        <a href='lesson.php?islem=edit&id={$sonuc1[0]}'><button class='btn btn-mini btn-warning' type='button'><i class='icon-pencil'></i> Düzenle</button></a>
                        <a href='lesson.php?islem=mysql_delete&id={$sonuc1[0]}'><button class='btn btn-mini btn-danger' type='button'><i class='icon-trash'></i>Sil</button></a>
                     </td></tr>";
            }
            echo '</tbody></table>
            <script>$(document).ready(function()
            {
             $("#list_table").tablesorter();
             $.each( $("#edit > *"), function( key, value ) {
                   $("#"+value.id).editable({
                 });
              });


            });
</script>';




        break;

    case 'student_assignment':
        break;

    case 'teacher_assignment':
        break;

    case 'mysql_insert':
        if(isset($_POST['l_kod'])and isset($_POST['l_name'])){
           $ders_kodu=$_POST['l_kod'];
           $ders_adi=$_POST['l_name'];
           if(mysql_query("INSERT INTO  `okul`.`lesson` (
                `L_ID` ,
                `lesson_code` ,
                `lesson_name`
                )
                VALUES (
                NULL ,  '$ders_kodu',  '$ders_adi'
                );")){
               header('Location:lesson.php?islem=insert');
                echo "<script>alert('Kayıt Başarılı'); </script>";
            }else{
                echo "<script>alert('Veri tabanına kayıt başarısız '); history.back(-1)</script>";
            }

        }else{


            echo  "<script>alert('Lütfen Boş Olan Alanları Doldurunuz'); history.back(-1)</script>";
        }
        break;



    case 'mysql_update':
        $id=$_GET['id'];
        if(isset($_POST['l_kod'])and isset($_POST['l_name'])){
            $ders_kodu=$_POST['l_kod'];
            $ders_adi=$_POST['l_name'];

            if(mysql_query("UPDATE lesson SET lesson_code='$ders_kodu',
                                       lesson_name='$ders_adi'

                where L_ID=$id")){
                header('Location:lesson.php?islem=list');
        }else{
                echo 'Güncelleme Başarısız';
            }

        }else{


            echo  "<script>alert('Lütfen Boş Olan Alanları Doldurunuz'); history.back(-1)</script>";
        }
        break;




    case 'mysql_delete':
            $id=$_GET['id'];

                $sorgu="delete from lesson where L_ID='$id'";
                if(mysql_query($sorgu)){
                    header('Location:lesson.php?islem=list');

                }else{
                    echo "<script>alert('İşlem Başarısız'); history.back(-1)</script>";
                }



            break;


}

?>
<?php include "alt.php";
?>