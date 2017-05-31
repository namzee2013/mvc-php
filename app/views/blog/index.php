<span class="first">
	@<?php echo $_SESSION['name']; ?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn icon-edit new" data-toggle="modal" data-target="#myModal"></button>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Write Blog</h4>
      </div>
      <div class="modal-body">
					<div class="form-group">
						<div class="form-group">
			        <div class="row">
			          <div class="col-xs-12">
			            <label class="pull-right" for="email">Content<span class="error">*</span></label>
			          </div>
			          <div class="col-xs-12">
			            <textarea id="content" name="content" class="form-control has-error" rows="8" cols="80"></textarea>
			            <span id="blogErr" class="error"></span>
									<span id="blogSuccess" class="success"></span>
			          </div>
			        </div>
			      </div>
					</div>

      </div>
      <div class="modal-footer">
				<button id="saveblog" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</span>
<ul id="blogs" class="timeline">
	<div id="innerHTML">

	</div>
</ul>

<div id="isloading" class="text-center">

</div>
<div id="btnloadmore" class="text-center">
	<button id="loadmore" class="btn btn-primary btn-lg">Load More</button>
</div>
