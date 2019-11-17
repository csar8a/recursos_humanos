function BuscarPersona() {
    
    var dni = $('#dni').val();
    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();

    if (dni.length == 0  ) 
    {
        alert('Debe colocar DNI Correcto'); return; 
    }

    $.ajax({
        url: 'pide/C_consulta_policial/buscarPersona',
        data: {
            dni
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
            alert('DNI incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}
