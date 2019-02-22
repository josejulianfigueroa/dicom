
<html>
<head>
	<title> @yield('title') </title>
<!--PARA UTILIZAR EL CALENDARIO-->
<link rel="stylesheet" href="{{asset('lib/themes/default.css')}}" id="theme_base">
<link rel="stylesheet" href="{{asset('lib/themes/default.date.css')}}" id="theme_date">
<link rel="stylesheet" href="{{asset('lib/themes/default.time.css')}}" id="theme_time">
<!--FIN PARA UTILIZAR EL CALENDARIO-->

    <!--PARA UTILIZAR EN LAS TABS-->
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <!-- se quito por el de arriba local <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <!--FIN PARA UTILIZAR EN LAS TABS-->

 <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
     <script defer src="{{asset('js/all.js')}}"></script>
      <!-- esta arriba de esto Font Awesome se quito por el de arriba local 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
   <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    -->

  <link rel="stylesheet" type="text/css" href="{{asset('css/family_roboto.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/material_icons.css')}}">
	<!-- Material Design fonts 
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">-->

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<!-- Bootstrap Material Design 
	<link rel="stylesheet" type="text/css" href="material-design/css/bootstrap-material-design.css">-->
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-material-design.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/ripples.css')}}">
	<!--<link rel="stylesheet" type="text/css" href="material-design/css/ripples.min.css">
	  <meta name="csrf-token" content="{{ csrf_token() }}">-->

<!--PARA UTILIZAR EL CALENDARIO
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css">-->
 <link rel="shortcut icon" href="{{asset('imgs/favicon.ico')}}" type="image/x-icon" />


  <style type="text/css">

 </style>



</head>
<body>
	@include('materialdesign.navbar')
    <!--PARA UTILIZAR EN LAS NOTIFICACIONES-->
<script src="{{asset('lib/push.min.js')}}"></script>
<!--FIN PARA UTILIZAR EN LAS NOTIFICACIONES-->

	@yield('content')
	<script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<!--<script src="material-design/js/ripples.min.js"></script>
	<script src="material-design/js/material.min.js"></script>-->
	<script src="{{asset('js/material.min.js')}}"></script>
<script src="{{asset('js/ripples.min.js')}}"></script>

<!--PARA UTILIZAR EN LAS TABS-->
  <script src="{{asset('js/jquery-ui.js')}}"></script>
<!--FIN PARA UTILIZAR EN LAS TABS-->



<!--PARA UTILIZAR EL CALENDARIO-->
  <script src="{{asset('lib/picker.js')}}"></script>
    <script src="{{asset('lib/picker.date.js')}}"></script>
    <script src="{{asset('lib/picker.time.js')}}"></script>
    <script src="{{asset('lib/legacy.js')}}"></script>
    <script src="{{asset('demo/scripts/demo.js')}}"></script>
    <script src="{{asset('demo/scripts/rainbow.js')}}"></script>
<!--FIN PARA UTILIZAR EL CALENDARIO-->




	<script type="text/javascript">
        
 function Solo_Numerico(variable){
                Numer=parseInt(variable);
                if (isNaN(Numer)){
                    return "";
                }
                return Numer;
            }
            function ValNumero(Control){
                Control.value=Solo_Numerico(Control.value);
            }

            
  //$(function () {
             //   $('#datetimepicker1').datetimepicker();
    //        });
  //$('[data-toggle="tooltip"]').tooltip();
    //    $(".fecha").datetimepicker({ format: 'DD/MM/YYYY' });

//CARGAR MEDIO DE PAGO PARA EMITIR COMPROBANTE DE PAGO
  function getval(e) {
        $("#tipo_pago").val();
        $("#ver1").css('display','none');
        $("#ver2").css('display','none');
        $("#ver3").css('display','none');
        $("#ver4").css('display','none');
        $("#pagando_div").css('display','block');

    if($("#tipo_pago").val() == "EFECTIVO")
    {
        $("#ver1").css('display','block');
        $("#ver2").css('display','block');
        $("#ver3").css('display','block');
        $("#ver4").css('display','block');
        $("#pagando_div").css('display','none');
        $("#otro_monto1").css('background-color','yellow');
        $("#otro_monto3").css('background-color','#8EF76F');
        
        //$("#otro_monto1").val("");

    }else if ($("#tipo_pago").val() == "VALE VISTA" || $("#tipo_pago").val() == "CHEQUE" || $("#tipo_pago").val() == "TRANSFERENCIA"){
        $("#ver1").css('display','block');
        $("#otro_monto1").css('background-color','#1DC9F3');
        $("#pagando_div").css('display','block');
        // $("#otro_monto1").val($("#acumula2").val());
    }else{

    }
   
    }
 //FIN CARGAR MEDIO DE PAGO PARA EMITIR COMPROBANTE DE PAGO  

