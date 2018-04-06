<!-- Plan a Tour Modal -->
<div class="modal fade" id="tour-plan-modal-{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Tour this place</strong></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
            <i class="fa fa-exclamation-circle"></i>
            One of our rental experts will schedule and confirm a tour for you.
        </div>
        <div class="clearfix"></div>
        <form class="request_form" id="request_form" onsubmit="return false;">
          {{ csrf_field() }}
          <div class="step1">
            <div class="form-group">
             <i class="fa fa-calendar flt-icon" aria-hidden="true"></i>
             <input id="datepicker" class="form-control datepicker" name="plan_date" data-date-format="dd-mm-yyyy" placeholder="Pick a Date" />
           </div>
           <div class="form-group">
             <label>Choose a time that works for you:</label>
             <div class="fake-radio" type='morning'>
               <strong>Morning</strong>
               <span>10AM - 12PM</span>
               
             </div>
             <div class="fake-radio" type='afternoon'>
               <strong>Afternoon</strong>
               <span>12PM - 3PM</span>
               
             </div>
             <div class="fake-radio" type='evening'>
               <strong>Evening</strong>
               <span>3PM - 6PM</span>
               
             </div>
           </div>
           <input type="hidden" id="plan_time" name="plan_time" />
           <div class="form-group">
             <input type="button" class="btn btn-clrd pull-left next-btn" style="margin-left:0;" value="Continue" />
           </div>
         </div><!--step1-->
         <div class="step2" style="display: none;">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
               <h4><strong>Enter your info</strong></h4>
             </div>
           </div>
           <div class="col-sm-12">
             <div class="form-group">
              <i class="fa fa-user flt-icon" aria-hidden="true"></i>
              @if(!Auth::guest())
              <input type="text" class="form-control" name="sender_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->lst_name }}" required="" placeholder="Full name" />
              @else
              <input type="text" class="form-control" name="sender_name" value="" required="" placeholder="Full name" />
              @endif
            </div>
          </div>
          <div class="col-sm-12">
           <div class="form-group">
            <i class="fa fa-at flt-icon" aria-hidden="true"></i>
            @if(!Auth::guest())
            <input type="email" class="form-control" name="sender_email" value="{{ Auth::user()->email }}" required="" placeholder="Email" />
            @else
            <input type="email" class="form-control" name="sender_email" value="" required="" placeholder="Email" />
            @endif
          </div>
        </div>
        <div class="col-sm-12">
         <div class="form-group">
          <i class="fa fa-phone flt-icon" aria-hidden="true"></i>
          @if(!Auth::guest())
          <input type="text" class="form-control" name="sender_phone" required="" value="{{ Auth::user()->phone_number }}" placeholder="Phone" />
          @else
          <input type="text" class="form-control" name="sender_phone" required="" value="" placeholder="Phone" />
          @endif
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
         <textarea class="form-control" rows="5" name="sender_message" placeholder="Enter Your Message Here">
Hi,
I found Your Listing on {{ $setting->title }} ( {{ $list->title }} ) and I'd like to find out more.
Can you please let me know which floorplans are currently available, and when I might be able to view it?
Thanks
          
        </textarea>
      </div>
    </div>
    <div class="col-sm-12 form-group">
     <input type="button" class="btn btn-danger back-btn" value="Back" /> 
     <input type="submit" class="btn btn-clrd pull-right" value="Submit" />
   </div>
 </div>
 <input type="hidden" id="listing_id" name="listing_id" value="{{ $list->id }}">
 <input type="hidden" id="dealer_id" name="dealer_id" value="{{ $list->user_id }}">
 @if(!Auth::guest())
 <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
 @else
 <input type="hidden" name="sender_id" value="">
 @endif
 
</div><!--step2-->
</form>
</div>



</div>
</div>
</div><!-- /Plan a Tour Modal -->