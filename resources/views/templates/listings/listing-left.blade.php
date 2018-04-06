<div class="response">
    <div class="loadover" style="display:none;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i></div>
    <h3 class="heading"><strong>Showing Results: ({{ count($listings) }})</strong></h3>
    @if(count($listings) > 0)
    <ul class="searched-list mCustomScrollbar" data-mcs-theme="dark">

        @foreach ($listings as $list)
            <li>
                @if($list->featured_image != '')
                    <img src="{{ asset('uploads/small_thumbs/'.$list->featured_image) }}" class="img-responsive" alt="" 
                                     style="width: 150px; height: 150px;" />
                    @else
                        @if(count($list->listingimages) > 0)
                            @foreach ($list->listingimages as $images)
                                @if ($loop->first)
                                <img src="{{ asset('uploads/small_thumbs/'.$images->image) }}" class="img-responsive" alt="" 
                                     style="width: 150px; height: 150px;" />
                                @endif
                            @endforeach
                            @else
                                <img src="{{ asset('images/no-image-small.png') }}" class="img-responsive" alt="" 
                                         style="width: 150px; height: 150px;" />
                        @endif
                @endif
                <h3><strong>{{ $list->title }}</strong></h3>
                <div class="post-meta">
                  <span><i class="fa fa-map-marker"></i> {{ $list->address }}</span>
                  <span><i class="fa fa-building" aria-hidden="true"></i> {{ $list->property_type }}</span>
                </div>
                <ul class="features">
                    <li>${{ number_format($list->price, 2) }}</li>
                    <li>{{ $list->bedrooms }} Bedrooms</li>
                    <li>{{ $list->bathrooms }} Bathrooms</li>
                </ul>

                <span class="text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> Posted {{ $list->created_at->diffForHumans() }}</span>
                @if( Auth::guest() )
                    <a href="{{ route('tenant.register') }}" class="btn btn-clrd" data-toggle="modal" data-target="" data-backdrop="static" data-keyboard="false">Plan Tour</a>
                    @elseif(Auth::user()->id != $list->user_id )
                    <a href="javascript:void(0);" class="btn btn-clrd" data-toggle="modal" data-target="#tour-plan-modal-{{ $list->id }}" data-backdrop="static" data-keyboard="false">Plan Tour</a>
                    @else
                    <a href="javascript:void(0);" class="btn btn-clrd disabled" >Plan Tour</a>
                @endif
                
                @if (!Auth::guest())
                    @if(Auth::user()->user_type=='Tenant')
                        @if(in_array($list->id,$applied))
                        <a class="btn btn-red list-apply disabled">Applied</a>
                        @else
                        <a class="btn btn-red list-apply" data-toggle="modal" data-target="#applythis-{{ $list->id }}" data-backdrop="static" data-keyboard="false"> Apply Now </a>   
                        @endif
                    @endif
                @endif
                
                
                <a href="{{ route('detail.listing') }}/{{ $list->slug }}" class="btn btn-red">details</a>
            </li>
            
          @include('templates.modal.plan-tour-modal')
            
            @if(isset(Auth::user()->user_type) and Auth::user()->user_type=='Tenant' )
            <div class="clearfix"></div>
                <!--modal -->
                @if(Auth::user()->doc_status=='1' )
                    @include('templates.modal.apply-modal')
                @else
                    @include('templates.modal.not-applicable-modal')
                @endif
              <!--end -->
            @endif
                       
        @endforeach
        @else
         <div class="nothing-found"><i class="fa fa-meh-o" aria-hidden="true"></i> oops! No Results Found</div>
        @endif

    </ul>
</div><!--reposne-->
