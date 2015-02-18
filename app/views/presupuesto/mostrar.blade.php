
<?php $proyectos = Proyecto::Where("proyecto.id","=",1)->get(); ?>

@foreach ($proyectos as $proyecto) {
	
	<?php $obras = Obra::Where("proyecto_id","=",$proyecto->id)->get(); ?>
	@foreach ($obras as $obra) {
{{$obra->nombre}}
	}
	@endforeach
}
@endforeach