//VALIDAR INGRESO DE SOLO NUMEROS EN UN CAMPO DE BUSQUEDA
   $("#redondeo").click(function(e){

 if (isNaN($('#otro_monto1').val()) == false && isNaN($('#otro_monto2').val()) == false 
    && $('#otro_monto1').val() != "" && $('#otro_monto2').val() != "")
 {
                    
               if($("#tipo_pago").val() == "EFECTIVO"){
var acumulax=parseInt($('#otro_monto1').val());

if (acumulax.toString() == "0") {
}else{
if (acumulax.toString().charAt(acumulax.toString().length-1) == 0)
{
}else{
if (acumulax.toString().charAt(acumulax.toString().length-1) == 1 || acumulax.toString().charAt(acumulax.toString().length-1) == 2 || acumulax.toString().charAt(acumulax.toString().length-1) == 3 || acumulax.toString().charAt(acumulax.toString().length-1) == 4 || acumulax.toString().charAt(acumulax.toString().length-1) == 5)
{   
acumulax=acumulax.toString().substr(0,acumulax.toString().length-1).concat("0");
}
else{
if (acumulax.toString().charAt(acumulax.toString().length-1) == 6){
acumulax=acumulax+4;
}
if (acumulax.toString().charAt(acumulax.toString().length-1) == 7){
acumulax=acumulax+3;  
}
if (acumulax.toString().charAt(acumulax.toString().length-1) == 8){
acumulax=acumulax+2;   
}
if (acumulax.toString().charAt(acumulax.toString().length-1) == 9){
acumulax=acumulax+1;    
}
}
}}
$('#otro_monto1').val(acumulax);

}

                if ($('#otro_monto2').val() != "" && $('#otro_monto1').val() != "")
                {
 $('#otro_monto3').val((parseInt($('#otro_monto2').val())-parseInt($('#otro_monto1').val())).toString()); 
                }
$("#pagando_div").css('display','block');
            }else{    
        $('#otro_monto3').val("");
        $('#otro_monto1').val("");
        $('#otro_monto3').val("");
         alert("Debe ingresar valores numéricos en ambas casillas");
                    //return "";
                }
               // return Numer;
            });
           
           function Limpiar_Vuelto(e) { 
            $('#otro_monto3').val("");
            if ($("#tipo_pago").val() == "VALE VISTA" || $("#tipo_pago").val() == "CHEQUE" || $("#tipo_pago").val() == "TRANSFERENCIA"){
            $("#pagando_div").css('display','block');
        }else{
  $("#pagando_div").css('display','none');
        }
            }
        
