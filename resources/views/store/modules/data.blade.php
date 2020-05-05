@extends('store.index')

@section('section.admin', 'Datos de contacto')

@section('admin')

<div class="row justify-content-center">
    <div class="col-md-12 mainbar">
        <form method="POST" action="{{ route('register') }}">
        
			<div class="card">

                <div class="card-body pad30">

                    <div class="f17 marB30">
                        <h1 class="f30 marB15">Datos de contacto</h1>
                        <hr>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                        <div class="col-md-6 input-group">
							<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $store->profile->email ? $store->profile->email : '' }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Sitio Web') }}</label>

                        <div class="col-md-6 input-group">
                        	<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon3">http://</span>
							</div>
							<input type="text" id="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $store->profile->website ? $store->profile->website : '' }}" required autocomplete="website">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono fijo') }}</label>

                        <div class="col-md-6 input-group">
							<input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $store->profile->phone ? $store->profile->phone : '' }}" required autocomplete="phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cellphone" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                        <div class="col-md-6 input-group">
							<input type="text" id="cellphone" class="form-control @error('cellphone') is-invalid @enderror" name="cellphone" value="{{ $store->profile->cellphone ? $store->profile->cellphone : '' }}" required autocomplete="cellphone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">facebook.com/</span>
							</div>
							<input type="text" id="facebook" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $store->profile->facebook ? $store->profile->facebook : '' }}" required autocomplete="facebook">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instagram" class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">instagram.com/</span>
							</div>
							<input type="text" id="instagram" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ $store->profile->instagram ? $store->profile->instagram : '' }}" required autocomplete="instagram">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pinterest" class="col-md-4 col-form-label text-md-right">{{ __('Pinterest') }}</label>

                        <div class="col-md-6 input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">pinterest.com/</span>
							</div>
							<input type="text" id="pinterest" class="form-control @error('pinterest') is-invalid @enderror" name="pinterest" value="{{ $store->profile->pinterest ? $store->profile->pinterest : '' }}" required autocomplete="pinterest">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar cambios') }}
                            </button>
                        </div>
                    </div>
            	</div>
        	</div>

        </form>
    </div>
</div>

@endsection