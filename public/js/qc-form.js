$(document).ready(function(){
     $('.instruksi').click(function(){
     	 $link = window.location.origin + "/hisamitsu/quality_control/instruksi_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
     $('.analisa').click(function(){
     	 $link = window.location.origin + "/hisamitsu/quality_control/analisa_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
});