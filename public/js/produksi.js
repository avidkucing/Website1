$(document).ready(function(){

    $(".permintaan tbody tr td").addClass("klik");
    $('.klik').click(function(){
        $link = window.location.origin + "/manufaktur/produksi/print_permintaan_bahan_show/" + (this.id);
        window.location.href=$link ;
    });
 	
    function print() {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#print': function (element, renderer) {
                return true;
            }
        };

        doc.fromHTML($('body').get(0), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    };

    $(".kode1").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nomor_analisa",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".no_ana1").html(data);
         },
    });

   $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan1").html(data);
         },
    });

    $.ajax({
         url : "get_data_exp_kosong",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp1").html(data);
         },
    });

    });

    $(".no_ana1").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_exp_date",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp1").html(data);
         },
    });

    $.ajax({
        url : "get_data_jumlah",
        type : "post",
        data : {"value": value},
        success : function(data){
            $(".jumlah1").attr({
                "max" : data,
                "min" : 1
            })
        }
    })

    });

    $(".kode2").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nomor_analisa",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".no_ana2").html(data);
         },
    });

   $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan2").html(data);
         },
    });

    $.ajax({
         url : "get_data_exp_kosong",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp2").html(data);
         },
    });

    });

    $(".no_ana2").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_exp_date",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp2").html(data);
         },
    });

    $.ajax({
        url : "get_data_jumlah",
        type : "post",
        data : {"value": value},
        success : function(data){
            $(".jumlah2").attr({
                "max" : data,
                "min" : 1
            })
        }
    })

    });

    $(".kode3").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nomor_analisa",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".no_ana3").html(data);
         },
    });

   $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan3").html(data);
         },
    });

    $.ajax({
         url : "get_data_exp_kosong",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp3").html(data);
         },
    });

    });

    $(".no_ana3").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_exp_date",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp3").html(data);
         },
    });

    $.ajax({
        url : "get_data_jumlah",
        type : "post",
        data : {"value": value},
        success : function(data){
            $(".jumlah3").attr({
                "max" : data,
                "min" : 1
            })
        }
    })

    });

    $(".kode4").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nomor_analisa",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".no_ana4").html(data);
         },
    });

   $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan4").html(data);
         },
    });

    $.ajax({
         url : "get_data_exp_kosong",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp4").html(data);
         },
    });

    });

    $(".no_ana4").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_exp_date",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp4").html(data);
         },
    });

    $.ajax({
        url : "get_data_jumlah",
        type : "post",
        data : {"value": value},
        success : function(data){
            $(".jumlah4").attr({
                "max" : data,
                "min" : 1
            })
        }
    })

    });

    $(".kode5").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nomor_analisa",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".no_ana5").html(data);
         },
    });

   $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan5").html(data);
         },
    });

    $.ajax({
         url : "get_data_exp_kosong",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp5").html(data);
         },
    });

    });

    $(".no_ana5").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_exp_date",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".exp5").html(data);
         },
    });

    $.ajax({
        url : "get_data_jumlah",
        type : "post",
        data : {"value": value},
        success : function(data){
            $(".jumlah5").attr({
                "max" : data,
                "min" : 1
            })
        }
    })

    });
});

/*
function addRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    for(var i=0; i <colCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[1].cells[i].innerHTML;
    }
}
*/
function deleteRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
            if(rowCount <= 2) {               // limit the user from removing all the fields
                alert("Tidak dapat menghapus seluruh form nomor batch!");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}