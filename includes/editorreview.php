<link rel="stylesheet" href="/thepurplebooth/css/rating.css" />
		
<div class="modal hide" id="ratingModal" aria-hidden="true">
	<div class="modal-header">
		<h2>Review Editor</h2>
	</div>

	<div class="modal-body" style="overflow: hidden">
		<form method="POST" enctype="multipart/form-data" action='http://localhost:8888/<?php echo $_SESSION['edited_img_link'];?>'>
			<div class="row-fluid">	
				<div class="span12">				
						<?php
						include $_SERVER['DOCUMENT_ROOT'] . '/thepurplebooth/database/user_rating.php';
						open_connection();
									
						$id=$_SESSION['editor_id'];
						$rated_by=$_SESSION['thepurplebooth_user_id'];
						$j=$v=1;
						$rat=0;
												
						$r=get_ratings_info($id);
											
						while($row=mysql_fetch_array($r))
						{
							$v=$row['total_votes'];
							$tv=$row['total_value'];
							if($v!=0)
								$rat=$tv/$v;
							else
								$rat=0;
						}
						
						echo'<div class="product" align="center">
				           Please rate the editor for his efforts!
				            <div id="rating_'.$id.'" class="ratings">';
				                for($k=1;$k<6;$k++){
									if($rat+0.5>$k)$class="star_".$k."  ratings_stars ratings_vote";
									else $class="star_".$k." ratings_stars ratings_blank";
									echo '<div id="'.$rated_by.'" class="'.$class.'"></div>';
									}
				                echo' <div class="total_votes"><p class="voted"> Rating: <strong>'.@number_format($rat).'</strong>/5 ('.$v. '  vote(s) cast) 
				            </div>
				        </div></div>';			
						?>				
					<br>
					<br>
					<div>
			     		<p>Please enter some comments about the editor</p>
			     		<textarea id="reviewcomments" class="enterComment" placeholder="Comments" required></textarea>
			     	</div>
					
					<div>
				     	<p>Click below to download the edited picture</p>
						<p>							
							<a id="download" href="http://localhost:8888/<?php echo $_SESSION['edited_img_link'];?>" download="http://localhost:8888/<?php echo $_SESSION['edited_img_link'];?>" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</a>	
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">
			Close
		</button>
	</div>
</div>
<script type="text/javascript">
	<?php echo "var editor_id = '".$_SESSION['editor_id']."';";?>
</script>
<script type="text/javascript" src="/thepurplebooth/js/rating/rating.js"></script>