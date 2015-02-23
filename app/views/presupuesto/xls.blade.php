<?php
	 $proyectos = Proyecto::Where("proyecto.id","=",$id)->get();
$costodirecto =0;
	 echo "<table border=1 width='100%'>";
	 foreach ($proyectos as $proyecto) {
	 	
	 	echo "<tr><td>Nombre</td></tr>";
	 	echo "<tr><td colspan='5'>".$proyecto->nombre."</td></tr>";
	 	$obras = Obra::Where("proyecto_id","=",$proyecto->id)->get();

	 	foreach ($obras as $obra) {
	 		echo "<tr><td bgcolor='green' colspan='5'>".$obra->nombre."</td></tr>";
	 		$partidacategorias = Partidacategoria::Where("obra_id","=",$obra->id)->get();
	 		
	 		foreach ($partidacategorias as $partidacategoria) {

	 		echo "<tr bgcolor='yellow'><td bgcolor='yellow' colspan='5'>".$partidacategoria->nombre."</td></tr>";

	 			$partidas = Partida::Where("obra_id","=",$obra->id)->Where("categoria_id","=",$partidacategoria->id)->get();
	 			foreach ($partidas as $partida) {
	 				$suma =0; 
  foreach($partida->apu as $apu){
$suma += round($apu->cantidad*$apu->preciou*(1/$partida->cantidad)); 

}
    $costodirecto += round($suma*$partida->cantidad);
   
	 				echo "<tr><td>".utf8_decode($partida->nombre)."</td><td>".$partida->unidad."</td><td>".number_format($partida->cantidad,3,",",".")."</td><td>".$suma."</td><td>".number_format($partida->cantidad*$suma,0,",",".")."</td></tr>";
	 			}
	 		
	 		}
	 	}

	 	$utilidad = $costodirecto*0.12;

	 	$gastogeneral = Gastogeneral::Where("proyecto_id","=",$proyecto->id)->selectraw("SUM(cantidad * precio) as totalgastos")->take(1)->get();

	 	$totalneto = $utilidad + $costodirecto + $gastogeneral[0]->totalgastos;

	 	echo "<tr bgcolor='#E6E6E6'><td>VALOR COSTO DIRECTO</td><td></td><td></td><td></td><td>".number_format($costodirecto,0,",",".")."</td></tr>";
	 	echo "<tr bgcolor='#F2F2F2'><td>UTILIDAD 12%</td><td></td><td></td><td></td><td>".number_format($utilidad,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#E6E6E6'><td>GASTOS GENERALES</td><td></td><td></td><td></td><td>".number_format($gastogeneral[0]->totalgastos,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#F2F2F2'><td>TOTAL NETO</td><td></td><td></td><td></td><td>".number_format($totalneto,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#E6E6E6'><td>IVA</td><td></td><td></td><td></td><td>".number_format($totalneto*0.19,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#F2F2F2'><td>TOTAL</td><td></td><td></td><td></td><td>".number_format($totalneto*1.19,0,",",".")."</td></tr>";
		
	 }

	 echo "</table>";

	 ?>