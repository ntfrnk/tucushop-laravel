{{-- Data importante para JS --}}

{{-- Ocultamos la capa contenedora --}}
<div class="none">
	<span id="url_base">{{ route('home') }}</span>
	<span id="url_prev">{{ url()->previous() }}</span>
	<span id="url_now">{{ url()->current() }}</span>
	<span id="token">{{ csrf_token() }}</span>
	<span id="name_page">{{ config('app.name', 'Laravel') }}</span>
	<span id="sess">{{ \Auth::user() ? '1' : '' }}</span>
</div>