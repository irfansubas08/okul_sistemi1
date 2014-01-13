<?php
include ('connection.php');
include ('ust.php');
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
if(isset($_GET['islem'])){
    $islem=$_GET['islem'];
    switch ($islem){

        case 'upload_user':
             echo "
            <div well>
                <form class='form-horizontal' name='insert' id='user'  method='post' action='user.php?islem=upload' enctype='multipart/form-data'>
                <div class='control-group'>
                        <label class='control-label'>Dosya Seç :</label>
                        <div class='control-group'>
                        <input type='file' name='file' accept='.csv'><small style='color:red'>Lütfen Metin ayırıcısı olarak ; olarak seçiniz</small>
                    </div></div>
                    <div class='control-group'>
                        <label class='control-label'>Operator :</label>
                        <div class='control-group'>
                     <select name='operator' id='operator' class='span1'>
                        <option value=';' selected='selected'>;</option>
                        <option value=',' style='font-weight:bold;'>,</option>
                    </select>
                </div></div>
                    <div class='control-group'>
                        <div class='controls'>
                        <button type='submit' id='tamam' class='btn btn-success'>Yükle</button>
                    </div></div>
                </form>
                </div>";

            break;

        ###### Kullanıcı Ekleme Formu######
        case 'insert':
            echo "
            <div well>
                <form class='form-horizontal' name='insert' id='user'  method='post' action='user.php?islem=mysql_insert' enctype='multipart/form-data'>

                <div class='control-group'>
                    <label class='control-label'>Kullanıcı Adı :</label>
                    <div class='control-group'>
                    <input type='text' name='username' id='username' required='required' placeholder='Kullanıcı adınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Ad :</label>
                    <div class='control-group'>
                    <input type='text' name='firstname' required='required'placeholder='Adınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>

                <div class='control-group'>
                    <label class='control-label'>Soyad :</label>
                    <div class='control-group'>
                    <input type='text' name='lastname' required='required' placeholder='Soyadınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Şifre :</label>
                    <div class='control-group'>
                    <input type='password' name='password' id='password' maxlength='8' required='required' placeholder='Şifrenizi giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Şifre Tekrar Giriniz :</label>
                    <div class='control-group'>
                    <input type='password' name='knt_password'  id='knt_password' maxlength='8' required='required' placeholder='Şifrenizi tekrardan giriniz.'>
                </div></div>
                <div class='control-group'>
                    <label class='control-label' id='sinif_label'>Sınıf:</label>
                    <div class='control-group'>
                    <select name='sinif' id='sinif'>
                        <option value='' selected='selected'>Seçiniz</option>";
            for ($i=1;$i<9;$i++){
                echo "<option value='$i'>$i</option>";
            };
            echo " </select>
                </div></div>
                 <div class='control-group'>
                    <label class='control-label'id='sube_label'>Şube:</label>
                    <div class='control-group'>
                <select name='sube' id='sube'>
                        <option value='' selected='selected'>Seçiniz</option>
                        <option value='A'>A</option>
                        <option value='B'>B</option>
                        <option value='C'>C</option>
                        <option value='D'>D</option>
                </select>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>T.C Kimlik No :</label>
                    <div class='control-group'>
                    <input type='text' name='tc_no'  id='tc_no' required='required' maxlength='11'  placeholder='T.C Kimlik numaranızı giriniz.'>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Öğrenci No :</label>
                    <div class='control-group'>
                    <input type='text' name='student_number' id='student_number' maxlength='8' required='required' placeholder='Öğrenci Numaranızı giriniz.'>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Rol:</label>
                    <div class='control-group'>
                    <select name='role' id='role'>
                        <option value='' selected='selected'>Seçiniz</option>
                        <option value='1'>Admin</option>
                        <option value='2'>Öğretmen</option>
                        <option value='3'>Öğrenci</option>
                    </select> <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Resim Yükle :</label>
                    <div class='control-group'>
                    <input type='file' name='image' accept='.jpg,.jpeg,.png'>
                </div></div>
                <div class='control-group'>
                    <div class='controls'>
                    <button type='submit' id='tamam' class='btn btn-primary'>EKLE</button>
                </div></div>
                </form>
            </div>
            ";
            break;

        case 'edit':
            ###### Kullanıcı Düzenleme Formu######
            $id=$_GET['id'];
            $sorgu=mysql_query("select * from users where U_ID='$id'");
            $veri=mysql_fetch_array($sorgu);
            $id=$veri['U_ID'];
            $username=$veri['username'];
            $firstname=$veri['firstname'];
            $lastname=$veri['lastname'];
            $role=$veri['role'];
            $sube=$veri['sube'];
            $sinif=$veri['sinif'];
            $password=$veri['password'];
            $student_number=$veri['student_number'];
            $tc_no=$veri['tc_no'];
            $file=$veri['image'];

            $selected="selected='selected'";
            $non='';
            echo $role == 3 ? $selected :'';
            echo "
            <div well>

                <form class='form-horizontal' name='insert' method='POST' action='user.php?islem=mysql_update&id=$id' enctype='multipart/form-data' >

                <div class='control-group'>
                    <label class='control-label'>Kullanıcı Adı :</label>
                    <div class='control-group'>
                    <input type='text' name='username' value='$username' required='required' placeholder='Kullanıcı adınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Ad :</label>
                    <div class='control-group'>
                    <input type='text' name='firstname'  value='$firstname' required='required'placeholder='Adınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>

                <div class='control-group'>
                    <label class='control-label'>Soyad :</label>
                    <div class='control-group'>
                    <input type='text' name='lastname'  value='$lastname' required='required' placeholder='Soyadınızı giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Şifre :</label>
                    <div class='control-group'>
                    <input type='password' name='password'  value='$password' required='required' placeholder='Şifrenizi giriniz.'>  <small style='color:red'>*</small>
                </div></div>
                 <div class='control-group'>
                    <label class='control-label'>Sınıf:</label>
                    <div class='control-group'>
                    <select name='sinif' id='sinif'>
                        <option value='' selected='selected'>Seçiniz</option>";
            for ($i=1;$i<9;$i++){
                echo "<option value='$i'"; echo $sinif == $i ?$selected:$non; echo ">$i</option>";
            };
            echo " </select> <small style='color:red'>*</small>
                </div></div>
                 <div class='control-group'>
                    <label class='control-label'>Şube:</label>
                    <div class='control-group'>
                <select name='sube' id='sube'>
                        <option value='' selected='selected' >Seçiniz</option>
                        <option value='A'"; echo $sube == 'A' ?$selected:$non; echo ">A</option>
                        <option value='B'"; echo $sube == 'B' ?$selected:$non; echo ">B</option>
                        <option value='C'"; echo $sube == 'C' ?$selected:$non; echo ">C</option>
                        <option value='D'"; echo $sube == 'D' ?$selected:$non; echo ">D</option>
                </select> <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>T.C Kimlik No :</label>
                    <div class='control-group'>
                    <input type='text' name='tc_no'  id='tc_no' value='$tc_no' required='required' maxlength='11'  placeholder='T.C Kimlik numaranızı giriniz.'>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Öğrenci No :</label>
                    <div class='control-group'>
                    <input type='text' name='student_number' id='student_number'  maxlength='8' value='$student_number' required='required' placeholder='Öğrenci Numaranızı giriniz.'>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Rol:</label>
                    <div class='control-group'>
                    <select name='role' id='role'>
                        <option value='' selected='selected' >Seçiniz</option>
                        <option value='1'"; echo $role == 1 ?$selected:$non; echo ">Admin</option>
                        <option value='2'"; echo $role == 2 ?$selected:$non; echo ">Öğretmen</option>
                        <option value='3'"; echo $role == 3 ?$selected:$non; echo ">Öğrenci</option>
                    </select> <small style='color:red'>*</small>
                </div></div>
                <div class='control-group'>
                    <label class='control-label'>Resim Yükle :</label>
                    <div class='control-group'>
                    <input type='file' name='resim' value=' $file' accept='.jpg,.jpeg,.png'>
                </div></div>
                 <div class='control-group'>
                    <div class='controls'>
                    <button type='submit' class='btn btn-primary'>GÜNCELLE</button>
                </div></div>
                </form>
            </div>
            ";

            break;

        case 'list':
         echo" <p style='text-align: center;font-weight:bold; '>!!! Düzenleme İşlemlerini Tablo Elemanlarına Tıklayarakta Yapabilirsiniz !!!</p>
                <table id='list_table' class='tablesorter'>
                <thead>
                <tr>
                <th>Kayıt No</th>
                <th>Kullanıcı Adı</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>T.C No</th>
                <th>Öğrenci No</th>
                <th>Rol</th>
                <th>İşlem</th>
                </tr>
                </thead>
                <tbody>";
            $query1 = mysql_query("select U_ID,username,firstname,lastname,tc_no,student_number,role from users");
            while($sonuc1 = mysql_fetch_array($query1)){


                echo"<tr>";
                foreach ($sonuc1 as $column => $değer) {
                    if(!is_numeric($column)){
                        if($column=='role'){
                            $duzey=$sonuc1[$column];
                            switch ($duzey){
                                case 1:
                                    echo '<td id="edit" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" data-type="select" data-pk='.$sonuc1["U_ID"].' data-url="ajax_update.php?tablo=users&filtre=U_ID" data-title=" Update İşlemi" value="1">ADMİN</a></td>';

                                    break;
                                case 2:
                                    echo '<td id="edit" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" data-type="select" data-pk='.$sonuc1["U_ID"].' data-url="ajax_update.php?tablo=users&filtre=U_ID" data-title=" Update İşlemi" value="2">ÖĞRETMEN</a></td>';

                                    break;
                                case 3:
                                    echo '<td id="edit" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" data-type="select" data-pk='.$sonuc1["U_ID"].' data-url="ajax_update.php?tablo=users&filtre=U_ID" data-title=" Update İşlemi" value="3">ÖĞRENCİ</a></td>';
                                    break;
                            }

                    }else{
                        if($column=='student_number' and ($sonuc1["role"]=='1' or $sonuc1["role"]=='2')){
                           echo '<td id="" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" value="'.$değer.'">'.$değer.'</a></td>';
                        }elseif($column!='U_ID'){
                            echo '<td id="edit" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" data-type="text" data-pk='.$sonuc1["U_ID"].' data-url="ajax_update.php?tablo=users&filtre=U_ID" data-title=" Update İşlemi" value="'.$değer.'">'.$değer.'</a></td>';
                        }else{
                            echo '<td id="" ><a href="#" id="'.$column.'__'.$sonuc1["U_ID"].'" value="'.$değer.'">'.$değer.'</a></td>';
                        }

                    }
                }
                }

                echo "<td>
                        <a href='user.php?islem=edit&id={$sonuc1[0]}'><button class='btn btn-mini btn-warning' type='button'><i class='icon-pencil'></i> Düzenle</button></a>
                        <a href='user.php?islem=mysql_delete&id={$sonuc1[0]}'><button class='btn btn-mini btn-danger' type='button'><i class='icon-trash'></i>Sil</button></a>
                     </td></tr>";

            }
            echo '</tbody></table>

          <script>
          $(document).ready(function(){

             $("#list_table").tablesorter();

             $.each( $("#edit > *"), function( key, value1 ) {

             var knt =   value1.id.split("__")
                    if(knt[0]=="role")
                    {

                         $("#"+value1.id).editable({

                        type: "select",
                        title: "Select status",
                        placement: "left",
                        value: ($("#"+value1.id).attr("value")),
                        source: [
                            {value: 1, text: "ADMİN"},
                            {value: 2, text: "ÖĞRETMEN"},
                            {value: 3, text: "ÖĞRENCİ"}
                        ]

                         });
                    }
                    else
                    {
                         $("#"+value1.id).editable({
                         });
                    }
             });

          });

            </script>';
            break;

#######veritabanına kayıt ekleme############
        case 'mysql_insert':

            if(isset($_POST['username'])and isset($_POST['firstname']) and isset($_POST['lastname'])and isset($_POST['password'])){
                $username=$_POST['username'];
                $firstname=$_POST['firstname'];
                $lastname=$_POST['lastname'];
                $role=$_POST['role'];
                $password=$_POST['password'];
                $tc_no=$_POST['tc_no'];
                error_reporting(0);

                $_POST['student_number']==''?$student_number='0':$student_number=$_POST['student_number'];
                $_POST['sinif']==''?$sinif=$_POST['sinif']='0':$sinif=$_POST['sinif'];
                $_POST['sube']==''?$sube=$_POST['sube']='0':$sube=$_POST['sube'];


                $zaman=getdate();
                $dosya_name=$username."_".$zaman[0];
                if(!empty($_FILES['image']['name'])) {
                    $eski_ad = $_FILES['image']['name'];
                    $uzanti=explode('.',$eski_ad);
                    $yuklenecek_dosya = './images/'.$dosya_name.".".$uzanti[1];
                    $image_url='';
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $yuklenecek_dosya)){
                        $image_url=$yuklenecek_dosya = './images/'.$dosya_name.".".$uzanti[1];
                        //echo $image_url;
                    }
                }
                else {
                    echo "<script>alert('Lütfen Resim Seçiniz'); history.back(-1)</script>";
                    //echo "<script>history.back(-1)</script>";
                   /* echo "
                    <script>(document).ready(function(){
                    $('#div_alert').html("."'<div class=' alert alert-danger fade in'>
                    <button type='button'class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <strong>Lütfen bir resim yükleyiniz</strong></div>'".");
                          });

                    </script>";*/
                    break;

                }


                if(mysql_query("INSERT INTO users (username,firstname,lastname,role,password,sinif,sube,student_number,tc_no,image) values (
                        '$username',
                        '$firstname',
                        '$lastname',
                        '$role',
                        '$password',
                        '$sinif',
                        '$sube',
                        '$student_number',
                        '$tc_no',
                        '$image_url'
                )")){
                   header('Location:user.php?islem=insert');
                   echo "<script>alert('Kayıt Başarılı'); </script>";
               }else{
                    echo "<script>alert('Veri tabanına kayıt başarısız '); history.back(-1)</script>";
                }
            }
            else{

                echo "<script>alert('Lütfen Zorunlu Alanları Boş Bırakmayınız'); history.back(-1)</script>";
            }



            break;


        case 'mysql_update':
            $id=$_GET['id'];
            if(isset($_POST['username'])and isset($_POST['firstname']) and isset($_POST['lastname'])and isset($_POST['password'])){
                if($sorgu=mysql_query("select image from users where U_ID=".$id)){
                    $user_url=mysql_fetch_row($sorgu)[0];

                }
                $username=$_POST['username'];
                $firstname=$_POST['firstname'];
                $lastname=$_POST['lastname'];
                $role=$_POST['role'];
                $password=$_POST['password'];
                $tc_no=$_POST['tc_no'];
                error_reporting(0);
                $_POST['student_number']==''?$student_number='0':$student_number=$_POST['student_number'];
                $_POST['sinif']==''?$sinif=$_POST['sinif']='0':$sinif=$_POST['sinif'];
                $_POST['sube']==''?$sube=$_POST['sube']='0':$sube=$_POST['sube'];
                // Dosya isim belirleme prosedürü
                $zaman=getdate();
                $dosya_name=$username."_".$zaman[0];

                if(!empty($_FILES['resim']['name'])) {
                    echo 'resim var';
                    unlink($user_url);
                    $eski_ad = $_FILES['resim']['name'];
                    $uzanti=explode('.',$eski_ad);
                    $yuklenecek_dosya = './images/'.$dosya_name.".".$uzanti[1];
                    $image_url='';
                    if(move_uploaded_file($_FILES['resim']['tmp_name'], $yuklenecek_dosya)){
                        $image_url=$yuklenecek_dosya = './images/'.$dosya_name.".".$uzanti[1];
                    }
                } else {
                    echo 'eski isim';
                    $image_url= $user_url;
                }


                if(mysql_query("UPDATE users SET username='$username',
                                       firstname='$firstname',
                                       lastname='$lastname',
                                       role='$role',
                                       password='$password',
                                       sube='$sube',
                                       sinif='$sinif',
                                       student_number='$student_number',
                                       tc_no='$tc_no',
                                       image='$image_url'

                where U_ID=$id")){
                   header('Location:user.php?islem=list');
                }else{
                    echo 'Güncelleme Başarısız';
                }
            }
            else{

                echo "<script>history.back(-1)</script>";
                echo '<a class="close" data-dismiss="alert" href="#" aria-hidden="true">Lütfen Zorunlu Alanları Boş Bırakmayınız</a>';
            }

            break;

        case 'upload':
            $operator=$_POST['operator'];
            $zaman=getdate();
            $dosya_name='upload_user'."_".$zaman[0];
            if(!empty($_FILES['file']['name'])) {
                $eski_ad = $_FILES['file']['name'];
                $uzanti=explode('.',$eski_ad);
                $yuklenecek_dosya = './upload/'.$dosya_name.".".$uzanti[1];
                $image_url='';
                if(move_uploaded_file($_FILES['file']['tmp_name'], $yuklenecek_dosya)){
                    $upload_dosya=$yuklenecek_dosya = './upload/'.$dosya_name.".".$uzanti[1];
                    //echo $image_url;
                }
            }
            else {
                echo "<script>alert('Lütfen Resim Seçiniz'); history.back(-1)</script>";
                break;

            }
            $dosya=fopen( $upload_dosya,'r');
            $sayac=0;
            while( !feof( $dosya ) ){
                $satir_yukle=[];
                $satir=explode(';',fgets( $dosya ));
            if($sayac){
                for($i=0;$i<count($satir);$i++){
                    $satir_yukle[$i]=$satir[$i];
                }
                if(mysql_query("INSERT INTO users (username,firstname,lastname,password,sinif,sube,role,student_number,tc_no,image) values (
                    '$satir_yukle[0]',
                    '$satir_yukle[1]',
                    '$satir_yukle[2]',
                    '$satir_yukle[3]',
                    '$satir_yukle[4]',
                    '$satir_yukle[5]',
                    '$satir_yukle[6]',
                    '$satir_yukle[7]',
                    '$satir_yukle[8]',
                    '$satir_yukle[9]'
            )")){
                }else{
                    echo "veri tabanına yüklemede hata";
                    break;
                }
            }
            $sayac++;
    }
            $sayac=0;
            fclose($dosya);
            unlink($upload_dosya);
            header('Location:user.php?islem=list');
            break;


        case 'mysql_delete':
            $id=$_GET['id'];
            $oturum_id=$_SESSION['id'];
            if($id!=$oturum_id){
                $sorgu="delete from users where U_ID='$id'";
                if(mysql_query($sorgu)){
                    header('Location:user.php?islem=list');

                }else{
                    echo "<script>alert('İşlem Başarısız'); history.back(-1)</script>";
                }
            }else{
                echo "<script>alert('Oturum Kullanıcısının bilgisini silemezsiniz.'); history.back(-1)</script>";
            }


            break;


    }
}else{
    echo 'Bişey Göndermedinki gardaş!!!';
}
?>

</div>
</div>
</div>
</div>

<?php
include ('alt.php');
?>