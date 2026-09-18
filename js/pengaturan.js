// cek kecocokan ulangi password
$("#ModalTambahAkun").ready(function(){

    $("#ulangi_password").keyup(function(){
        if($("#ulangi_password").val() == $("#password").val()){
            $("#notif_pass").html("Password cocok");
            $("#notif_pass").removeClass("text-danger");
            $("#notif_pass").addClass("text-success");
            $("#btn_addAkun").removeAttr("disabled");
        }else{
            $("#notif_pass").html("Password tidak cocok");
            $("#notif_pass").addClass("text-danger");
            $("#notif_pass").removeClass("text-success");
            $("#btn_addAkun").attr("disabled","disabled");
        }
    });

});
