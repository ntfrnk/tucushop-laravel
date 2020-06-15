@extends('store.in')

@section('section.admin', 'Centro de mensajes')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body card-body-pad">

				<div class="card-body-title">
					{{-- <div class="input-group col-md-6 f-right padR0">
						<input type="text" class="form-control" placeholder="Buscar un mensaje" aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i> &nbsp;Buscar</button>
						</div>
					</div> --}}
					<h1>Centro de mensajes</h1>
					<hr>
				</div>
				@if($messages->count()!=0)
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="w65">Producto consultado</th>
								<th class="w35 a-right">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($messages as $message)
							<tr>
								<td class="{{ $message->readed == 0 ? 'b' : '' }}">
									{!! $message->readed == 0 ? '<span class="badge badge-success marR10 d-none d-md-inline-block">Sin leer</span>' : '' !!}
									{!! $message->readed == 0 ? '<span class="badge badge-success marR10 d-inline-block d-md-none">N</span>' : '' !!}
									{{ $message->item->name }}
								</td>
								<td class="a-right">
									<a href="{{ route('store.message.read', ['alias' => $store->alias,'message_id' => $message->id]) }}" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i><span class="d-none d-md-inline-block"> Ver mensaje</span></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<table class="table">
						<tr>
							<td class="padTB50 f17 align-center">
								<p class="marB10"><em>Aún no te enviaron ningún mensaje</em></p>
							</td>
						</tr>
					</table>
				@endif

				<div class="a-center marT30">
					<hr>
					<div class="marAuto inline-block">
						{{ $messages->links() }}
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
	
</div>

@endsection