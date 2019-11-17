function BuscarPersona() {
    
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
        url: 'pide/C_consulta_antecedentes_judiciales/buscarPersona',
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