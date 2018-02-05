$(document).ready(function(){
 	//$(".bahanbaku tbody tr td").addClass("klik1");
     $('.instruksi').click(function(){
     	 $link = window.location.origin + "/manufaktur/ka_quality_control/instruksi_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
     $('.status').click(function(){
     	 window.location.reload(true)
         $link = window.location.origin + "/manufaktur/ka_quality_control/status_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
 
 });