<footer class="footer">
    <div class="container">
            <div class="row">
                    <div class="col-sm-3">
                            <h3 class="footer-heading">Company</h3>
                            <ul class="links">
                                @if(count($company) > 0)
                                @foreach($company as $nav)
                                @if(isset($nav->pages->label))
                                    <li><a href="{{ url('/') }}/{{ $nav->pages->slug }}">{{ $nav->pages->label }}</a></li>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">support</h3>
                            <ul class="links">
                                @if(count($support) > 0)
                                @foreach($support as $nav)
                                @if(isset($nav->pages->label))
                                <li><a href="{{ url('/') }}/{{ $nav->pages->slug }}">{{ $nav->pages->label }}</a></li>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">Short links</h3>
                            <ul class="links">
                                @if(count($short_links) > 0)
                                @foreach($short_links as $nav)
                                @if(isset($nav->pages->label))
                                    <li><a href="{{ url('/') }}/{{ $nav->pages->slug }}">{{ $nav->pages->label }}</a></li>
                                @endif
                                @endforeach
                                @endif
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">get connected</h3>
                            <ul class="social">
                                @if(isset($setting->facebook) and $setting->facebook!='')
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                @endif
                                @if(isset($setting->twitter) and $setting->twitter!='')
                                    <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                @endif
                                @if(isset($setting->instagram) and $setting->instagram!='')
                                    <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                @endif
                                @if(isset($setting->google_plus) and $setting->google_plus!='')
                                    <li><a href="{{ $setting->google_plus }}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                @endif
                            </ul>
                    </div>
            </div>
    </div>
</footer>

<input type="hidden" id="base_url" value="{{ url('/') }}">

<!------ Simple Popup ----------> 
<a href="javascript:void(0);" class="cd-popup-trigger" data-backdrop="static" data-keyboard="false" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p></p>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup --> 