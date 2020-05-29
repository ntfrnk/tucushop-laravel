{{-- Loader --}}

<div class="loader">
    <div class="loader-bg"></div>
    <div class="loader-container">
        <div>
            <div class="loader-spinner"></div>
        </div>
    </div>
</div>

{{-- Scripts (cargan al final) --}}

<script src="{{ asset('scripts/app.js') }}" defer></script>
<script src="{{ asset('scripts/jquery-ui.js') }}" defer asinc></script>
<script src="//assets.pinterest.com/js/pinit.js" defer asinc></script>
<script src="//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v7.0&appId=680360878656194&autoLogAppEvents=1" async defer crossorigin="anonymous"></script>
<script src="//platform.twitter.com/widgets.js" charset="utf-8" defer async></script>
<script src="{{ asset('plugins/OwlCarousel/owl.carousel.js') }}" defer></script>
<script src="{{ asset('plugins/EasyAutocomplete/jquery.easy-autocomplete.min.js') }}" defer></script>
<script src="{{ asset('comp/all.min.js') }}" defer asinc></script>
<script src="{{ asset('scripts/tshop.basics.js') }}" defer asinc></script>
<script src="{{ asset('scripts/tshop.feedback.js') }}" defer asinc></script>
@section('scripts')
@show
@section('actionsjs')
@show