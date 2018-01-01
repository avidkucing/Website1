$(document).ready(function(){
	$(".bahanbaku tbody tr td").addClass("klik");
    $('.klik').click(function(){
        $link = window.location.origin + "/hisamitsu/gudang/print_lpb_show/" + (this.id);
        window.location.href=$link ;
    });

    $('#tabel').DataTable( {
        "lengthChange" : false
    } );

    $('#print').click(function () {
        var doc = new jsPDF();
        var specialElementHandlers = {
            '.button-container': function (element, renderer) {
                return true;
            }
        };

        doc.fromHTML($('body').get(0), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });


    $("#bahanbakutab").click(function(){
		$("#bahanjaditab").removeClass("active");
		$("#bahanbakutab").addClass("active");
		$(".bahanjadi").hide();
		$(".bahanbaku").fadeIn("fast");
	});
	$("#bahanjaditab").click(function(){
		$("#bahanbakutab").removeClass("active");
		$("#bahanjaditab").addClass("active");
		$(".bahanbaku").hide();
		$(".bahanjadi").fadeIn("fast");
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