$(document).ready(function(){
	$("#bahanbaku table tr td").addClass("klik");

    $("#bahankemas table tr td").addClass("klik");

    $("#bahanbantu table tr td").addClass("klik");
    
    $('.klik').click(function(){
        $link = window.location.origin + "/manufaktur/gudang/print_lpb_show/" + (this.id);
        window.location.href=$link ;
    });

    $("#other").click(function(){
       $('.arrow').toggleClass("fa-angle-down");
       $('.arrow').toggleClass("fa-angle-up");
    });

    $('.decorated').DataTable( {

    });

    $("#bahanbakutab").click(function(){
		$("#mintabakutab").removeClass("active");
        $("#bahankemastab").removeClass("active");
        $("#bahanbantutab").removeClass("active");
        $("#stockbakutab").removeClass("active");
        $("#stockkemastab").removeClass("active");
		$("#bahanbakutab").addClass("active");
		$("#mintabaku").hide();
        $("#bahankemas").hide();
        $("#stockbaku").hide();
        $("#stockkemas").hide();
        $("#bahanbantu").hide();
		$("#bahanbaku").fadeIn("fast");
	});

	$("#mintabakutab").click(function(){
		$("#bahanbakutab").removeClass("active");
        $("#bahankemastab").removeClass("active");
        $("#bahanbantutab").removeClass("active");
		$("#stockbakutab").removeClass("active");
        $("#stockkemastab").removeClass("active");
        $("#mintabakutab").addClass("active");
		$("#bahanbaku").hide();
        $("#bahankemas").hide();
        $("#bahanbantu").hide();
        $("#stockbaku").hide();
		$("#stockkemas").hide();
        $("#mintabaku").fadeIn("fast");
	});

    $("#bahankemastab").click(function(){
        $("#bahanbakutab").removeClass("active");
        $("#mintabakutab").removeClass("active");
        $("#stockbakutab").removeClass("active");
        $("#stockkemastab").removeClass("active");
        $("#bahanbantutab").removeClass("active");
        $("#bahankemastab").addClass("active");
        $("#bahanbaku").hide();
        $("#mintabaku").hide();
        $("#bahanbantu").hide();
        $("#stockbaku").hide();
        $("#stockkemas").hide();
        $("#bahankemas").fadeIn("fast");
    });

    $("#bahanbantutab").click(function(){
        $("#bahanbakutab").removeClass("active");
        $("#stockbakutab").removeClass("active");
        $("#stockkemastab").removeClass("active");
        $("#mintabakutab").removeClass("active");
        $("#bahankemastab").removeClass("active");
        $("#bahanbantutab").addClass("active");
        $("#bahanbaku").hide();
        $("#mintabaku").hide();
        $("#bahankemas").hide();
        $("#stockbaku").hide();
        $("#stockkemas").hide();
        $("#bahanbantu").fadeIn("fast");
    });

    $("#stockbakutab").click(function(){
        $("#bahanbakutab").removeClass("active");
        $("#bahankemastab").removeClass("active");
        $("#bahanbantutab").removeClass("active");
        $("#mintabakutab").removeClass("active");
        $("#stockkemastab").removeClass("active");
        $("#stockbakutab").addClass("active");
        $("#bahanbaku").hide();
        $("#bahankemas").hide();
        $("#bahanbantu").hide();
        $("#mintabaku").hide();
        $("#stockkemas").hide();
        $("#stockbaku").fadeIn("fast");
    });

    $("#stockkemastab").click(function(){
        $("#bahanbakutab").removeClass("active");
        $("#bahankemastab").removeClass("active");
        $("#bahanbantutab").removeClass("active");
        $("#mintabakutab").removeClass("active");
        $("#stockbakutab").removeClass("active");
        $("#stockkemastab").addClass("active");
        $("#bahanbaku").hide();
        $("#bahankemas").hide();
        $("#bahanbantu").hide();
        $("#mintabaku").hide();
        $("#stockbaku").hide();
        $("#stockkemas").fadeIn("fast");
    });

    $("#print-bahanbaku").click(function(){
        $("#for-web").hide();
        $("#for-print").show();
        $("#bahanbaku-content").show();
        window.print();
        $("#for-web").show();
        $("#for-print").hide();
        $("#bahanbaku-content").hide();
    });

    $("#print-bahankemas").click(function(){
        $("#for-web").hide();
        $("#for-print").show();
        $("#bahankemas-content").show();
        window.print();
        $("#for-web").show();
        $("#for-print").hide();
        $("#bahankemas-content").hide();
    });

    $("#print-bahanbantu").click(function(){
        $("#for-web").hide();
        $("#for-print").show();
        $("#bahanbantu-content").show();
        window.print();
        $("#for-web").show();
        $("#for-print").hide();
        $("#bahanbantu-content").hide();
    });

    $(".jenisbahan").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_kode_bahan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".kodebahan").html(data);
         },
    });

    });

	$(".kodebahan").on("change",function(){
    var value = $(this).val();
    
    $.ajax({
         url : "get_data_nama_bahan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".namabahan").html(data);
         },
    });

    $.ajax({
         url : "get_data_manufaktur",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".manufaktur").html(data);
         },
    });

    $.ajax({
         url : "get_data_supplier",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".supplier").html(data);
         },
    });

    $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $(".satuan").html(data);
         },
    });

	});
    /*
    $(".supplier").on("change",function(){
    var supplier = $(this).val();
    var kodebahan = $(".kodebahan").val();
    $.ajax({
         url : "get_data_manufaktur_from_supplier",
         type: "post",
         data: {"kode": kodebahan,
                "supp": supplier
                },
         success : function(data){
             $(".manufaktur").html(data);
         },
    });

    });
    
    $(".manufaktur").on("change",function(){
    var manufaktur = $(this).val();
    var kodebahan = $(".kodebahan").val();
    $.ajax({
         url : "get_data_supplier_from_manufaktur",
         type: "post",
         data: {"kode": kodebahan,
                "manu": manufaktur
                },
         success : function(data){
             $(".supplier").html(data);
         },
    });

    });
    */
});	    


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