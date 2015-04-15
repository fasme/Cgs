<style>
tr > td {
    border-bottom: 1px solid #000000;
}
</style>
<?php
	 $proyectos = Proyecto::Where("proyecto.id","=",$id)->get();
$costodirecto =0;
	 echo "<table border='1' width='100%'>";
	 foreach ($proyectos as $proyecto) {
	 	
	 	echo "<tr><td>Designacion</td><td>Unidad</td><td>Cantidad</td><td>PU</td><td>Total</td></tr>";
	 	echo "<tr><td colspan='5' style='background-color: #BFBFBF; font-weight: bold; text-align:center; vertical-align:middle;' height='50' >PRESUPUESTO DE OBRAS: ".$proyecto->nombre."</td></tr>";
	 	$obras = Obra::Where("proyecto_id","=",$proyecto->id)->get();

	 	foreach ($obras as $obra) {
	 		echo "<tr><td bgcolor='green' colspan='5' height='50' style='background-color: #BFBFBF; vertical-align:middle; text-align:center'>".$obra->nombre."</td></tr>";
	 		$partidacategorias = Partidacategoria::Where("obra_id","=",$obra->id)->get();
	 		
	 		foreach ($partidacategorias as $partidacategoria) {

	 		echo "<tr><td style='font-weight:bold' colspan='5' height='30'>".$partidacategoria->nombre."</td></tr>";

	 			$partidas = Partida::Where("obra_id","=",$obra->id)->Where("categoria_id","=",$partidacategoria->id)->get();
	 			foreach ($partidas as $partida) {
	 				$suma =0; 
  foreach($partida->apu as $apu){
$suma += round($apu->cantidad*$apu->preciou*(1/$partida->cantidad)); 

}
    $costodirecto += round($suma*$partida->cantidad);
   
	 				//echo "<tr><td>".utf8_decode($partida->nombre)."</td><td>".$partida->unidad."</td><td>".number_format($partida->cantidad,3,",",".")."</td><td>".$suma."</td><td>".number_format($partida->cantidad*$suma,0,",",".")."</td></tr>";
    echo "<tr><td>".utf8_decode($partida->nombre)."</td><td>".$partida->unidad."</td><td>".number_format($partida->cantidad,3,",",".")."</td><td>".$suma."</td><td>".$partida->cantidad*$suma."</td></tr>";
	 			}
	 		
	 		}
	 	}

	 	$utilidadproyecto = Proyecto::where("id","=",Session::get("proyecto")->id)->select("utilidad")->first();
	 	
	 	$utilidad = ($costodirecto*$utilidadproyecto->utilidad)/100;
	 	

	 	$gastogeneral = Gastogeneral::Where("proyecto_id","=",$proyecto->id)->selectraw("SUM(cantidad * precio) as totalgastos")->take(1)->get();

	 	$totalneto = $utilidad + $costodirecto + $gastogeneral[0]->totalgastos;

	 	echo "<tr style='background-color: #BFBFBF; font-weight: bold;'><td >VALOR COSTO DIRECTO</td><td></td><td></td><td></td><td>".number_format($costodirecto,0,",",".")."</td></tr>";
	 	echo "<tr bgcolor='#F2F2F2'><td>UTILIDAD $utilidadproyecto->utilidad%</td><td></td><td></td><td></td><td>".number_format($utilidad,0,",",".")."</td></tr>";
		echo "<tr style='background-color: #BFBFBF; font-weight: bold;'><td>GASTOS GENERALES</td><td></td><td></td><td></td><td>".number_format($gastogeneral[0]->totalgastos,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#F2F2F2'><td>TOTAL NETO</td><td></td><td></td><td></td><td>".number_format($totalneto,0,",",".")."</td></tr>";
		echo "<tr style='background-color: #BFBFBF; font-weight: bold;'><td>IVA</td><td></td><td></td><td></td><td>".number_format($totalneto*0.19,0,",",".")."</td></tr>";
		echo "<tr bgcolor='#F2F2F2'><td>TOTAL</td><td></td><td></td><td></td><td>".number_format($totalneto*1.19,0,",",".")."</td></tr>";
		
	 }

	 echo "</table>";

	 ?>