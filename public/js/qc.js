$(document).ready(function(){
	//$(".bahanbaku tbody tr td").addClass("klik1");
    $('.instruksi').click(function(){
        $link = "quality_control/instruksi_sampling_bahan_show/" + (this.id);
        window.location.href=$link ;
    });
    $('.analisa').click(function(){
        $link = "quality_control/analisa_sampling_bahan_show/" + (this.id);
        window.location.href=$link ;
    });

});	  