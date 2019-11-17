    //validacion tipo de documento y numero

    function validateTipoDoc(){
        var tipo = $('#selectTipoDoc').val();
        $('.doc>.invalid-feedback').remove();
        $('#documentoID').remove();
        $('#documentoLb').after('<input class="form-control" id="documentoID" name="documento" onkeydown="limpiarDatosPersona()" aria-describedby="nombreHelp" placeholder="Ingrese número de documento"></input>');
        bootstrapValidate(
            '#documentoID',
            'required:Complete este campo');
        if(tipo == 3){
            bootstrapValidate(
                '#documentoID', 
                'max:8:No ingrese más de 8 dígitos');
            bootstrapValidate(
                '#documentoID', 
                'min:8:Ingrese 8 dígitos');
            bootstrapValidate(
                '#documentoID',
                'numeric:Ingrese solo números');
        } else if(tipo == 4) {
            bootstrapValidate(
                '#documentoID', 
                'max:11:No ingrese más de 11 dígitos');
            bootstrapValidate(
                '#documentoID', 
                'min:11:Ingrese los 11 dígitos');
            bootstrapValidate(
                '#documentoID',
                'numeric:Ingrese solo números');
        } else if(tipo == 5) {
            bootstrapValidate(
                '#documentoID', 
                'max:12:No ingrese más de 12 caracteres');
            bootstrapValidate(
                '#documentoID', 
                'alphanum:Ingrese solo valores alfanuméricos');
        } else if(tipo == 6) {
            bootstrapValidate(
                '#documentoID', 
                'max:12:No ingrese más de 12 caracteres');
            bootstrapValidate(
                '#documentoID', 
                'alphanum:Ingrese solo valores alfanuméricos');
        } 
    }
    /*
    bootstrapValidate(['#prename', '#lastname'], 'max:20:Enter no more than 20 characters!');
    */

    bootstrapValidate(
        '#selectTipoDoc',
        'required:Seleccione un tipo de documento');

    bootstrapValidate(
        '#documentoID',
        'required:Complete este campo');
    //validacion ap paterno
    bootstrapValidate(
        '#paternoID',
        'alpha:Solo ingrese caracteres alfabéticos');
    bootstrapValidate(
        '#paternoID',
        'required:Complete este campo');
    //validacion ap materno
    bootstrapValidate(
        '#maternoID',
        'alpha:Solo ingrese caracteres alfabéticos');
    bootstrapValidate(
        '#maternoID',
        'required:Complete este campo');
    //validacion nombres
    bootstrapValidate(
        '#nombresID',
        'alpha:Solo ingrese caracteres alfabéticos');
    bootstrapValidate(
        '#nombresID',
        'required:Complete este campo');
    //validacion telefono
    bootstrapValidate(
        '#telefonoID',
        'numeric:Ingrese solo números');
    bootstrapValidate(
        '#telefonoID',
        'required:Complete este campo');

    //validacion correo electronico
    bootstrapValidate(
        '#correoID',
        'email:Ingrese una dirección de correo válido');
    bootstrapValidate(
        '#correoID',
        'required:Complete este campo');

    //validacion via publica
    bootstrapValidate(
        '#viaID',
        'required:Complete este campo');
    bootstrapValidate(
        '#viaID',
        'alphanum:Ingrese solo valores alfanuméricos');

    //validacion urbanizacion
    bootstrapValidate(
        '#urbanizacionID',
        'alphanum:Ingrese valores alfanuméricos');

    //validacion numero
    bootstrapValidate(
        '#numeroID',
        'numeric:Ingrese solo números');

    //validacion interior
    bootstrapValidate(
        '#interiorID',
        'alphanum:Ingrese valores alfanuméricos');

    //validacion manzana
    bootstrapValidate(
        '#manzanaID',
        'alphanum:Ingrese valores alfanuméricos');

    //validacion lote
    bootstrapValidate(
        '#loteID',
        'alphanum:Ingrese valores alfanuméricos');

    //validacion asunto
    bootstrapValidate(
        '#asuntoID', 
        'max:20:Solo debe ser un mensaje corto, no más de 20 letras');
    bootstrapValidate(
        '#asuntoID',
        'required:Complete este campo');

    //validacion mensaje
    bootstrapValidate(
        '#mensajeID',
        'required:Complete este campo');
    
    //validacion reclamo
    bootstrapValidate(
        '#reclamoID',
        'required:Complete este campo');

    //validacion combo sede
    function validateSede(){
        bootstrapValidate(
            '#selectSede',
            'required:Seleccione una sede');
    }

    //validacion combo distrito
    function validateDistrito(){
        bootstrapValidate(
            '#selectDistrito',
            'required:Seleccione un distrito');
    }

