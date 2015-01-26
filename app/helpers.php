<?php

function CalcularDiasCheque($fecha)
{

	$s= intval(strtotime($fecha)-strtotime(date("Y-m-d")))/86400;
    return "(".$s." Dias)";
}

?>