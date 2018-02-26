$(document).ready(function(){

    if(window.location.hash) { // just in case there is no hash
        var hash = window.location.hash.substr(1).split('-');
        if (hash[1]==null) {
            hash[1] = 'baku';
        }
    } else {
        var hash = ['lpb', 'baku'];
    }
    //default state
    activate_tab('lpb', hash[1]);
    activate_tab('stock', hash[1]);
    activate_menu(hash[0]);

    var dataTable = $('.decorated').DataTable({});

    var change_pass = false;

    $(".menu").click(function(){
        activate_tab(this.id, 'baku');
        activate_menu(this.id);
    })

    $('.nav-tabs a').on('click', function(e){
        $(this).tab('show');
    })

    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        hash = window.location.hash.substr(1).split('-');
        if (hash[1]==null) {
            hash[1] = 'baku';
        }
    })

    $(".print-all").click(function(){
        if(hash[0]=='lpb') {
            $link = window.location.origin + "/manufaktur/lpb/print_all/" + hash[1];
            window.location.href=$link ;
        }
    });

    $("#tglminta").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true
    });

    $('#lpb-content table tr td').addClass("lpb-row")
    $("#akun-content table tr td").addClass("akun-row");
    $("#permintaan-content table tr td").addClass("permintaan-row");
    $("#stock-content table tr td").addClass("stock-row");

    $('.lpb-row').click(function(){
        $link = window.location.origin + "/manufaktur/lpb/print_lpb/" + (this.id);
        window.location.href=$link ;
    });
    $('.akun-row').click(function(){
        $('#akun-editor').modal('show');
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
    $('.permintaan-row').click(function(){
        $('#permintaan-editor').modal('show');
        var value = $(this).data('id');
        $.ajax({
            url : "Admin/get_data_permintaan",
            type: "post",
            data: {"value":value},
            success : function(data){
                var newdata = JSON.parse(data);
                $("#noins").val(newdata[0].Nomor_Instruksi);
                $("#site").val(newdata[0].Site_Produksi);
                $("#tglminta").val(newdata[0].Tanggal_Permintaan);
            },
        })
    });
    /*$('.stock-row').click(function(){
        $('#stock-editor').modal('show');
        var value = $(this).data('id');
        $.ajax({
            url : "Admin/get_data_stock",
            type: "post",
            data: {"value":value},
            success : function(data){
                var newdata = JSON.parse(data);
                $("#noana").val(newdata[0].Nomor_Analisa);
                $("#kode").val(newdata[0].Kode_Bahan);
                $("#manu").val(newdata[0].Nama_Manufacturer);
                $("#exp").val(newdata[0].EXP_Date);
                $("#jumlah").val(newdata[0].Jumlah);
                $("#ket").val(newdata[0].Keterangan);
            },
        })
    });*/

    $('#change').click(function(){
        $("#passdiv").show();
        $(this).hide();
        $("#password").addClass("required");
        change_pass = true;
    });

    $('#delete-akun').click(function(){
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
    $('#save-akun').click(function(){
        $('#akun-form').validate({
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

                $("#akun-editor").modal('hide');
                $("#passdiv").hide();
                $("#change").show();
                
                window.location.reload();
            }
        });
        //$('#form-edit').submit()  
    });

    $('#delete-permintaan').click(function(){
        var noins = $('#noins').val();

        $.ajax({
            url : "Admin/delete_permintaan",
            type: "post",
            data: {
                "noins":noins,
            }
        })
        
        window.location.reload();
    });
    $('#save-permintaan').click(function(){
        $('#permintaan-form').validate({
            ignore: '',
            rules: {
                
            },
            submitHandler: function(form) {
                
                var noins = $('#noins').val();
                var site = $('#site').val();
                var tglminta = $('#tglminta').val();
                    
                $.ajax({
                    url : "Admin/update_data_permintaan",
                    type: "post",
                    data: {
                        "noins":noins,
                        "site":site,
                        "tglminta":tglminta,   
                    }
                })

                $("#permintaan-editor").modal('hide');
                
                window.location.reload();
            }
        });
    });

    function activate_menu(menu) {
        $(".menu").removeClass("active");
        $("#"+menu+"").addClass("active");
        $(".content").hide();
        $("#"+menu+"-content").fadeIn("slow");
    }

    function activate_tab(menu, tab) {
        $('.nav-tabs #'+tab+'-'+menu).tab('show');
    }

});