@extends('app')


@section('content')

	<div class="container">
		<h3>Novo Pedido</h3>		

		@include('errors._check')	

		<div class="container">
			{!! Form::open(['class'=>'form']) !!}
	
			<div class="form-group">				
				<label>Total:</label>
				<p id="total"></p>
				<a href="#" id="btnNewItem" class="btn btn-default">Novo Item</a>

				<table class="table table-bordered">
					<thead>
						<tr>
							<td>Produto</td>
							<td>Quantidade</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select name="items[0][product_id]" class="form-control">
									@foreach($products as$p)
										<option value="{{ $p->id }}" data-price="{{ $p->price }}">{{ $p->name }} --- {{ $p->price }}</option>
									@endforeach
								</select>
							</td>
							<td>
								{!! Form::text('items[0][qtd]', 1, ['class'=>'form-control']) !!}						
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			{!! Form::close() !!}
		</div>
@endsection

@section('post-script')
	<script>
	//geramos a linha
	//alteramos os indices
	// a gente vai gerar essa linha atras da ultima linha
	$('#btnNewItem').click(function(){
		var row = $('table tbody > tr:last'),
			newRow = row.clone(),
			length = $("table tbody tr").length;

		// para cada td encontrada fara um each
		newRow.find('td').each(function(){
			var td = $(this),
				input = td.find('input,select'), //pegar input e select
				name = input.attr('name'); //vamos pegar o name


			input.attr('name', name.replace((length-1) + "", length + ""));
		});


		newRow.find('input').val(1);
		newRow.insertAfter(row);

		calculateTotal();
	});


	//como os valores trabalham dinamicamente teremos que usar o ON do jQuery
	$(document.body).on('click','select', function() {
		calculateTotal();
	});

	//toda vez que sair do campo fara o calculo novamente
	//usar blur quando o campo for um input
	$(document.body).blur('blur','input', function() {
		calculateTotal();
	});

	function calculateTotal(){
		var total = 0, //pegar o total
			trLen =  $('table tbody tr').length, //pegar quantas linha tiver
			tr = null,price, qtd;  //acabamos de setar o valor da nossa tr

		for(var i=0; i < trLen; i++) //agora faremos loop
		{
			tr = $('table tbody tr').eq(i); //focando no nosso indice do i
			price = tr.find(':selected').data('price'); //o valor que esta selecionado (o atributo data-price do <option>)
			qtd = tr.find('input').val();   // vamos pegar as quantidades
			total += price*qtd
		}

		$('#total').html(total); //vamos atualizar

	}


		
	</script>
@endsection