@extends('master')
@section('title', 'How It Works')
@section('body')
<style>
#newsletter{margin-top:0;}
</style>
<!-- Breadcrumb Heading -->
<div class="breadcrumb">
	<div class="data">
            <h1>
                @if(isset($page->headline) and $page->headline!='')
                    {{ $page->headline }}
                @endif
            </h1>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="javascript:void(0);">{{ $page->label }}</a></li>
            </ul>
	</div>
</div>
<!-- /Breadcrumb Heading -->

<!-- Welcome Section -->
<div class="container static-pages">
    <div class="clearfix"></div>
    <div class="row">
        <?php $col = 12; ?>
        @if(isset($page->left_sidebar_image) and $page->left_sidebar_image!='')
            <?php $col = $col - 3; ?>
            <div class="col-sm-3">
                <img src="{{ asset('static/') }}/{{ $page->left_sidebar_image }}" class="img-responsive">
            </div>
        @endif
        
        @if(isset($page->right_sidebar_image) and $page->right_sidebar_image!='')
            <?php $col = $col - 3; ?>
        @endif

        @if(isset($page->content) and $page->content!='')
            <div class="col-sm-{{ $col }}">
                <?php print  nl2br($page->content) ?>
            </div>
        @endif

        @if(isset($page->right_sidebar_image) and $page->right_sidebar_image!='')
            <div class="col-sm-3">
                <img src="{{ asset('static/') }}/{{ $page->right_sidebar_image }}" class="img-responsive">
            </div>
        @endif
    </div><!--row-->
</div>
<!-- /Call to action -->
@stop