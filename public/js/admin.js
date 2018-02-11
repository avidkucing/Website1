$(document).ready(function(){

    if(window.location.hash) { // just in case there is no hash
        var hash = window.location.hash.substr(1).split('-');
        activate_menu(hash[0]);
        if (hash[1]) {
            activate_tab(hash[1]);
        }
    } else {
        activate_menu('lpb');
        activate_tab('baku');
    }

    $('#lpb-tab a').on('click', function (e) {
        $(this).tab('show');
    })

    var dataTable = $('.decorated').DataTable({
        
    });

    var change_pass = false;

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
                var password = newdata[0].Password;
            },
        })
    });

    $('#change').click(function(){
        $("#passdiv").show();
        $(this).hide();
        $("#password").addClass("required");
        change_pass = true;
    });

    $('#delete').click(function(){
        var uname = $('#uname').val();

        $.ajax({
            url : "Admin/delete_user",
            type: "post",
            data: {
                "uname":uname,
            }
        })
        
        window.location.reload();
    });

    $('#save').click(function(){
        $('#form-edit').validate({
            ignore: '',
            rules: {
                password: {
                    minlength: 8
                }
            },
            submitHandler: function(form) {
                if (change_pass) {
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

                    change_pass = false;
                } else {
                    var tipe = $('#tipe').val();
                    var nama = $('#nama').val();
                    var uname = $('#uname').val();
                        
                    $.ajax({
                        url : "Admin/update_data_user_nopass",
                        type: "post",
                        data: {
                            "tipe":tipe,
                            "nama":nama,
                            "uname":uname,
                            
                        }
                    })    
                }

                $("#editor").modal('hide');
                $("#passdiv").hide();
                $("#change").show();
                
                window.location.reload();
            }
        });
        //$('#form-edit').submit()
        
    });

    function activate_menu(menu) {
        $(".menu").removeClass("active");
        $("#"+menu+"").addClass("active");
        $(".content").hide();
        $("#"+menu+"-content").fadeIn("slow");
    }

    function activate_tab(tab) {
        $('#lpb-tab #'+tab+'-tab').tab('show');
    }

    $(".menu").click(function(){
        activate_menu(this.id);
    })

});