function insertarReclamo() {
    /* INFORMACION DEL VECINO */
    var paterno = $('#paternoID').val();
    var materno = $('#maternoID').val();
    var nombres = $('#nombresID').val();
    var tipo_doc = $('#selectTipoDoc').val();
    var doc = $('#documentoID').val();
    var telefono = $('#telefonoID').val();
    var correo = $('#correoID').val();

    if (tipo_doc.length == 0) { alert('Debes seleccionar un tipo de documento'); return; }
    if (doc.length == 0) { alert('No debe dejar vacío el campo de documento'); return; }
    if (tipo_doc == 1 && doc.length != 8) { alert('Para DNI debe ingresar 8 digitos'); return; }
    if (tipo_doc == 2 && doc.length != 11) { alert('Para RUC debe ingresar 11 digitos'); return; }
    if (nombres.length == 0) { alert('No debe dejar vacío el campo de nombres'); return; }
    if (paterno.length == 0) { alert('No debe dejar vacío el campo de apellido paterno'); return; }
    if (materno.length == 0) { alert('No debe dejar vacío el campo de apellido materno'); return; }
    if (telefono.length == 0) { alert('No debe dejar vacío el campo de teléfono'); return; }

    /* INFORMACION DEL VECINO-DOMICILIO */
    var distrito = $('#selectDistrito').val();
    var viaPublica = $('#viaID').val();
    var urbanizacion = $('#urbanizacionID').val();
    var numero = $('#numeroID').val();
    var interior = $('#interiorID').val();
    var manzana = $('#manzanaID').val();
    var lote = $('#loteID').val();
    
    if (distrito.length == 0) { alert('Debes seleccionar un distrito'); return; }
    if (viaPublica.length == 0) { alert('No debe dejar vacío el campo de vía pública'); return; }

    /* DATOS DEL SERVICIO */
    var categoria = $('#selectCategoria').val();
    var subcategoria = $('#selectSubCategoria').val();
    var medio = $('#selectMedio').val();
    var tema = $('#temaID').val();
    var desc = $('#descID').val();

    if (categoria.length == 0) { alert('Debes seleccionar una categoría'); return; }
    if (subcategoria.length == 0) { alert('Debes especificar una subcategoría'); return; }
    if (medio.length == 0) { alert('Debes especificar una medio'); return; }
    if (tema.length == 0) { alert('Debes especificar un tema'); return; }
    if (desc.length == 0) { alert('Llena la descripcción del servicio'); return; }

    $.ajax({
        url: 'sav/C_sav/insertarServicio',
        type: 'POST',
        data: {
            nombres,paterno,materno,
            tipo_doc,
            doc,
            telefono,
            correo,
            distrito,
            viaPublica,
            urbanizacion,
            numero,
            interior,
            manzana,
            lote,
            categoria, subcategoria, medio, tema, desc
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se insertó el reclamo correctamente');
            location.reload();
        }
    }).fail(function () {
        alert("error");
    });
}

function getSubcategoria() {
    var categoria = $('#selectCategoria').val();
    if (categoria.length != 0) {
        $.ajax({
            url: 'sav/C_sav/getSubcategorias',
            type: 'POST',
            data: {
                categoria
            }
        }).done(function (response) {
            let data = JSON.parse(response);
            $("#selectSubCategoria").html('<option value="">Seleccione una sub-categoría</option>' + data.html);
        }).fail(function () {
            $("#selectSubCategoria").html('<option value="">Seleccione una sub-categoría</option>');
        });

    } else {
        $("#selectSubCategoria").html('<option value="">Seleccione una sub-categoría</option>');
    }
}