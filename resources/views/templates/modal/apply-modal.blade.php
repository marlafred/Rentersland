<!-- Plan a Tour Modal -->
<div class="modal fade" id="applythis-{{ isset($list->id)?$list->id:$listing->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Apply to this Listings</strong></h4>
        
      </div>
        <div class="modal-body" style="padding-bottom: 50px;">
            <div class="alert alert-info">
                <i class="fa fa-exclamation-circle"></i>
                When You apply for listing, Dealer will be able to view your details.
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <div class="pretty p-image p-plain">
                    <input type="checkbox" value="share" class="share_now" />
                    <div class="state"> <img class="image" src="{{ asset('images/check.png') }}">
                      <label>Share my tenant application form information</label>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <div class="apply-response"></div><br>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12 text-center">
                <button class="btn btn-clrd apply_now" list-id="{{ isset($list->id)?$list->id:$listing->id }}" dealer-id="{{ isset($list->user_id)?$list->user_id:$listing->user_id }}" >Apply Now</button>
            </div>
            <br>
        </div>
    </div>
   </div>
</div><!-- /Plan a Tour Modal -->