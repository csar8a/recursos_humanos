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
        
        $('#codigoID').html(ficha.codigo);
        $('#fechainscrip').html(ficha.txtfechainscripcion);
        $('#responsableID').html(ficha.responsable);
        $('#emergenciaID').html(ficha.emergencia);


        $('#documentoID').html(ficha_joven.tipodocumento+' - '+ficha_joven.txtdocumento);
        $('#fechanacjov-container').html(ficha_joven.txtfechanacimiento);
        $('#edadID').html(getAge2(new Date(getFormatted(ficha_joven.txtfechanacimiento))));
        $('#sexoJovenID').html(ficha_joven.txtsexo);
        $('#nombresID').html(ficha_joven.txtnompersona+' '+ficha_joven.txtapepaterno+' '+ficha_joven.txtapematerno);
        $('#telefonoID').html(ficha_joven.txttelefono);
        $('#celularID').html(ficha_joven.txtcelular);
        $('#correoID').html(ficha_joven.txtcorreo);
        $('#estadoCivilJovenID').html(ficha_joven.txtestadocivil);
        $('#gradoInstruccionID').html(ficha_joven.txtgrado);
        $('#ocupacionID').html(ficha_joven.txtocupacion);
        $('#centroEstudioID').html(ficha_joven.txtcentro);
        (ficha_joven.txtimg != null) ? $('#img_joven').attr("src",URL_SERVER+"modulos/casajuventud/"+ficha_joven.txtimg) : $('#img_joven').attr("src", base_url+"public/casa_juventud/img/foto.png");
        

        $('#distritoID').html(ficha_joven.distrito);
        $('#viaID').html(ficha_joven.txtviapublica);
        $('#urbanizacionID').html(ficha_joven.txturbanizacion);
        $('#numeroID').html(ficha_joven.txtnumero);
        $('#interiorID').html(ficha_joven.txtinterior);
        $('#manzanaID').html(ficha_joven.txtmanzana);
        $('#loteID').html(ficha_joven.txtlote);


	if(ficha_apoderado != null) {

        $('#documentoApoderadoID').html(ficha_apoderado.tipodocumento+' - '+ficha_apoderado.txtdocumento);
        $('#fechaNacApoderado-container').html(ficha_apoderado.txtfechanacimiento);
        $('#edadApoderadoID').html(getAge2(new Date(getFormatted(ficha_apoderado.txtfechanacimiento))));
        $('#sexoApoderadoID').html(ficha_apoderado.txtsexo);
        $('#nombresApoderadoID').html(ficha_apoderado.txtnompersona+' '+ficha_apoderado.txtapepaterno+' '+ficha_apoderado.txtapematerno);
        $('#telefonoApoderadoID').html(ficha_apoderado.txttelefono);
        $('#celularApoderadoID').html(ficha_apoderado.txtcelular);
        $('#correoApoderadoID').html(ficha_apoderado.txtcorreo);
        $('#estadoCivilID').html(ficha_apoderado.txtestadocivil);
        $('#gradoApoderadoID').html(ficha_apoderado.txtgrado);
        $('#ocupacionApoderadoID').html(ficha_apoderado.txtocupacion);
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