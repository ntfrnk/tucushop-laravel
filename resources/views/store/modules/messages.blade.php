@extends('store.index')

@section('section.admin', 'Centro de mensajes')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body pad30">

				<div class="f17 marB30">
					<div class="input-group col-md-6 f-right padR0">
						<input type="text" class="form-control" placeholder="Buscar un mensaje" aria-label="Recipient's username" aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i> &nbsp;Buscar</button>
						</div>
					</div>
					<h1 class="f30 marB15">Centro de mensajes</h1>
					<hr>
				</div>
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
							<td>{{ $message->item->name }}</td>
							<td class="a-right">
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-camera"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-star"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-tag"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-ban"></i></a>
								<a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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