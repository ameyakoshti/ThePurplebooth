
    $(document).ready(function() {
 $('.ratings_stars').hover(

            // Handles the mouseover

            function() {

                $(this).prevAll().andSelf().addClass('ratings_over');
               

            },

            // Handles the mouseout

            function() {

                $(this).prevAll().andSelf().removeClass('ratings_over');

            }

        );
//send ajax request to rate.php
        $('.ratings_stars').bind('click', function() {
			
			var id=$(this).parent().attr("id");
		    var num=$(this).attr("class");
			var poststr="id="+id+"&stars="+num;
		$.ajax({url:"rate.php",cache:0,data:poststr,success:function(result){
   document.getElementById(id).innerHTML=result;}
   });	
		});

 
        });

        
