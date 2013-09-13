<link rel="stylesheet" href="/codenameDS/css/rating.css" />
<script type="text/javascript" src="/codenameDS/js/rating/rating.js"></script>	
		
<div class="modal hide" id="ratingModal" aria-hidden="true">
	<div class="modal-header">
		<h2>Review Editor</h2>
	</div>

	<div class="modal-body" style="overflow: hidden">
		<form method="POST" enctype="multipart/form-data">
			<div class="row-fluid">	
				<div class="span12">				
						<?php
						include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/settings.php';
						connect();
									
						$id=$_SESSION['editor_id'];
						$j=$v=1;
						$rat = 0;
												
						$q="SELECT total_votes, total_value FROM `ratings` WHERE id=$id";
						$r=mysql_query($q);
						if(!$r) echo mysql_error();
						
						while($row=mysql_fetch_array($r))
						{
							$v=$row['total_votes'];
							$tv=$row['total_value'];
							$rat=$tv/$v;
						}
						
						echo'<div class="product" align="center">
				           Please rate the editor for his efforts!
				            <div id="rating_'.$id.'" class="ratings">';
				                for($k=1;$k<6;$k++){
									if($rat+0.5>$k)$class="star_".$k."  ratings_stars ratings_vote";
									else $class="star_".$k." ratings_stars ratings_blank";
									echo '<div class="'.$class.'"></div>';
									}
				                echo' <div class="total_votes"><p class="voted"> Rating: <strong>'.@number_format($rat).'</strong>/5 ('.$v. '  vote(s) cast) 
				            </div>
				        </div></div>';			
						?>				
					<br>
					<br>
					<div>
			     		<p>Please enter some comments about the editor</p>
			     		<textarea id="description" name="description" class="enterComment" placeholder="Comments" required></textarea>
			     	</div>
					
					<div>
				     	<p>Click below to download the edited picture</p>
						<p>							
							<a href="http://localhost:8888/<?php echo $_SESSION['edited_img_link'];?>" download="http://localhost:8888/<?php echo $_SESSION['edited_img_link'];?>" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</a>	
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