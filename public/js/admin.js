$(document).ready(function(){

    $("#bahan").click(function(){
        $("#akun, #surat").removeClass("active");
        $("#bahan").addClass("active");
        $("#akun-content, #surat-content").hide();
        $("#bahan-content").fadeIn("fast");
    });

    $("#surat").click(function(){
        $("#akun, #bahan").removeClass("active");
        $("#surat").addClass("active");
        $("#akun-content, #bahan-content").hide();
        $("#surat-content").fadeIn("fast");
    });

    $("#akun").click(function(){
        $("#bahan, #surat").removeClass("active");
        $("#akun").addClass("active");
        $("#bahan-content, surat-content").hide();
        $("#akun-content").fadeIn("fast");
    });
});