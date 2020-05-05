@extends('store.index')

@section('section.admin', 'Home')

@section('admin')

<div class="row justify-content-center">
	<div class="col-md-12 mainbar">
		<div class="card marB20">
			<div class="card-body pad30">
				<div class="marB30">
					<div class="a-right f-right">
						<a href="" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar un nuevo administrador</a>
					</div>
                    <h1 class="f30 marB15">Administradores del negocio</h1>
                    <hr>
                </div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="w65">Nombre del administrador (e-mail)</th>
							<th class="w35 a-right">Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($admins as $admin)
						<tr>
							<td>
								{{ $admin->user->profile->name }} {{ $admin->user->profile->lastname }} 
								({{ $admin->user->email }})
							</td>
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
						{{ $admins->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
</div>

@endsection