//FIN DE VALIDAR INGRESO DE SOLO NUMERO

		$(document).ready(function() {

      

          $.material.init();


//PARA LOS TABS DE CAJA
  $( "#tabs" ).tabs();
//FIN DE LOS TABS DE CAJA



  //CALCULO DE LAS CUOTAS EN LOS PAGOS------------------------------------------------        
        var cad="";
            var saldo="";
            var cont = 0; 
            var hasta =$("#total_cuotas").val();
            var acumula=0; 

$('#tablita').find("tr").remove();

var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}

for (var x=0; x <= hasta ; x++) {
  if ($("input:checkbox[name ='"+x+"']:checked").val()){
      cont = cont + 1;
      cad = "saldo" + x; 
      saldo = $("#"+ cad +"").val();
      acumula = acumula + parseInt(saldo);





$("#tablita").append('<tr style="text-align: center;" ><td>Cuota '+x+'</td><td>'+formatNumber.new(saldo, "$ ")+'</td></tr>');
  }
}


$("#tablita").append('<tr style="text-align: center;" ><td>----------</td><td>----------</td></tr>');
$("#tablita").append('<tr style="text-align: center; background-color:#1DC9F3;"><td><strong>Total a Pagar:</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');

if (acumula.toString() == "0") {
    $("#tablita").append('<tr style="text-align: center; background-color:yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}else{


if (acumula.toString().charAt(acumula.toString().length-1) == 0)
{
      $("#tablita").append('<tr style="text-align: center; background-color:yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}else{
if (acumula.toString().charAt(acumula.toString().length-1) == 1 || acumula.toString().charAt(acumula.toString().length-1) == 2 || acumula.toString().charAt(acumula.toString().length-1) == 3 || acumula.toString().charAt(acumula.toString().length-1) == 4 || acumula.toString().charAt(acumula.toString().length-1) == 5)
{

    
acumula=acumula.toString().substr(0,acumula.toString().length-1).concat("0");

      $("#tablita").append('<tr style="text-align: center; background-color: yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}
else{
if (acumula.toString().charAt(acumula.toString().length-1) == 6){
acumula=acumula+4;
}
if (acumula.toString().charAt(acumula.toString().length-1) == 7){
acumula=acumula+3;  
}
if (acumula.toString().charAt(acumula.toString().length-1) == 8){
acumula=acumula+2;   
}
if (acumula.toString().charAt(acumula.toString().length-1) == 9){
acumula=acumula+1;    
}

      $("#tablita").append('<tr style="text-align: center; background-color: yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}

}}
//$("#acumula2").val(acumula);

//if ($("#tipo_pago").val() == "VALE VISTA" || $("#tipo_pago").val() == "CHEQUE"){
  //      $("#otro_monto1").val($("#acumula2").val());
    //}

    
  //FIN CALCULO DE LAS CUOTAS EN LOS PAGOS---------------------------------------------------------------   


        $('.datepicker').pickadate({
            selectYears: true,
            selectMonths: true,
            // Strings and translations
monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
// Buttons
today: 'Hoy',
clear: 'Limpiar',
close: 'Cerrar',

// Accessibility labels
labelMonthNext: 'Siguiente Mes',
labelMonthPrev: 'Mes anterior',
labelMonthSelect: 'Seleccione un Mes',
labelYearSelect: 'Seleccione Año',

// Formats
format: 'dd-mm-yyyy',
formatSubmit: undefined,
hiddenPrefix: undefined,
hiddenSuffix: '_submit',
hiddenName: undefined,

// Editable input
editable: undefined,

// Dropdown selectors
selectYears: undefined,
selectMonths: undefined,

// First day of the week
firstDay: undefined,

// Date limits
min: undefined,
max: undefined,

// Disable dates
disable: undefined,

// Root container
container: undefined,

// Events
onStart: undefined,
onRender: undefined,
onOpen: undefined,
onClose: undefined,
onSet: undefined,
onStop: undefined
            });
          //$('.timepicker').pickatime()
    
        
$(".bs-example-modal-lg").on("show.bs.modal", function (e) {
     $("#titulo").html("<strong>Detalle del Convenio con ID:</strong> "+$(e.relatedTarget).data('id'));
     $("#fecha_convenio").html("<h4>"+$(e.relatedTarget).data('fecha_convenio')+"</h4>");
     $("#rut").html("<h4>"+$(e.relatedTarget).data('rut2')+"</h4>");
     $("#monto_convenio").html("<h4>"+$(e.relatedTarget).data('monto_convenio')+"</h4>");
     $("#monto_cuotas").html("<h4>"+$(e.relatedTarget).data('monto_cuotas')+"</h4>");
     $("#cliente").html("<h4>"+$(e.relatedTarget).data('cliente')+"</h4>");
     $("#monto_deuda").html("<h4>"+$(e.relatedTarget).data('monto_deuda')+"</h4>");
     $("#monto_dcto").html("<h4>"+$(e.relatedTarget).data('monto_dcto')+"</h4>");
     $("#abono_inicial").html("<h4>"+$(e.relatedTarget).data('abono_inicial')+"</h4>");
     $("#total_cuotas").html("<h4>"+$(e.relatedTarget).data('total_cuotas')+"</h4>");
     $("#tipo_ajuste").html("<h4>"+$(e.relatedTarget).data('tipo_ajuste')+"</h4>");
     $("#pagare").html("<h4>"+$(e.relatedTarget).data('pagare')+"</h4>");

     if($(e.relatedTarget).data('fecha_pagare_generado') == null || $(e.relatedTarget).data('fecha_pagare_generado') == "")
        {
            $("#fecha_pagare_generado2").html("<h4>-</h4>");
        }else{
           $("#fecha_pagare_generado2").html("<h4>"+$(e.relatedTarget).data('fecha_pagare_generado')+"</h4>"); 
        }
         if($(e.relatedTarget).data('fecha_pagare_firmado') == null || $(e.relatedTarget).data('fecha_pagare_firmado') == "")
        {
            $("#fecha_pagare_firmado2").html("<h4>-</h4>");
        }else{
           $("#fecha_pagare_firmado2").html("<h4>"+$(e.relatedTarget).data('fecha_pagare_firmado')+"</h4>"); 
        }
            if($(e.relatedTarget).data('fecha_pagare_ingreso') == null || $(e.relatedTarget).data('fecha_pagare_ingreso') == "")
        {
            $("#fecha_pagare_ingreso2").html("<h4>-</h4>");
        }else{
           $("#fecha_pagare_ingreso2").html("<h4>"+$(e.relatedTarget).data('fecha_pagare_ingreso')+"</h4>"); 
        }
if($(e.relatedTarget).data('fecha_entrega_pagare') == null || $(e.relatedTarget).data('fecha_entrega_pagare') == "")
        {
            $("#fecha_entrega_pagare2").html("<h4>-</h4>");
        }else{
           $("#fecha_entrega_pagare2").html("<h4>"+$(e.relatedTarget).data('fecha_entrega_pagare')+"</h4>"); 
        }



var x = document.getElementById("pagare_firmado");
if (x != null){
$("#pagare_firmado").empty();

var option1 = document.createElement("option");
var option2 = document.createElement("option");

if($(e.relatedTarget).data('pagare_firmado') == "SI") {
 option1.text = "SI";
 option2.text = "NO";
x.add(option1, x[0]);
x.add(option2, x[1]);   
}else{
 option1.text = "NO";
 option2.text = "SI";
x.add(option1, x[0]);
x.add(option2, x[1]); 
}
}

     $("#fecha_pagare_firmado").val($(e.relatedTarget).data('fecha_pagare_firmado'));
     $("#fecha_pagare_generado").val($(e.relatedTarget).data('fecha_pagare_generado'));
      $("#fecha_entrega_pagare").val($(e.relatedTarget).data('fecha_entrega_pagare'));
   
     $("#fecha_vigente").html("<h4>"+$(e.relatedTarget).data('fecha_vigente')+"</h4>");
     $("#fecha_cancelado").html("<h4>"+$(e.relatedTarget).data('fecha_cancelado')+"</h4>");
     $("#fecha_primer_vcto").html("<h4>"+$(e.relatedTarget).data('fecha_primer_vcto')+"</h4>");
     $("#fecha_abono").html("<h4>"+$(e.relatedTarget).data('fecha_abono')+"</h4>");
     $("#fecha_roto").html("<h4>"+$(e.relatedTarget).data('fecha_roto')+"</h4>");
     $("#cuoton").html("<h4>"+$(e.relatedTarget).data('cuoton')+"</h4>");
     $("#fecha_actual").html("<h4>"+$(e.relatedTarget).data('fecha_actual')+"</h4>");
     $("#idconvenio").val($(e.relatedTarget).data('id'));
  

     var codigo_usuario_autoriza = $(e.relatedTarget).data('codigo_usuario_autoriza');
     var token = $(e.relatedTarget).data('token');
     var cliente = $(e.relatedTarget).data('cliente');
     var rut = $(e.relatedTarget).data('rut');
     var idcampania = $(e.relatedTarget).data('idcampania');
     var contacto = $(e.relatedTarget).data('contacto');
     var convenio = $(e.relatedTarget).data('convenio');
     var idconvenio = $(e.relatedTarget).data('idconvenio');
     var obs = $(e.relatedTarget).data('observacion');
     var estado = $(e.relatedTarget).data('estado');
     var ban="0";
     $("#divmotivo").css('display','none');

     if(idconvenio === ''){
        $("#convenio_check_1").prop("checked", false);
        $("#convenio_check_0").prop("checked",true);
        $("#cliente_check_1").prop("checked", false);
        $("#cliente_check_0").prop("checked", true);
        $("#motivo").val("");
        $("input:radio[name ='convenio_check']").attr('disabled',false);
        $("input:radio[name ='cliente_check']").attr('disabled',false);
        $("textarea[name='motivo']").attr('disabled',false);

     }else{
   
        if(convenio == '0')
        {
            $("#convenio_check_0").prop("checked", true);
            $("#convenio_check_1").prop("checked", false);
        }
         if(convenio == '1')
        {  
            $("#convenio_check_1").prop("checked", true);
            $("#convenio_check_0").prop("checked", false);
        }
        if(contacto == '0')
        {
            $("#cliente_check_0").prop("checked", true);
            $("#cliente_check_1").prop("checked", false);
        }
         if(contacto == '1')
        {   
            $("#cliente_check_1").prop("checked", true);
            $("#cliente_check_0").prop("checked", false);
        }

        $("#motivo").val(obs);

        if(estado == 'RECHAZADO')
        {
        $("#divmotivo").css('display','block');
        $("#motivo2").val(obs);
        }


        $("input:radio[name ='convenio_check']").attr('disabled',true);
        $("input:radio[name ='cliente_check']").attr('disabled',true);
        $("textarea[name='motivo']").attr('disabled',true);

     }

     
             $.ajax({
                url: "/DICOM/public/convenios", //dicom.store
                type:'POST',
                data: {_token:token,codigo_usuario_autoriza:codigo_usuario_autoriza,rut:rut,cliente:cliente,idcampania:idcampania,ban:ban},

                 beforeSend: function () {
                        $("#resultado").html("Procesando...");
                        $("#resultado").fadeOut( 5000 );
                },

                success: function(data) {
                     console.log('response'); 
                      console.log('data.nombre'); 
                    if($.isEmptyObject(data.error)){
                         $("#codigo_usuario_autoriza").html("<h4>"+data.success+"</h4>");
                         $("#nombre").html("<h4>"+data.nombre+"</h4>");
                         $("#cuotas_pagadas").html("<h4>"+data.cuotas_pagadas+"</h4>");
                         $("#cuota_actual").html("<h4>"+data.cuota_actual+"</h4>");
                         $("#email").html("<h4>"+data.email+"</h4>");
                         $("#dire").html("<h4>"+data.dire+"</h4>");
                         $("#datosmax").fadeIn(3000).delay(2000).css('display','block');

                    }else{
                        printErrorMsg(data.error);
                    }
                }
     
            });
                

   
    });


//IMPRIMIR ESTADO DE CUENTA
      $("#imprimir_estado").click(function(e){
            e.preventDefault();
            document.getElementById("noprint1").style.display = "none";
            document.getElementById("noprint2").style.display = "none";
            document.getElementById("noprint3").style.display = "none";
            window.print();
            document.getElementById("noprint1").style.display = "inline";
            document.getElementById("noprint2").style.display = "inline";
            document.getElementById("noprint3").style.display = "inline";
    });
    //FIN IMPRIMIR ESTADO DE CUENTA
      $(".btn-submit").click(function(e){
            e.preventDefault();

            var address = $("textarea[name='address']").val();

    });


$("#anular_modal").on("show.bs.modal", function (e) {

    $("#titulo").html("<strong>Anular Comprobante de Pago</strong>");
    $("#descripcion_anular").html("<strong>¿Está seguro de anular el comprobante con Número de Folio: "+$(e.relatedTarget).data('control')+" ?</strong>");
    $("#id_comprobante").val($(e.relatedTarget).data('id'));
    $("#fecha_caja_buscar2").val($(e.relatedTarget).data('fecha_caja_buscar'));

    });



      $("#anular_pago").click(function(e){
           // e.preventDefault();
            var token = $("#_token").val();
            var motivo = $("#motivo_anular").val();
            var fecha_caja_buscar2 = $("#fecha_caja_buscar2").val();
            var id_comprobante = $("#id_comprobante").val();
           

          
                $.ajax({
                url: "/DICOM/public/pagos/"+id_comprobante, //dicom.update
                type:'PUT',
                data: {_token:token,motivo:motivo,id_comprobante:id_comprobante},

                 beforeSend: function () {
                        $("#resultado").html("Procesando...");
                        $("#resultado").fadeOut( 4000 );
                },

                success: function(data) {
                    // console.log('response'); 
                    if($.isEmptyObject(data.error)){
                   // $("#nombre").html("<h4>"+data.nombre+"</h4>");
                       
                        if (data.bano == "1")
                         {
                           // event.preventDefault();
                           alert("Los datos han sido guardados con éxito "+data.nombre);

                           $("#fecha_caja_buscar").val(fecha_caja_buscar2);

                            document.getElementById('form_pago2').submit();
                            

                        }else{
                             alert("Hubo un error,no se pudo realizar la operación"+data.nombre);
                        }
                        $('.bs-example-modal-md').modal('hide')
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
           

    });

//-----------------------------------------------------------convenios.index.blade.php
        $(".confirmar").click(function(e){
           // e.preventDefault();
            var token = $("#_token").val();
            var motivo = $("textarea[name='motivo']").val();
            var convenio_check = $("input:radio[name ='convenio_check']:checked").val();  
            var cliente_check = $("input:radio[name='cliente_check']:checked").val();  
            var idconvenio = $("#idconvenio").val();
            var ban="1";

          
                $.ajax({
                url: "/DICOM/public/convenios", //dicom.store
                type:'POST',
                data: {_token:token,motivo:motivo,convenio_check:convenio_check,cliente_check:cliente_check,idconvenio:idconvenio,ban:ban},

                 beforeSend: function () {
                        $("#resultado").html("Procesando...");
                        $("#resultado").fadeOut( 5000 );
                },

                success: function(data) {
                     console.log('response'); 
                    if($.isEmptyObject(data.error)){

                        if (data.bano == "0")
                         {
                            alert("Los datos han sido guardados con éxito "+data.nombre);
                        }
                        $('.bs-example-modal-lg').modal('hide')
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
           

    });
   $(".confirmar_pagare").click(function(e){
           // e.preventDefault();
            var token = $("#_token").val();
            var fecha_pagare_firmado = $("#fecha_pagare_firmado").val();
            var fecha_pagare_generado = $("#fecha_pagare_generado").val();
             var fecha_entrega_pagare = $("#fecha_entrega_pagare").val();
            var idconvenio = $("#idconvenio").val();
            var ban="2";

          
                $.ajax({
                url: "/DICOM/public/convenios", //dicom.store
                type:'POST',
                data: {_token:token,idconvenio:idconvenio,ban:ban,fecha_pagare_firmado:fecha_pagare_firmado,fecha_pagare_generado:fecha_pagare_generado,fecha_entrega_pagare:fecha_entrega_pagare},

                 beforeSend: function () {
                        $("#resultado").html("Procesando...");
                        $("#resultado").fadeOut( 5000 );
                },

                success: function(data) {
                     console.log('response'); 
                    if($.isEmptyObject(data.error)){

                        if (data.bano == "0")
                         {
                            alert("Los datos han sido guardados con éxito "+data.nombre);
                        }
                        $('.bs-example-modal-lg').modal('hide')
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
           

    });
         function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
            }
//---------------------------------------------------------fin convenios.index.blade.php
  
//ANTES DEL CERRAR LA CAJA PREGUNTO SI ESTA SEGURO
        $("#cerrar_cajax").click(function(e){
          

        var txt;
        var r = confirm("Está seguro de continuar?");
            if (r == true) {
            } else {
             e.preventDefault();
             return false;
            }  

    });
//FIN DE ANTES DEL CERRAR LA CAJA PREGUNTO SI ESTA SEGURO
//ANTES DEL SUBMIT DEL FORMULARIO DE PAGAR
    $('#form_pago').on('submit', function(e){
        e.preventDefault();
  
  if($('#otro_monto1').val().trim() != ""  && $('#tipo_pago').val() != "SELECCIONAR"){
      if(parseInt($('#otro_monto1').val().trim()) <= parseInt($('#sumita').val().trim())+4){
            if($('#tipo_pago').val() == "EFECTIVO"){
                if(parseInt($('#otro_monto3').val()) >= 0){
                    
                                var txt;
                                var r = confirm("Está seguro de continuar?");
                                if (r == true) {
                                this.submit(); //txt = "You pressed OK!";
                                } else {
                                txt = "You pressed Cancel!";
                                }
            }
                else{ alert("El vuelto negativo no es permitido");
                }
            }else{
                var txt;
                var r = confirm("Está seguro de continuar?");
                if (r == true) {
                this.submit(); //txt = "You pressed OK!";
                } else {
                txt = "You pressed Cancel!";
                }
            }//fin del if efectivo

          }else{

        alert("El monto a pagar no puede ser mayor al saldo de la deuda");

            }
        }else{

        alert("Faltan campos por llenar");

            }


    });
//FIN DEL SUBMIT DEL FORMULARIO DE PAGAR
//ANTES DEL SUBMIT DEL FORMULARIO DE FECHA DE ENTRADA PARA VER LA CAJA DEL DIA
    $('#form_pago2').on('submit', function(e){
        e.preventDefault();
  
  if($('#fecha_caja_buscar').val().trim() != ""){
         
            this.submit(); //txt = "You pressed OK!";     
        }else{

        alert("Faltan campos por llenar");

            }
    });
//FIN DEL SUBMIT DEL FORMULARIO DE PAGAR

//CALCULO DE SUMA DE CUOTAS A PAGAR
      $(".accion").click(function(e){

           // var cad = "saldo" + $(this).attr('id'); 
            var cad="";
            var saldo="";
            var cont = 0; 
            var hasta =$("#total_cuotas").val();
            var acumula=0; 

$('#tablita').find("tr").remove();

var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}

for (var x=0; x <= hasta ; x++) {
  if ($("input:checkbox[name ='"+x+"']:checked").val()){
      cont = cont + 1;
      cad = "saldo" + x; 
      saldo = $("#"+ cad +"").val();
      acumula = acumula + parseInt(saldo);





$("#tablita").append('<tr style="text-align: center;" ><td>Cuota '+x+'</td><td>'+formatNumber.new(saldo, "$ ")+'</td></tr>');
  }
}

/*
if ($("input:checkbox[name ='otro_monto2']:checked").val()){
    if($("#otro_monto1").val() != ""){
    $("#tablita").append('<tr style="text-align: center;" ><td>Otro Monto</td><td>'+formatNumber.new($("#otro_monto1").val(), "$ ")+'</td></tr>');
       acumula = acumula + parseInt($("#otro_monto1").val());
}
   
}*/

$("#tablita").append('<tr style="text-align: center;" ><td>----------</td><td>----------</td></tr>');
$("#tablita").append('<tr style="text-align: center; background-color:#1DC9F3;"><td><strong>Total a Pagar:</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');

//window.alert(acumula.toString().length-1); longitud de la variable
//window.alert(acumula.toString().charAt(acumula.toString().length-1)); valor del ultimo digito

if (acumula.toString() == "0") {
    $("#tablita").append('<tr style="text-align: center; background-color:yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}else{


if (acumula.toString().charAt(acumula.toString().length-1) == 0)
{
      $("#tablita").append('<tr style="text-align: center; background-color:yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}else{
if (acumula.toString().charAt(acumula.toString().length-1) == 1 || acumula.toString().charAt(acumula.toString().length-1) == 2 || acumula.toString().charAt(acumula.toString().length-1) == 3 || acumula.toString().charAt(acumula.toString().length-1) == 4 || acumula.toString().charAt(acumula.toString().length-1) == 5)
{

    
acumula=acumula.toString().substr(0,acumula.toString().length-1).concat("0");

      $("#tablita").append('<tr style="text-align: center; background-color: yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}
else{
if (acumula.toString().charAt(acumula.toString().length-1) == 6){
acumula=acumula+4;
}
if (acumula.toString().charAt(acumula.toString().length-1) == 7){
acumula=acumula+3;  
}
if (acumula.toString().charAt(acumula.toString().length-1) == 8){
acumula=acumula+2;   
}
if (acumula.toString().charAt(acumula.toString().length-1) == 9){
acumula=acumula+1;    
}

      $("#tablita").append('<tr style="text-align: center; background-color: yellow;"><td><strong>Total a Pagar (Sólo Efectivo):</strong></td><td><strong>'+formatNumber.new(acumula, "$ ")+'</strong></td></tr>');
}

}}

//$("#acumula2").val(acumula);

//if ($("#tipo_pago").val() == "VALE VISTA" || $("#tipo_pago").val() == "CHEQUE"){
   //     $("#otro_monto1").val($("#acumula2").val());
    //}
            });
           


});


    </script>
</body>
</html>