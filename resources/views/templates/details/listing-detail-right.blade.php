<div class="col-sm-3 nopadding">    <div id="carousel-pager" class="carousel slide " data-ride="carousel" data-interval="false">        <!-- Carousel items -->        <div class="carousel-inner vertical">                <?php $pos=0; ?>                @if(count($listing->listingimages))                    @foreach ($listing->listingimages as $images)                        <?php $class = ''; ?>                        @if ($loop->first)                            <?php $class = 'active'; ?>                        @endif                        <div class="item {{ $class }}">                            <img src="{{ asset('uploads/small_thumbs/'.$images->image) }}" class="img-responsive"                                  data-target="#carousel-main" data-slide-to="<?php print $pos++ ?>"                                 style="width:182px; height:120px; ">                        </div>                    @endforeach                    @else                    <img src="{{ asset('images/slide-thumbnail.jpg') }}" class="img-responsive"                         data-target="#carousel-main" data-slide-to="1"                                     style="width:182px; height:120px; ">                    <img src="{{ asset('images/slide-thumbnail.jpg') }}" class="img-responsive"                         data-target="#carousel-main" data-slide-to="1"                                     style="width:182px; height:120px; ">                    <img src="{{ asset('images/slide-thumbnail.jpg') }}" class="img-responsive"                         data-target="#carousel-main" data-slide-to="1"                                     style="width:182px; height:120px; ">                @endif        </div>        <!-- Controls -->        <a class="left carousel-control" href="#carousel-pager" role="button" data-slide="prev">                <i class="fa fa-arrow-up" aria-hidden="true"></i>                <span class="sr-only">Previous</span>        </a>        <a class="right carousel-control" href="#carousel-pager" role="button" data-slide="next">                <i class="fa fa-arrow-down" aria-hidden="true"></i>                <span class="sr-only">Next</span>        </a>    </div></div><!--col-sm-3-->