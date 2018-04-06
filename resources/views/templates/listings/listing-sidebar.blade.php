<!-- Sidebar -->
<div class="map">
    <div class="map" id="map" style="width: 100%; height: 300px;"></div>
</div>
<div class="similar-aparts">
<h3>Other Relevent Listings</h3>
<ul>
    
    @foreach ($sidebarListings as $list)
        <li><a href="{{ route('detail.listing') }}/{{ $list->slug }}">{{ $list->address }}</a></li>
    @endforeach
   
</ul>
</div>

<!-- /Sidebar -->