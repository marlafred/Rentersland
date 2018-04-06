<!-- Plan a Tour Modal -->
<div class="modal fade" id="applythis-{{ isset($list->id)?$list->id:$listing->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Apply to this Listings</strong></h4>
        
      </div>
        <div class="modal-body" style="padding-bottom: 50px;">
            <p>Your Tenant Application is not completed yet, please continue to complete your profile.</p>
            <div class="col-sm-12 text-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-red">Complete my Tenant Application</a>
            </div>
            <br>
        </div>
    </div>
   </div>
</div><!-- /Plan a Tour Modal -->