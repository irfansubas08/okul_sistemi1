$(document).ready(function()
    {
        $(function(){
                $('#username').change(function(){
                    var username = $( '#username' ).val();
                    var giden = 'veri='+ username
                    $.ajax({
                       type: "POST",
                       url: "ajax_kontrol.php",
                       data: giden,
                       cache: false,
                       success: function(gelen){
                           console.log(gelen)
                           if(gelen==1)
                           {
                               $('#username').focus();
                               $('#username').css({'background-color' :'red'});
                               $('#tamam').prop('disabled', true);
                               alert('Sistemde Aynı Kullanıcı Adına Sahip Biri Var')
                               $( '#username' ).val('');


                           }else{

                               $('#username').css({'background-color' :'#FFF'});
                               $('#tamam').prop('disabled', false);
                           }
                       }

                    });
                })
            }
        );
    });


$(document).ready(function()
                {
                    var role = $( '#role' ).val();
                    if(role==1 || role==2)
                    {
                    $('#sinif').val('').attr("selected", "selected");
                    $('#sube').val('').attr("selected", "selected");
                    $('#sinif').prop('disabled', true);
                    $('#sube').prop('disabled', true);
                    $('#student_number').prop('disabled', true);
                    $('#student_number').val('')


                    }
else {
    $('#sinif').prop('disabled', false);
    $('#sube').prop('disabled', false);
    $('#student_number').prop('disabled', false);

    }
}
);
$(function(){
    $('#role').change(function(){
        var role = $( '#role' ).val();
        var sinif = $( '#sinif' ).val();
        var sube = $( '#sube' ).val();

        if(role==1 || role==2)
        {
            $('#sinif').val('').attr("selected", "selected");
            $('#sube').val('').attr("selected", "selected");
            $('#sinif').prop('disabled', true);
            $('#sube').prop('disabled', true);
            $('#student_number').prop('disabled', true);
            $('#student_number').val('')

        }
else {
    $('#sinif').prop('disabled', false);
    $('#sube').prop('disabled', false);
    $('#student_number').prop('disabled', false);

    }

})

$('#knt_password').change(function(){
    var sifre1 = $( '#password' ).val();
    var sifre_knt = $( '#knt_password' ).val();
    if(sifre1 == sifre_knt){
    $('#tamam').prop('disabled', false);
    }
else{
    $('#tamam').prop('disabled', true);
    alert("Şifreler eşleşmiyor",{type: 'error'});
        $( '#knt_password').focus();
}
})


$('#password').change(function(){
    var sifre1 = $( '#password' ).val();
    var sifre_knt = $( '#knt_password' ).val();
    if(sifre_knt){
    if(sifre1 == sifre_knt){
    $('#tamam').prop('disabled', false);
    }
else{
    $('#tamam').prop('disabled', true);
    alert("Şifreler eşleşmiyor",{type: 'error'});
}
}


})


$('#tc_no').change(function(){
    var role = $( '#role' ).val();
    console.log(role)
    if(role==3 || role==0)
    {
        var tc_no = $( '#tc_no' ).val();
        console.log($.trim($("#tc_no").val()).length)

        var student_number = $( '#student_number' ).val();
        if((parseInt(tc_no)%2)!=0 || $.trim($("#tc_no").val()).length!=11 || !$.isNumeric(tc_no)){
            $('#tamam').prop('disabled', true);
            alert("Düzgün giriş yapmadınız TC Kimlik no 11 haneli ve son hanesi çift sayı olmalıdır.");
        }
        else{
            $('#tamam').prop('disabled', false);
        }
    }else{
        var tc_no = $( '#tc_no' ).val();

        if($.isNumeric(tc_no)){
            $('#tamam').prop('disabled', false);

        }else{

            $('#tamam').prop('disabled', true);
            alert("Lütfen sayısal veriler giriniz");
        }
    }



})

$('#student_number').change(function(){
    var role = $( '#role' ).val();
    if(role==2 || role==0)
    {
        var student_number = $( '#student_number' ).val();

        if(($.trim($("#student_number").val()).length!=8 || !$.isNumeric(student_number))){
            $('#tamam').prop('disabled', true);
            alert("Düzgün giriş yapmadınız Öğrenci Numarası no 8 haneli ve sayısal değer olmalıdır.");
        }
        else{
            $('#tamam').prop('disabled', false);
        }
        }else{
        var student_number = $( '#student_number' ).val();

        if($.isNumeric(student_number)){
            $('#tamam').prop('disabled', false);

        }else{

            $('#tamam').prop('disabled', true);
            alert("Lütfen sayısal veriler giriniz");
        }
    }


})



});


$(function(){
    $('#user').submit(function(e){
        var role = $( '#role' ).val();
        var sinif = $( '#sinif' ).val();
        var sube = $( '#sube' ).val();

        if(role=='' || sinif=='' || sube=='')
        {
            if(role==3||role==''){
                alert  ("Lütfen seçilmesi gereken alanları seçiniz")
                if(role=='')
                {
                    $('#role').focus();
                }
if(sinif=='')
                        {
                            $('#sinif').focus();
                            }
if(sube=='')
                        {
                            $('#sube').focus();
                            }
e.preventDefault();
}

}

});

})

