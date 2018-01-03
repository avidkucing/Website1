$(document).ready(function(){
 	//$(".bahanbaku tbody tr td").addClass("klik1");
     $('.instruksi').click(function(){
     	 $link = window.location.origin + "/manufaktur/quality_control/instruksi_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });
     $('.analisa').click(function(){
     	 $link = window.location.origin + "/manufaktur/quality_control/analisa_sampling_bahan_show/" + (this.id);
         window.location.href=$link ;
     });

     $('#tabel').DataTable( {
        
    } );
 
 });