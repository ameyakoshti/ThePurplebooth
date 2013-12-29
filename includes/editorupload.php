<div class="modal hide" id="uploadModal" aria-hidden="true">
	<div class="modal-header">
		<h2>Upload</h2>
	</div>

	<div class="modal-body" style="overflow: hidden">
		<form method="POST" enctype="multipart/form-data">
			<div class="row-fluid">	
				<div class="span12">
					<div>
			     		<p>Enter some comments about the awesome work you did on the image</p>
			     		<textarea id="description" name="description" class="enterComment" placeholder="Description" required></textarea>
			     	</div>
					
					<div>
				     	<p>Click below to select edited pic</p>
						<p>							
							<input name="userfile" type="file" id="userfile"
								class="btn">
							<button class="btn btn-info btn-small" id="upload" name="upload"
								type="submit">
								<i class="icon-camera icon-white"> </i> Done
							</button>			
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