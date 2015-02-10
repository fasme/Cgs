
<table border='1'>
@foreach($proyecto as $proyectos)
<tr><td>{{$proyectos->nombre}}</td></tr>

	@foreach($proyectos->obra as $obra)
	<tr><td>	{{$obra->nombre}}</td></tr>

		@foreach($obra->partidacategoria as $partidacategoria)
			<tr><td>{{$partidacategoria->nombre}}</td></tr>


			@foreach($partidacategoria->partida as $partida)
			{{count($partidacategoria->partida)}}
			<tr><td>{{$partida->nombre}}</td></tr>
			@endforeach
			
		@endforeach
	@endforeach
	
@endforeach
</table>

