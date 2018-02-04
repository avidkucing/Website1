$(document).ready(function(){

    var dataTable = $('.decorated').DataTable({
        
    });

    $("#akun-content table tr td").addClass("klik");
    
    $('.klik').click(function(){
        $('#editor').modal('show');
        var value = $(this).data('id');
        $.ajax({
            url : "Admin/get_data_user",
            type: "post",
            data: {"value":value},
            success : function(data){
                var newdata = JSON.parse(data);
                $("#uname").val(newdata[0].Username);
                $("#nama").val(newdata[0].Nama);
                $("#tipe").val(newdata[0].Tipe_Pegawai);
            },
        })
    });

    $('#save').click(function(){
        var tipe = $('#tipe').val();
        var nama = $('#nama').val();
        var uname = $('#uname').val();
        var password = $('#password').val();
        $.ajax({
            url : "Admin/update_data_user",
            type: "post",
            data: {
                "tipe":tipe,
                "nama":nama,
                "uname":uname,
                "password":password,
            }
        })

        window.location.reload();
    });

    $("#bahan").click(function(){
        $("#akun").removeClass("active");
        $("#bahan").addClass("active");
        $("#akun-content").hide();
        $("#bahan-content").fadeIn("fast");
    });

    $("#akun").click(function(){
        $("#bahan").removeClass("active");
        $("#akun").addClass("active");
        $("#bahan-content").hide();
        $("#akun-content").fadeIn("fast");
    });

});