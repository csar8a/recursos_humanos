function BuscarAntecedentesPenales() {
    
    var dni = $('#dni').val();
    var name = $('#name').val();
    var ap = $('#ap').val();
    var am = $('#am').val();
    var motivo = $('#motivo').val();
    var segname = $('#segname').val();
    var tername = $('#tername').val();
    
    if(validaciones(dni,name,ap,am,motivo)) {
        $("#btnBuscar").prop('disabled', true);
        $("#searching").show();
    } else {
        return;
    }

    $.ajax({
        url: 'pide/C_consulta_antecedentes_penales/buscarAntecedentesPenales',
        data: {
            dni,name,ap,am,motivo,segname, tername
        },
        type: 'POST'
    }).done(function (response) {

        console.log(response);
        
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

function validaciones(dni,name,ap,am,motivo) {
    if (dni.length == 0 ) {alert('Debe colocar dni'); return;}
    if (name.length == 0 ) {alert('Debe colocar nombre'); return;}
    if (ap.length == 0 ) {alert('Debe colocar apellido paterno'); return;}
    if (am.length == 0 ) {alert('Debe colocar apellido materno'); return;}
    if (motivo.length == 0 ) {alert('Debe colocar motivo de consulta'); return;}

    return true;
}