@extends('layouts.master')
 
@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="icon-home home-icon"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('ordencompra') }}>Cheques</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Orden de compra</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Orden de compra
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  <div class="span12">





        {{ Form::open(array('url' => 'ordencompra/editar/'.$ordencompra->id)) }}
        
       
            {{Form::label('Proveedor', 'Proveedor')}}
            {{Form::select('proveedor_id', $proveedores, $ordencompra->proveedor_id,array('id' => 'proveedores'))}}
           
          
          
            {{Form::label('Fecha','Fecha')}}
            {{Form::text('fecha',date_format(date_create($ordencompra->fecha),'d/m/Y'),array('class'=>'input-mask-date'))}}
         

          
</div>
   </div><!--/row-->

    <div class="row-fluid">
  <div class="span2">

 
        
       
            {{Form::label('Material', 'Material')}}
  
</div>
  <div class="span2">


        
       
            {{Form::label('Cantidad', 'Cantidad')}}

</div>
  <div class="span2">


        
       
            {{Form::label('Unidad Med', 'Unidad Med')}}

</div>
  <div class="span2">

       
        
       
            {{Form::label('Valor u', 'Valor u')}}

</div>
  <div class="span2">

   
        
       
            {{Form::label('Valor Total', 'Total')}}

</div>
  <div class="span2">

   
           
       
</div>



   </div><!--/row-->

{{ $ordencompra->ordencompradetalle->count()  }}

<?php 
$i = -1;
?>
@foreach ($ordencompra->ordencompradetalle as $detalle)
<?php
$i++;
?>



   <div class="row-fluid">
  <div class="span2">

 
        
       

            {{Form::text("oc[$i][nombre]",$detalle->nombre)}} 
</div>
  <div class="span2">


        
       

            {{Form::text("oc[$i][cantidad]",$detalle->cantidad, array("id"=>"cantidad$i"))}} 
</div>
  <div class="span2">


        
       
            {{Form::text("oc[$i][medida]",$detalle->medida)}} 
</div>
  <div class="span2">

       
        
       

           {{Form::text("oc[$i][valoru]",$detalle->valoru, array("id"=>"valoru$i"))}} 
</div>
  <div class="span2">

   

            {{Form::text('valortotal','', array("id"=>"total$i"))}} 
</div>
  <div class="span2">

   
           
       
</div>



   </div><!--/row-->

@endforeach

   

@for ($j = 0; $j < 4-$ordencompra->ordencompradetalle->count(); $j++) 
<?php
$i++;
?>



   <div class="row-fluid">
  <div class="span2">

 
        
       

            {{Form::text("oc[$i][nombre]",'')}} 
</div>
  <div class="span2">


        
       

            {{Form::text("oc[$i][cantidad]",'', array("id"=>"cantidad$i"))}} 
</div>
  <div class="span2">


        
       
            {{Form::text("oc[$i][medida]",'')}} 
</div>
  <div class="span2">

       
        
       

           {{Form::text("oc[$i][valoru]",'', array("id"=>"valoru$i"))}} 
</div>
  <div class="span2">

   

            {{Form::text('valortotal','', array("id"=>"total$i"))}} 
</div>
  <div class="span2">

   
           
       
</div>



   </div><!--/row-->

@endfor



     <div class="row-fluid">
  <div class="span6">

</div>
<div class="span2">

 Total Neto
</div>
  <div class="span2">

            {{Form::text('cantidad','', array("id"=>"totalneto"))}} 
</div>
   </div>


        <div class="row-fluid">
  <div class="span6">

</div>
<div class="span2">

 19%
</div>
  <div class="span2">

            {{Form::text('cantidad','', array("id"=>"iva"))}} 
</div>
   </div>


           <div class="row-fluid">
  <div class="span6">

</div>
<div class="span2">

Total
</div>
  <div class="span2">

            {{Form::text('cantidad','', array("id"=>"totaltotal"))}} 
</div>
   </div>



   <div class="row-fluid">
<div class="span12">
{{Form::label("Tel. Cel.")}}
{{Form::text("telcel",$ordencompra->telcel)}}
{{Form::label("Mercaderia puesta en")}}
{{Form::text("mercaderia",$ordencompra->mercaderia)}}
{{Form::label("Fecha Entrega.")}}
{{Form::text("fechaentrega",date_format(date_create($ordencompra->fechaentrega),'d/m/Y'),array('class'=>'input-mask-date'))}}
{{Form::label("cond. de pago")}}
{{Form::text("pago",$ordencompra->pago)}}
</div>
</div>



{{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
      

<script>
  $(document).ready(function(){
   
    $('input').change(function(){
      
    var total0 = parseInt($('#cantidad0').val()) * parseInt($('#valoru0').val()) ;
    if(isNaN(total0))
    {
      total0 = 0;
    }
    $("#total0").val(total0);
    
    
    var total1 = parseInt($('#cantidad1').val()) * parseInt($('#valoru1').val()) ;
    if(isNaN(total1))
    {
      total1 = 0;
    }
    $("#total1").val(total1);

    var total2 = parseInt($('#cantidad2').val()) * parseInt($('#valoru2').val()) ;
    if(isNaN(total2))
    {
      total2 = 0;
    }
    $("#total2").val(total2);

    var total3 = parseInt($('#cantidad3').val()) * parseInt($('#valoru3').val()) ;
    if(isNaN(total3))
    {
      total3 = 0;
    }
    $("#total3").val(total3);

    var neto = total0 + total1 + total2 + total3;
    $("#totalneto").val(neto);

    var iva = (neto*19)/100;
    $("#iva").val(iva);

    var totaltotal = neto + iva;
    $("#totaltotal").val(totaltotal);
    });




    var total0 = parseInt($('#cantidad0').val()) * parseInt($('#valoru0').val()) ;
    if(isNaN(total0))
    {
      total0 = 0;
    }
    $("#total0").val(total0);
    
    
    var total1 = parseInt($('#cantidad1').val()) * parseInt($('#valoru1').val()) ;
    if(isNaN(total1))
    {
      total1 = 0;
    }
    $("#total1").val(total1);

    var total2 = parseInt($('#cantidad2').val()) * parseInt($('#valoru2').val()) ;
    if(isNaN(total2))
    {
      total2 = 0;
    }
    $("#total2").val(total2);

    var total3 = parseInt($('#cantidad3').val()) * parseInt($('#valoru3').val()) ;
    if(isNaN(total3))
    {
      total3 = 0;
    }
    $("#total3").val(total3);

    var neto = total0 + total1 + total2 + total3;
    $("#totalneto").val(neto);

    var iva = (neto*19)/100;
    $("#iva").val(iva);

    var totaltotal = neto + iva;
    $("#totaltotal").val(totaltotal);




    $('.input-mask-date').mask('99/99/9999');
$( "#ordencompraactive" ).addClass( "active" );
    
  });   
</script>

@stop


