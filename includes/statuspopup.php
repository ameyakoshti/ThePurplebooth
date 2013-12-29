<!-- Before including this file make sure you have a $success varible which has a value set to either TRUE or FALSE -->
<?php
if ($success === TRUE){?>
<script type="text/javascript">
	jSuccess(
		    'Upload Image Sucessful!',
		    {
		      autoHide : true,
		      TimeShown : 2000,
		      HorizontalPosition : 'center',
		      ShowOverlay : false
		    }
		   );
</script>	
<?php 
}
 else {?>
<script type="text/javascript">
	 jError(
		    'Upload Image Failed!',
		    {
		      autoHide : true,
		      TimeShown : 2000,
		      HorizontalPosition : 'center',
		      ShowOverlay : false
		    }
		  );
</script>
<?php
}
?>