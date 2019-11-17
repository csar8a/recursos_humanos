function mostrarFichaCompleta()
{
  var id_ficha = $('#id_ficha').val();

  if(id_ficha == '') {
    window.open(base_url + "admin_casa_juventud", "_self");
  }


  $.ajax({
    url: '../../../casa_juventud/C_admin_c_juventud/getAllData',
    data: {
        id_ficha
    },
    type: 'POST'
}).done(function (response) {
    let data = JSON.parse(response);
    if (data.error == 0) {
        var ficha = data.result[0];
        var ficha_joven = JSON.parse(ficha.joven);
        var ficha_apoderado = JSON.parse(ficha.apoderado);
        


        
        $('#codigoID').val(ficha.codigo);
        $('#fechainscrip').val(ficha.txtfechainscripcion);
        $('#responsableID').val(ficha.responsable);
        $('#emergenciaID').val(ficha.emergencia);


        $('#documentoID').val(ficha_joven.txtdocumento);
        $('#selectTipoDoc').val(ficha_joven.tipodocumento);
        $('#FechaNacimientoID').val(ficha_joven.txtfechanacimiento);
        $('#edadID').html(getAge2(new Date(getFormatted(ficha_joven.txtfechanacimiento))));
        $('#SexoID').val(ficha_joven.txtsexo);
        $('#paternoID').val(ficha_joven.txtapepaterno);
        $('#maternoID').val(ficha_joven.txtapematerno);
        $('#nombresID').val(ficha_joven.txtnompersona);
        $('#telefonoID').val(ficha_joven.txttelefono);
        $('#celularID').val(ficha_joven.txtcelular);
        $('#correoID').val(ficha_joven.txtcorreo);
        var _estadoCivil = ficha_joven.txtestadocivil;
        console.log($('#selectEstadoCivil > option').length);
        // for(var i = 0; i < $('#selectEstadoCivil').length; i++) {

        // }

        $('#selectEstadoCivil').val(ficha_joven.txtestadocivil);
        $('#gradoInstruccionID').val(ficha_joven.txtgrado);
        $('#ocupacionID').val(ficha_joven.txtocupacion);
        $('#centroEstudioID').val(ficha_joven.txtcentro);
        (ficha_joven.txtimg != null) ? $('#img_joven').attr("src",URL_SERVER+"modulos/casajuventud/"+ficha_joven.txtimg) : $('#img_joven').attr("src", base_url+"public/casa_juventud/img/foto.png");
        

        $('#selectDistrito').val(ficha_joven.distrito);
        $('#viaID').val(ficha_joven.txtviapublica);
        $('#urbanizacionID').val(ficha_joven.txturbanizacion);
        $('#numeroID').val(ficha_joven.txtnumero);
        $('#interiorID').val(ficha_joven.txtinterior);
        $('#manzanaID').val(ficha_joven.txtmanzana);
        $('#loteID').val(ficha_joven.txtlote);

       
	if(ficha_apoderado != null) {

        $('#selectTipoDocApoderado').val(ficha_apoderado.tipodocumento);
        if($('#documentoApoderadoID').val(ficha_apoderado.txtdocumento).length==0){
            $("#btnBuscarA").show();
        } else {
            $("#btnBuscarA").hide();
            var campo = document.getElementById('documentoApoderadoID');
            campo.readOnly = true;     
        }
        $('#FechaNacimientoAID').val(ficha_apoderado.txtfechanacimiento);
        $('#edadApoderadoID').html(getAge2(new Date(getFormatted(ficha_apoderado.txtfechanacimiento))));
        $('#sexoApoderado').val(ficha_apoderado.txtsexo);
        $('#paternoApoderadoID').val(ficha_apoderado.txtapepaterno);
        $('#maternoApoderadoID').val(ficha_apoderado.txtapematerno);
        $('#nombresApoderadoID').val(ficha_apoderado.txtnompersona);
        $('#telefonoApoderadoID').val(ficha_apoderado.txttelefono);
        $('#celularApoderadoID').val(ficha_apoderado.txtcelular);
        $('#correoApoderadoID').val(ficha_apoderado.txtcorreo);
        $('#selectEstadoCivilApoderado').val(ficha_apoderado.txtestadocivil);
        $('#gradoApoderadoID').val(ficha_apoderado.txtgrado);
        $('#ocupacionApoderadoID').val(ficha_apoderado.txtocupacion);
	}
    }
}).fail(function () {
    alert("error");
});

}

function getAge2(dateString) {
    var diff_ms = Date.now() - dateString.getTime();
    var age_dt = new Date(diff_ms);

    return Math.abs(age_dt.getUTCFullYear() - 1970);
}

function getFormatted(dateString)
{
    var fecha = dateString.split('/');
    var mes = fecha[1];
    var dia = fecha[0];
    var year = fecha[2];


    return mes + "/" + dia + "/" + year;
}