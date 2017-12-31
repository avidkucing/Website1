$(document).ready(function(){
 	//$(".bahanbaku tbody tr td").addClass("klik1");
     $('.status').click(function(){
     	 window.location.reload(true)
         $link = window.location.origin + "/hisamitsu/ka_quality_control/status_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
 
 });