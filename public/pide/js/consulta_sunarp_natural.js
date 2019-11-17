function BuscarSunarp() {
    
    var nombre = $('#nombre').val();
    var paterno = $('#paterno').val();
    var materno = $('#materno').val();

    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();
    

    if (nombre.length == 0  ) 
    {
        alert('Debe colocar Nombre'); return; 
    }
    if (paterno.length == 0  ) 
    {
        alert('Debe colocar Apellido Paterno'); return; 
    }
    if (materno.length == 0  ) 
    {
        alert('Debe colocar Apellido Materno'); return; 
    }

    

    $.ajax({
        url: 'pide/C_consulta_sunarp_natural/buscarSUNARP',
        data: {
            nombre,
            paterno,
            materno
        },
        type: 'POST'
    }).done(function (response) {
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_consulta").html(data.html);
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_consulta").html(null);
            alert('Incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}


function BuscarAsientos(partida,registro,oficina) {


    if(registro=='REGISTRO DE PROPIEDAD INMUEBLE'){
        var numregistro ="21000";
    }
    else if(registro=='PERSONA JURIDICA'){
        var numregistro ="22000";
       // $(e.currentTarget).find('input[name="bookId2"]').val("22000");
    }
    else if(registro=='PERSONA NATURAL'){
        var numregistro ="23000";
        //$(e.currentTarget).find('input[name="bookId2"]').val("23000");
    }else{
        var numregistro ="00000";
        //$(e.currentTarget).find('input[name="bookId2"]').val("00000"); 
    }

    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();
    


    $.ajax({
        url: 'pide/C_consulta_sunarp_natural/buscarAsientos',
        data: {
            partida,
            numregistro,
            oficina
        },
        type: 'POST'
    }).done(function (response) {
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_asientos").html(data.html);
            
            
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_asientos").html(null);
            alert('Razon Social incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}



function VerAsiento() {
    var tipo = $('#selectTipo').val();
    


    var $value = $('#selectRef').val();
    var $exploded_value = $value.split('|');
    var transaccion = $exploded_value[0];
    var totalpag = $exploded_value[1];
    var ref = $exploded_value[2];
    var numpag = $exploded_value[3];
    var idimg = $exploded_value[4];


    /*
    console.log(tipo);
    console.log(transaccion);
    console.log(totalpag);
    console.log(ref);
    console.log(numpag);
    console.log(idimg);*/




    
    $("#btnBuscar").prop('disabled', true);
    $("#searching2").show();
    


    $.ajax({
        url: 'pide/C_consulta_sunarp_natural/VerAsiento',
        data: {
            idimg,
            numpag,
            tipo,
            ref,
            transaccion,
            totalpag
        },
        type: 'POST'
    }).done(function (response) {
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching2").hide();
            $("#codigo_foto").html(data.html1);
            $("#body_foto").html(data.html);
            
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching2").hide();
            $("#codigo_foto").html(null);
            $("#body_foto").html(null);
            
        }
    }).fail(function () {
        alert("error");
    });
}

function getReferencia(){
    var tipo = $('#selectTipo').val();
    $('.FOLIO').hide();
    $('.FICHA').hide();
    $('.ASIENTO').hide();
    if(tipo.length != 0){
        $('.'+tipo).show();
        $('#selectRef').val(null);
    }
}



function limpiar(){
   document.getElementById("body_foto").innerHTML="";
   document.getElementById("codigo_foto").innerHTML="";
}