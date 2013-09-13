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
					<div class="row-fluid">	
						<div class='span6'>
				            Rate the editor:
				            <div id="rating_1" class="">
				                <div class="star_1 ratings_stars"></div>
				                <div class="star_2 ratings_stars"></div>
				                <div class="star_3 ratings_stars"></div>
				                <div class="star_4 ratings_stars"></div>
				                <div class="star_5 ratings_stars"></div>
			                </div>
				        </div>			        
				        <div class='span6'>
				            Rate the editor's creativity:
				            <div id="rating_2" class="" id="ratings">
				                <div class="star_1 ratings_stars"></div>
				                <div class="star_2 ratings_stars"></div>
				                <div class="star_3 ratings_stars"></div>
				                <div class="star_4 ratings_stars"></div>
				                <div class="star_5 ratings_stars"></div>
			                </div>
						</div>
					</div>
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