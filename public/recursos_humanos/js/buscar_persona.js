function AbrirModalPersona() {
    $('#modal_persona').modal('show');
    
}


function BuscarVacaciones() {
    var codigo  = $('#codigo').val().trim();
    $.ajax({
        url: 'recursos_humanos/C_Datos_Personales/BuscarVacaciones',
        data: {
            codigo,
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_vacaciones").html(data.html);
        } else {
            $("#body_vacaciones").html(null);
        }
    }).fail(function () {
        alert("error");
    });
}

function BuscarPersona() {
    var nombre  = $('#nombrebus').val().trim();
    if (nombre.length == 0) { alert('Debe escribir un nombre'); return; }
    if (nombre.length < 3) { alert('Debe escribir más de 2 letras'); return; }
    $.ajax({
        url: 'recursos_humanos/C_Datos_Personales/buscarPersona',
        data: {
            nombre
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);   
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#body_personas").html(data.html);

        }
    }).fail(function () {
        alert("error");
    });
}

function EnviarDatos(nombrecompleto,codigo,dni,cargo,nac,ingreso,salida) {
    document.getElementById("nombretotal").value = nombrecompleto;
    document.getElementById("codigo").value = codigo;
    document.getElementById("dni").value = dni;
    document.getElementById("cargo").value = cargo;
    document.getElementById("fecha_nac").value = nac;
    document.getElementById("ingreso").value = ingreso;
    document.getElementById("cese").value = salida;
    
    $('#modal_persona').modal('hide');
}
