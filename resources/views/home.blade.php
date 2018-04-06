@extends('master')
@section('title', 'Home')
@section('body')
    
    <!-- Search Box -->
    <div class="search-main">
        <h1><strong>Find an Apartment</strong></h1>
        <h3>Search for millions of apartments with 1 Application</h3>
        <form method="post" action="{{ route('home.search.submit') }}">
            {{ csrf_field() }}
            <div class="col-sm-11">
                <input type="text" class="form-control" name="search" id="search" placeholder="Where to?" />
            </div>
            <div class="col-sm-1 nopadding">
                <div class="btn-search btn btn-blue">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input type="submit" value=" ">
                </div>
            </div>

            <input type="hidden" name="state" id="state">
            <input type="hidden" name="city" id="city">
        </form>

    </div>
    <!-- /Search Box -->

    <!-- Graphical Thought -->
    <div class="thought-graph">
        <div class="container">
            <a href="{{ isset($bubble->btn_link)?$bubble->btn_link:'' }}" class="btn btn-red hidden-xs">{{ isset($bubble->btn_label)?$bubble->btn_label:'' }}</a>
            <div class="figure-wrapper">
                <div class="stick-figure"></div>
                <div class="speech-bubble">
                    {{ isset($bubble->bubble1)?$bubble->bubble1:'' }}
                </div>
                <div class="speech-bubble">
                    {{ isset($bubble->bubble2)?$bubble->bubble2:'' }}
                </div>
                <div class="speech-bubble">
                    {{ isset($bubble->bubble3)?$bubble->bubble3:'' }}
                </div>
                <div class="speech-bubble">
                    {{ isset($bubble->bubble4)?$bubble->bubble4:'' }}
                </div>
                <div class="speech-bubble">
                    {{ isset($bubble->bubble5)?$bubble->bubble5:'' }}
                </div>
            </div>
        </div>
        <a href="{{ isset($bubble->btn_link)?$bubble->btn_link:'' }}" class="btn btn-red visible-xs">{{ isset($bubble->btn_label)?$bubble->btn_label:'' }}</a>
    </div>
    <!-- /Graphical Thought -->

    <!-- Top Listing -->
    <section id="toplisting">
        <div class="container">
            <div class="row">
                <h1 class="section-heading">RentersLand.com Top 6 listings</h1>
                <h3>&nbsp;</h3>
                <div class="row">
                    <?php $count = 1; ?>
                    @if(count($featuredListings) > 0)
                        @foreach($featuredListings as $list)
                            <div class="col-sm-4">
                                <div class="appart-box">
                                <a href="{{ route('detail.listing') }}/{{ $list->slug }}">
                                    <div class="appart-img">
                                    @if($list->featured_image != '')
                                        <img src="{{ asset('uploads/large_thumbs/'.$list->featured_image) }}" alt="" />

                                    @else
                                        @if(count($list->listingimages) > 0)
                                            @foreach ($list->listingimages as $images)
                                                @if ($loop->first)
                                                    <img src="{{ asset('uploads/large_thumbs/'.$images->image) }}" alt="" />
                                                @endif
                                            @endforeach
                                        @else
                                            <img src="{{ asset('extra-images/listing-3.jpg') }}" />
                                        @endif

                                    @endif
                                    </div>

                                    <h2>{{ $list->title = substr($list->title, 0, 16) }}</h2>
                                    <p>
                                    @if($list->description!='')
                                        {{ $list->description = substr($list->description, 0, 60) }}
                                        @else
                                        <br>
                                    @endif
                                    </p>
                                </a>
                            </div>
                </div><!--col-sm4-->
                @if($count%3==0)
                <div class="clearfix"></div>
                @endif
                        <?php $count++; ?>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>

@section('script')
    <script>
        /* script */
        function initialize() {

            var input = document.getElementById('search');
            var geocoder = new google.maps.Geocoder();
            var autocomplete = new google.maps.places.Autocomplete(input);
            var infowindow = new google.maps.InfoWindow();
            autocomplete.addListener('place_changed', function() {
                infowindow.close();

                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng(), place.address_components);
                infowindow.setContent(place.formatted_address);


            });


        }
        function bindDataToForm(address,lat,lng, address_components){
            if(address_components){


                var town = extractFromAdress(address_components, "locality");
                var state = extractFromAdress(address_components, "administrative_area_level_1");
                if(state){
                    document.getElementById('city').value = town;
                    document.getElementById('state').value = state;
                }

            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        function extractFromAdress(components, type){
            for (var i=0; i<components.length; i++)
                for (var j=0; j<components[i].types.length; j++)
                    if (components[i].types[j]==type) return components[i].long_name;
            return "";
        }


    </script>
@endsection

@stop