<script type="text/javascript">
	$(document).ready(function(){
		$('#rating1').click(function(){
			alert('hi');
			$("#rating").css("width", "20%");
		}
		$('#rating2').click(function(){
			$("#rating").css("width", "40%");
		}
		$('#rating3').click(function(){
			$("#rating").css("width", "60%");
		}
		$('#rating4').click(function(){
			$("#rating").css("width", "80%");
		}
		$('#rating5').click(function(){
			$("#rating").css("width", "100%");
		}
	});
</script>

<div class="modal hide" id="ratingModal" aria-hidden="true">
	<div class="modal-header">
		<h2>Review Editor</h2>
	</div>

	<div class="modal-body" style="overflow: hidden">
		<form method="POST" enctype="multipart/form-data">
			<div class="row-fluid">	
				<div class="span12">
					<div>
			     		<p>How would you like rate the editor?</p>
			     		<ul class="star-rating">
							<li id="rating" class="current-rating" style="width:60%;">Currently 3/5 Stars.</li>
							<li id="rating1"><a href="#" title="1 star out of 5" class="one-star">1</a></li>
							<li id="rating2"><a href="#" title="2 stars out of 5" class="two-stars">2</a></li>
							<li id="rating3"><a href="#" title="3 stars out of 5" class="three-stars">3</a></li>
							<li id="rating4"><a href="#" title="4 stars out of 5" class="four-stars">4</a></li>
							<li id="rating5"><a href="#" title="5 stars out of 5" class="five-stars">5</a></li>
						</ul>		
			     		<p>How would you like to rate his creativity?</p>
			     		<ul class="star-rating">
							<li id="creativity" class="current-rating" style="width:60%;">Currently 3/5 Stars.</li>
							<li id="creativity1"><a href="#" title="1 star out of 5" class="one-star">1</a></li>
							<li id="creativity2"><a href="#" title="2 stars out of 5" class="two-stars">2</a></li>
							<li id="creativity3"><a href="#" title="3 stars out of 5" class="three-stars">3</a></li>
							<li id="creativity4"><a href="#" title="4 stars out of 5" class="four-stars">4</a></li>
							<li id="creativity5"><a href="#" title="5 stars out of 5" class="five-stars">5</a></li>
						</ul>		
			     	</div>
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