<!DOCTYPE html>
<html>

<head>
	<title>{{ $title }}</title>
</head>

<body>
	{{-- <p>{{ $description }}</p> --}}
	<h3 style="text-align: center; margin-bottom: 20px">Lista de Vehículos</h3>
	<table class="table">
		<thead>
			<th style="width: 40px;background: rgb(240, 234, 234)">#</th>
			<th style="width: 150px; text-align: left; background: rgb(240, 234, 234); padding: 10px">Nombre</th>
			<th style="width: 150px; text-align: left; background: rgb(240, 234, 234); padding: 10px">Marca</th>
			<th style="width: 150px; text-align: left; background: rgb(240, 234, 234); padding: 10px">N° placa</th>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<th style="width: 40px;">{{$item->id}}</th>
				<td style="width: 150px">{{$item->name}}</td>
				<td style="width: 150px; text-align: left">{{$item->brand->name}}</td>
				<td style="width: 150px; text-align: left">{{$item->number_plate}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>

</html>