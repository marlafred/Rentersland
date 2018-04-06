<div class="content-wrap">
    <div class="content-wrap">
        <div class="col-sm-8">
            <h3 class="heading"><strong>Showing Results: ({{ count($listings) }})</strong></h3>
            @include('templates.listings.listing-left')
        </div>

        <div class="col-sm-4">
            @include('templates.listings.listing-sidebar')
        </div>

        @include('templates.listings.listing-bottom')

        <?php $locations=array(); $count= 1; ?>
        @if($listings)
            @foreach ($listings as $list)
                @if($list->lat!='')
                    <?php $locations[]=array( 'name'=>$list->address, 'lat'=>$list->lat, 'lng'=>$list->lng ); ?>
                    <?php $count++; ?>
                @endif
            @endforeach
        @endif

    </div>
</div><!--content-wrap-->

<?php $markers = json_encode( $locations ); ?>