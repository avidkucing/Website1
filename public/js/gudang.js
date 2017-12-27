$(document).ready(function(){
	$(".bahanbaku tbody tr").addClass("klik");
	$(".klik").attr("data-href","print-lpb.html");
	$(".klik").click(function() {
        window.location = $(this).data("href");
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

	$("#kodebahan").on("change",function(){
    var value = $(this).val();
    $.ajax({
         url : "get_data_nama_bahan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $("#namabahan").html(data);
         },
    });

    $.ajax({
         url : "get_data_manufaktur",
         type: "post",
         data: {"value":value},
         success : function(data){
             $("#manufaktur").html(data);
         },
    });

    $.ajax({
         url : "get_data_supplier",
         type: "post",
         data: {"value":value},
         success : function(data){
             $("#supplier").html(data);
         },
    });

    $.ajax({
         url : "get_data_satuan",
         type: "post",
         data: {"value":value},
         success : function(data){
             $("#satuan").html(data);
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
            if(rowCount <= 1) {               // limit the user from removing all the fields
                alert("Cannot Remove all the No. Batch.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}