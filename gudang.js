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
});	    