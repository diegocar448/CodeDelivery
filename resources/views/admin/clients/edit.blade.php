@extends('app')

@section('content')

	<div class="container">
		<h3>Editando cliente: {{ $client->user->name }}</h3>	

		@include('errors._check')

		<!-- pega os dados do objeto client com a rota mais o id-->
		{!! Form::model($client, ['route'=>['admin.clients.update', $client->id]]) !!}

			@include('admin.clients._form')

			<div class="form-group">
				{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
			</div>

		{!! Form::close() !!}
	</div>	
@endsection
