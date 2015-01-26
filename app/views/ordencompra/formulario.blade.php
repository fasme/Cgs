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


           <?php
  // si existe el usuario carga los datos
    if ($ordencompra->exists):
        $form_data = array('url' => 'ordencompra/editar/'.$ordencompra->id);
        $action    = 'Editar';

       // foreach ($ordencompra->ordencompradetalle as $detalle) {
          echo $ordencompra->ordencompradetalle[0]->id;
          # code...
       // }
        
    else:
        $form_data = array('url' => 'ordencompra/crear');
        $action    = 'Crear';    
      

    endif;

?>


        {{ Form::open($form_data) }}
        
       
            {{Form::label('Proveedor', 'Proveedor')}}
            {{Form::select('proveedor_id', $proveedores, $ordencompra->proveedor_id,array('id' => 'proveedores'))}}
           
          
          
            {{Form::label('Fecha','Fecha')}}
            {{Form::text('fecha',date_format(date_create($ordencompra->fecha),'d/m/Y'),array('class'=>'input-mask-date'))}}
         

          
</div>
   </div><!--/row-->

   <div class="row-fluid">
  <div class="span2">

 
        
       
            {{Form::label('Material', 'Material')}}
            {{Form::text('oc[0][nombre]',isset($ordencompra->ordencompradetalle[0]->id))}} 
</div>
  <div class="span2">


        
       
            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('oc[0][cantidad]','', array("id"=>"cantidad0"))}} 
</div>
  <div class="span2">


        
       
            {{Form::label('Unidad Med', 'Unidad Med')}}
            {{Form::text('oc[0][medida]','')}} 
</div>
  <div class="span2">

       
        
       
            {{Form::label('Valor u', 'Valor u')}}
           {{Form::text('oc[0][valoru]','', array("id"=>"valoru0"))}} 
</div>
  <div class="span2">

   
        
       
            {{Form::label('Valor Total', 'Total')}}
            {{Form::text('valortotal','', array("id"=>"total0"))}} 
</div>
  <div class="span2">

   
           
       
</div>



   </div><!--/row-->



   <div class="row-fluid">
  <div class="span2">

 
        
       
          
            {{Form::text('oc[1][nombre]','')}} 
</div>
  <div class="span2">


        
       

            {{Form::text('oc[1][cantidad]','', array("id"=>"cantidad1"))}} 
</div>
  <div class="span2">


        
       
        
            {{Form::text('oc[1][medida]','')}} 
</div>
  <div class="span2">

       
        
       
   
           {{Form::text('oc[1][valoru]','', array("id"=>"valoru1"))}} 
</div>
  <div class="span2">

   
        
       

            {{Form::text('valorutotal','', array("id"=>"total1"))}} 
</div>
  <div class="span2">

   
           
       
</div>


       
   </div><!--/row-->


   <div class="row-fluid">
  <div class="span2">

 
        
       
          
            {{Form::text('oc[2][nombre]','')}} 
</div>
  <div class="span2">


        
       

            {{Form::text('oc[2][cantidad]','', array("id"=>"cantidad2"))}} 
</div>
  <div class="span2">


        
       
        
            {{Form::text('oc[2][medida]','')}} 
</div>
  <div class="span2">

       
        
       
   
           {{Form::text('oc[2][valoru]','', array("id"=>"valoru2"))}} 
</div>
  <div class="span2">

   
        
       

            {{Form::text('valortotal','', array("id"=>"total2"))}} 
</div>
  <div class="span2">

   
           
       
</div>


       
   </div>


   <div class="row-fluid">
  <div class="span2">

 
        
       
          
            {{Form::text('oc[3][nombre]','')}} 
</div>
  <div class="span2">


        
       

           {{Form::text('oc[3][cantidad]','', array("id"=>"cantidad3"))}} 
</div>
  <div class="span2">


        
       
        
            {{Form::text('oc[3][medida]','')}} 
</div>
  <div class="span2">

       
        
       
   
           {{Form::text('oc[3][valoru]','', array("id"=>"valoru3"))}} 
</div>
  <div class="span2">

   
        
       

            {{Form::text('valortotal','', array("id"=>"total3"))}} 
</div>
  <div class="span2">

   
           
       
</div>


       
   </div>



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



{{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
        {{Form::button('Calcular', array('class'=>'btn btn-small btn-warning'))}}

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

    $('.input-mask-date').mask('99/99/9999');
$( "#ordencompraactive" ).addClass( "active" );
    
  });   
</script>

@stop


