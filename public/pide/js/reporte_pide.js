var table = '<table class="display nowrap" id="example" style="width:100%;"><thead><tr><th>Reporte</th><th>N° Consultas</th></tr></thead><tbody id="body_reporte"></tbody><tfoot><tr><th>Municipalidad de Bellavista</th><th>2019</th></tr></tfoot></table>';

function cargarReporte() {
    
    var fecha1      = $('#fecha1-container input').val();
    var fecha2      = $('#fecha2-container input').val();
    var table2 ="<p style='color:#063f5d'> Fecha Busqueda: "+fecha1+"     hasta: "+fecha2+"</p>";

    if (fecha1.length == 0) {
        alert('Debes elegir una fecha inicio');
        return; 
    }
    if (fecha2.length == 0) {
        alert('Debes elegir una fecha fin');
        return; 
    }
        
    $.ajax({
        url: 'pide/C_reporte_pide/cargarReporte',
        data: {
            fecha1,fecha2
        },
        type: 'POST'
    }).done(function (response) {
        $("#div_table").html(null);
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#div_table").html(table);
            $("#descfecha").html(table2);
            $("#body_reporte").html(data.html);
           
            $('#example').DataTable( {
                searching: false,
                info: false,
                "bLengthChange": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ documentos por p&aacute;gina",
                    "zeroRecords": "No hay documentos para mostrar",
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        messageTop: 'Consulta del: '+fecha1+'  hasta :'+fecha2
                    },
                    {
                        extend: 'pdfHtml5',
                        messageTop: 'Consulta del: '+fecha1+'  hasta: '+fecha2,
                        customize: function ( doc ) {
                            doc.content.splice( 1, 0, {
                                margin: [ 0, 0, 0, 12 ],
                                alignment: 'center',
                                image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH4AAAAyCAYAAACauW+fAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAGutJREFUeNrte3l4VEXW9+9U3Xs73VlYEiBh37cEFGEE4simIogbqGziviAorqPjzKjvfIPjOjri6KsiioIjmwsoIggCDouADAMa1shOIIHsW3ffe6vO90cnIQndSYPM+M0n53nu0/fWPXX2OnWq6jYBIJyDXxyIn1uAc/DzwDnH/0LhnON/oXBWHJ+W1gCvvNiDAKBk7dAGAPCbwS3P1Q7/DwPhLBR3q766WKQlels5mgNurusr+GdpeZwhvB0e33jg51bwHISHn+T4E4dHSFmokopygnG5m0s1G9C+9l6DNCxd6BZTlk0+Q3L7P2zM+rkV/Q8A479ohfSTUr0I6oQjm4p11qoiu/RQkAr2+As4TuSJVmaubGMZops39kSJ7V85+Tzj51b0PwD/NU4HQo7ninuudl8dONylC65JKNxeHh8scuL9xxzV7r7kHl0fbrE5voXniDdGzjYbSctoYfmNZMvbrKWn5foHzpORaEXgG44/6pERUdCO5n0kvnXZKBpZo5UxnD8i3Udroxp4Bk5GKtVCCNdeBdlFtl+Bk4KH7Zjkaxp4/IcC86BhaWYIYCgrvG+29wzztbJaBf9VXpg+bZvCmY0Kque5dlt9PCrfcz20ouEbTZ9wtozGDpH8EU6HaGWtaq+e6rkWQqRoBQAkCZG847t8Q5f7SR8vHxo8VGYFDpWh7EApAofLEcwq7edmFiRlu2WeuGQhj/25XyOEj8r6ohT1vK9rZERr2Gh5nS5ebYfVlQHOVNYzkq8y1UeT3qj6s2gojm0ra9j02IjpzxWYl/X+cVcZcjJzUJ4yCfmZR/FjZpBLUt4YtS3/oac2by00Uv6wIR81IzXSb7TyhHP46fSrjyZHcVE976PVKVp+pytnnbrTT7m+XL56PDM7zMwBzczMHKz4Zebct96Z1eun8qh+xYx8fGoUeD9Zr594/cf5d521x5P6cc601I9z1vX4rHByffi1q22uJjTCvDulffhlg+a88MqrO0aNHPWQL8bTM6Vp0nn7ftz7tQZ9/7fXXnv5zVf/mlUHvUi8wvFjAMSu26UOvEhz3tmGSPVB1PZr88QcEXf+4NbQOgUCATDt2X5DSlm755YKX+cLZkOr1IiJmgCSZqb2l47bMb6tCwAixne3W5x3P7QGWZ7+aYsKvsu4ptHmSPIZtYSqnrpQ7TmsEjd1bNQw4A+MWvXU/QmfPHj/7L9t+/6+lKZJPfbs2b3+L1eOWJPQEGNGt/TlWzGeTz74saAENdNjNMasjc8grt1ee/oI54C6aCNMf6rjmaJ4X4NH6sK8LlBqgCoven/XTZ2CqR/nDNP+sr+qssKu4IpuQpR0m535v6q8dKoqKegLzW0ZGmANMIdqMSYNKUBCQlgxjWB6LABOh2n/kDpQPpkdG2Btg7Wl/SVTANxSS88qOcONjtpODzt6bmzfsF+5PzC/WcduLdtd0B+5Rw5Ce2Nx0WXDsXjWO9wsKZEaNWuOPd+tRd6BzP2xvpjrP9hbuKUOutE4C56rHpkX/PylMRGcH8mxtQMtGp3Djl6zSQs4J7KqaPf80n+9tv2DtL/kwR1j27iVeKmf5sZBq1d0sHwWO/YjrNyriMQoJmQQ6HuAJRnGsyBjA7Rqw679NGudSIZ8QvnLXjRiG8WyCoKVPo+VuwoASBpDSYrNZHkBorKd49raACh1/tHL3NL8Zey6DpifJCGeIysmIOMT220flZQTxhYUbmMl7Aga9FB6wvFDhWXd1x2wSNLLccmtbxv30FOeNh06IJh3iKH92vZDfDN/Jt314P0wTK1g+uTw2+7B3h072n3xyp/WjrXVdIAem3u42Bn4wEXmN9PWOXU4I5zzudpTfUujSEu8cJU1pX1elOjfn1Gw9/6LdAQ7UNrnBc+ybV8Pyztp+1UJKwBAlRWNUv6SsdIbvxzAoiqqyh2jSgtuZ8fOYrAPzGBmH4gGg0QMWZ5lOyd0+mMlerfZmTlwnY+F6U3bdUs3B0AhAO42e2+xDpYCDIgYb8nOGzsU1lZUK/teMIOkuUyVF78mYxN+y67TiINldwOYijA2MoCIM0mV8n1u7GUox30oprHn++se+T/tOXjkzp6pid+UZrywxHfgwIaU+ODesoAqm+90mtw08cTYH068NO/a8u2vG4aMyyvydExxOvS777HxV741f8f9jWOMnX0Tdm8k4nGJ7Ro9nre/gCPwjTQqa9/XlfJPoZv6aW5jMq20jCsT1lTipi7MbaRLCw95W3Z+BMAb4QyVujC3vVuY+wg7thAe37PJt05dkf3ekwyt5kC5Y9kJTgCwsEpA174RzMzSmEus01mpkABER0AEVmpIl1mZf5LS+MjOzdp+5NUpC1vcN20gDGtnDT0sCwhSSCLDOkX31E9z26ri3CsAQJjWzN1T+pd1m505Rwf9k7UdmNh9zsHnd4xrE6wd/AZQZyHEACg+yZsaCDhjXVeN/XWr7L9lbv/ngLSRazdUF+KePw8d0bOH8Rz1TIbHFOd/WDRo24MjFy8DkA0cXztlktN02JgOA7cv2T7YdcU4R7sNzxvZffHKl9etrc0vnAyIfgSfNMqigothB/qFRpsGlFuiivM8ZJhPd35rS4M9Ey/QAJiDwVhtB7xkWElhAokAgP3lE9kOaij3L0yBxxNH3JGe/d6T692ywqUkzSztBK/oPj+r8Y7RLQq6f5zTSpcXX0yGtW7PTR13dp2VCbAfIIHAgR+WeTv2ms3KvQmu/YRWzhMyoXFe80kvrWRWM49/MDWvJn8CiCpa6JRA50DZ3ew4BsA5TlHOEgCkmd8F82R27ebw+K4H8GFt21Vfx0deBxK3heZ4pdnJhc+JTbv3vf8Z3HvwhKQOHgCY8sLlHbp2Mv8eYwoiEJmSiFy8MP6BXxMASu3QISmlaWzr/DwJZjTUDB9rbsGMlmH5nf5aGD2/9E9J/fj4otT5WZ91n3dkercP9jVTBccfdUvyrnSLcrVbnK9VWaHWwXJD2wFJHm/VPH6yiNIIxyP1o2yvdgK3AryUSbwEgp9dZwoA3n1bqi0Maxa08rJrjwoFUvlYuEqSYc4AwGSaAEJF2cGp41Te4hm3kGENEB7f62R5M0iIRlDqBrh6SdPxv5vm7dwLNfTTIXeJCl9Xytd93uEYbQduZ6XAWm+VvgaDu76/axjsYFNmfYy1grYDU1o8+MYpeolqo6n2OrQqQpTDG5l5lSmFOlZ8fIdhZ3dOu6j7F1c9eNfAsRf0FUHbLSkswvSiAv3dse/92LvJn5mXqw/7fJIA4O47Wz7oM9PGbJj1PRod9+cIAak1r1Su3lyLZ6R18MlnrvJ1DZlVWfEwVZS3yi44PlGVFjTW5cWTdLCctONkamXPhXLmqqB/DhgazFBlhUD4bHeKLbRyxrDrNGESM/fc1TMPoEXaCY7qvuBoKwAE05oJIRXb9oRGQ28hduwbYchChvgIAJGQAAGsHHR554eWja+841a38MTGnTe2m7LzxnY9yeNrTobxGlhBB8vvbf/s0tbhZau578KgG9i1m4IAEuJygJawUktAWEJCpAAAu/aFDS+6tm9tO0Y6NavBVGsOGIboK4KC/rhxc2DljW0Lj+/NbVDKBdPGXXPBP0p+WPb2hCf2/faqbsmxzZMS8gxTXPf6yl0Zlf3Xrzvx1fl9m/6+aaykXA8fBFNvQ1I6Af4IPCPvPZ9Md7VsosHsjiRwGrvOr1jr50mK3sKwRggrviekAek6q7UdPAYiwHVP0q64Zz511mg24QkBJzgJrCGEfKrrrD2/g3KbsatMOPY9AJ7YcUPzH7t9uP8bHSgb2HT0I1excntIK+6NHeNalYc4hBIrKxck5BNw1UQzMaUBgGkAsHNs6+Nd3t72FAOToJRkrRIBHA7pyVS1sV5NvIaDRgNOcDKYQaa5T1jeT8iwiIjAzMyuTdoOTA5louAUABur61VfcRdCMqXWCieIhOfCopL3vl3+dV7jxGMNqeCI4/eNT/hhlz548bPDzfhv9vcNlgUtkmbKoKeH7fBoSCPWpMz3j8T1HVBKrhlw1zT0+YTStvAYB4UgOxr+pwZ9mD4MhtZLWeuPiKiAiB4DCRDJuTsndHywEq3rzJ0PM2tAGlV0WCuw1mDXPuWkLPGqiX11WWkfEsaX8HhXS8OEcmyQ479PO/ad3ecd+fOOMS3LSRjvQGMIKzWdpEFkeWag2hCFrrpbC/BEdoJPdvv7vq06WP4tGVY8u85TpJQk08qGVjur5BCCoRkQVBFAofaWD/xvH7foRF+AID2xL+8Y3/b12ibp9vf9zXSgdIK2A9elLsz/zfZrGx+r7vh6YfWr64sHTum/Qgqkr471JTx36SXTDxw49mquw12/5v3JW8d3+RYCvsQYX/JNF9+Grz6Z+dmPAgXKI2Pc3HL/ZZc3jRcF38FjY2WuIXtZjHwSYsuqaeuPn5bTq2wXLjolyDQ7ClA6BLpCoxCSPBDi193mHHyBpAFWjs3BQClAltEgcWH3eYcZDGi7/GsQmJV7X/d5R8aQaQFgZtueyrZ/EEyTpTfu0e3XJ2+vZNf9wwNSu8FniGgYgE8g5ELh8RzXrmgmPN5NuYve2lpt5NhkmSC2bPvEoY89LTr1Y9eezE5wFQnph3ItECTFeHON2IY3ZoxqEqjsKqXpZ8sT8rchqzIkaz0AJCA83iLyxX0YziTSF/daxerCQ9rtA+Dz6o6PZnuTiWieIUWSqfSw0YsWN3i57xWBJgk5MTqAJlax22TssmJ0yZH41fyHQWv+5UmbeyB57iU+ZPu44Yn9FlqWHsTupjHZEjSAiBeTwOIoeUflfvLGPiM194BWMRr8PvtLlpAvvruA6A0SoR7CsEFyuZQyH6F0EOor4tZJ0GgQJYUq6AryQmymmPgsacVk7BzXdkdNvvS69MR4ILAeAO0Y3dyfujBvpFDuNWR53smZ9T9VcpI3dqoB2qKVvWzfrZcxGdaU7guOvQvXHgbWKQAFWVAGgRZljGpSWJ1P8cYluxP6jXgEDMN/aFdGFU3LmiXjG7cQhrXuh6sbFNayCQOgvQ8P3tTh+WVTGLqpDpQur44TteH7jDtfxCZ6nveX2R0DsFs/df6VzPm7e+/Ni0e3BRtBd92OvVnZOH/Kbdjw4UK0MUy0mfMplvax8I9jAXTzFOZ/16XBXsOhEzE+o1g5fPPaNzc59bA9ZXvXc/Uj84OfvTT6DAPmJ4Nn2OR0bQdGs788npW9jaSxgmK84yFiMpyv35p7FlmF20WsW7bhUy5hIbLtL6ZtB0DmkDv66kDJYNb6r3rDR4HqtEU1JmEr+sqbzXO2amnJGTGxop3Bzp4FB+UH/owc9J29Acp2oJWLg5KwcO4iHPCXo1xoHNdlGLo6H5NziuC27/UJVOCoGYOuQso/r31zk4tTC7pw1X0t+bg+/NM5LUMYPhFxPcMmJ7MTXEFaTxGWp6P0xo4SlmcBCXkZJK2OQD+MDqfwQh19uR5aBIA8l09Ogh1YRk5wLiwPAWASxqPS43vGiGucWosuV68XTylsaj+vfHn97kObD/dKSfnjetV89AuLGo1BduN4JEKg8YKFGH7b9WiS2ACTHroDTb7bggZFZcgxg1h38WQUpv3x1ubJf9qugk7XVa+szwjD77TW7RHe18atb3+grkOhU/Fduxu08oJ4vf3N+wNBdC0E/YmVHux89WZ2BB4Iwz+cjev71iASrdClHC8rR7Jy4qlBswos5x6A0vWR7Vtq6x1NcVcj5RzYcJzTBooPdenRiT/u/zb11b6X4uojR9D/UAaGpqdjaHo6ACBxcD8syS7DF78agr371iLF1P5GbXt//u2M711En77CpLtTpqmq957h96WD9UNgTgNgg2k1BL0QXPr6UQDsGXZve2h+FMT9AAgQbQHopeDS1zOswbcaZHkXAbwJTGtB+C2AFgBvhta/Y+YrWDm3gjVAopM15LY50OpFQEwWptUBwDPWZXd5iMx7QXwtgGQAAQDbIOTTwS9f21Pb0Z7h9yZC8W8h+BIwYkG0o0Ke9daAmyT54r6A4jUg2gjCYwBSQLQZwng8uOTV7Eo7eIbf14zt8mmABjSamD2GfgTiF6H0hRAYI1v3uNbdtS63Ou9oHF/7SxEsfn5s/jVPLLi0Zc+hC/P2ber7SYuWWHnhZfji/U2I52IE2ML3Rc1wtFM3xKoAOqSPyfHEJV634PeDN9RyWrgAoDA8uQ65Kow4+Qq2/QsB2ETyExAaslJTQBjlufSOXgAlsh1YB0ICCTkXjCCzGg/waGvI7ZeydnfB9g8D8GuQuBcQSwGdDNY3A9wSWs8GkarizaQA6gBgAAAfgGeIxMvsBiYD+ALAZ2B0BfQdkEZvq/8Nafa3CyoPgOC5fFIcO8E1ULozpJwBRhagJoKxyhpy+whotYWD/qEA+oKEDSG+hNbJAN9ChpUC4PKTdmCGhqpmjgAAFwJXgTkd4FQA31Q33pl+Xs2Lnr4h21+WN6B1n5FPNmzQtDCQtRv/2rAJH78/A8vmvIuSrP1omJDktuwxdLaQRq8Fv790XV3BFMGhUYFx3lBix34OSpkEGh1cMf3m4PLpV5M0Hofm5qx0V3bdJ6FVIkE8Hlw+/ebgiul3EcStcJUPyn0OSgFKAZrjQeIqe+WMmwEaDs0MpftDO3Og9VQwASS32qvenQAhf6xIoKFA1szQ/CEX51xtr3z3L6zse6F1Dly3K8UnJtXS8la4bjcQ3rFXvH2P/fXbU6H1eCjXhHL/AO0CSlfIQ1fYK2bcAtCVUFqz4wywfj2+ynfBL1/PISkeBhMgxAn1w4oJ9tfvbAbJ0AolzN5H5Yivff4clfFXTX/MBvD05Q9On9a0RdcRbNsXWqkDkrxN2pR6YhtllBVlfT7nN/0Pn2FwVUJNefjUNtm0fQN2gt1BKNRO8KvKdnvr0hfNtEtm2qtmnrAG3fIeiABBn1W+16wWE6AA3ZsIJsAAUQkHSv8JAGyXZ5NplkOzCSYJABAAidAtCQHWDNahgaxt/0MQNILikp61Bt/WG6z7AJwAZgKzp6bj9YUgAFr3sobcPgcgQCsLDAY4NEmTBqRZzCX5WwCAlX2UiGyATTaMmt9LkgjtapKoPMUDSQKr8K6s/gUOwtxHBcteubsEwNyK62xDTXkoTJsggJgAkJCiqgiwUodIBg+0Bt68FCEHA3xyehNSStZu6MsWgEOGYxvaDXlSCACi4qDEBYzKA7NqY4Q0wAyjz9WSDGMxtB4Koo9BmAvGQwA+geCOp8oMFWrSewCsCzmOAaGXQmNNiDwBBFsf3V3twExwqN/JXTyEpABRRdZXbjU+4Vfs/1/8W5YLs4sgZAaABiytUQAg255HbMinAF4AQdcBWA0mMOsJMrljqB9jAkASRGsAOFUrHjMmRFhWK4GkrMax1kqMNURsw1bQeiiAIxwsv8FeOXMGgHwALSvwrJpS05rKXSWdve9N++t334BSMwDRBULceZK+AGLiQ4/ipAy1/MmChA6tdrVptD2/QqzKGDnV+VWadW2dcpPSvB9ACzDWgnAhgAMA2gA6Dyx6ANgHQiwYDQFsA3Q5SDRQSv9LCnEtCI2Y9RIikQ5gORhjGVhDBD+AIQydQRAJAFow4wABnUEoQminPRtAGoCNIHQA81Yp6PCuw9nF9Tne3vgpey6/92F2Ap9D69meS+66jcFxUDodEJkkxBcaWE7Ql0Lz72Xa4HSjx+AgK30pSOaC8BhIheZDMphkxTa5tMBKMwQ4lIIrjFuZBQgakACxZnA2kTgE1q0pJm6Wdckdx8D6eiguBCgZUvYDsK/KU8wfgIybwGqMSOnos1I6ZYB5GDSfD8IDEKRDCw+pYRihPX8SqEg3DClrZUKZD5LF0DqF4hqvtC69U0JpIxQMQte2WVUINU6Iu12zHqSZ2zJ4JzOPYs39GdyGGYO0Vs8xYSAznx+yAl/IQCozx4ORwcT3M/N8BkYx87XMrBl8lMF9mDnIzLuYcR+zFszclIHlrDmFwT2ZuTkzGwx2GZzDzI+BUArQgfzi0pIakdo5/Qa159sFtRVRe7/bb3S7aCEJUhAyiUgWkyFnkmFNCi5/K1/v31JidEn/gKQoIZIpEILIEB/BsO60l0/fK9tdYFOMrwkZ5kpn9axvoBUAsExu6yMyt+nszCVolFwgDKsTDOMDlblph+zcv4gMowOZ5kf2irc3ya7pX5A0fCSMViRlGQnxOzKNt0harWGan6o9G4+elPefyujafy5JkUXCaEMkO5AwdsM0HlW71sylRi2CwhvbDIa13Pn2ozUAwCV5WrbqEUem+Z2zdekyDh0tV+rvGl0v2k5CxpOQREKuJSGWkWkpGHK6ytwUrBEnVSO+VcpFinVLgPLAuhsgfgDpQjB1ZuC4Zp3KzHsBIsdVX5mGvAQMAUISgBMAEokpngQfAdEeMHoy62Qw1jNRORgDQdgFoBEYzZl4niDRnsAxJEQsMQVB2gGEAcYBQA8hIbQg8emuQ0erRn3MyMfuDHz6woz6ssA5qBui3qtv37ypqbU2mOEQIYYZ/lAlDCA0k5ggChw4dsJt36KJsS/rhNs+pYnFzCjyB5wEb4wXgIPqB0NE7oFjJ+yf2wi/RIj678tS0GhANGHmFgC8RHgBwF0A2gLIJGJBRPkAXpUkJwJ4nQS9BaatDb3eLCZcAeAYQs7PAeAIooGdWiT/ITMr+9DPbYhfGkRd1RORIGaXiAxiygczExETk0tEDaBFHpgbt2/ebDBr7tC+ebORAPIAxELQXUS0jpgOEFN7IvohtB5FNgmMisTyJ+hFP7H/fzNEpXfUxunYItmCgKVdHRRSxGqly4SAGVoraE0kPMxwUFkwCpATdEtMU1QuYyoqS+FRWvmlIDPgOMFYj8fafTg7EK0c5+DsQLQjg6PAO1s4Z5t+ff+4OV1e4f6r9+/S+Ux1CPf3sDr71XU+Xh9+tHSj7Xc66TrC2X3d3xhE6Bst/9OxSV1tkb4LoNPsX5f9TqEnIxCLFk4HP5JzIilbF526cMON+HDt9RkO9fSrT79obRCtvWq/q50F6uN5yqivrwOdQVs09OuC+r5KOV06kd7V9fXN6fA40xEZrf5none9wVCf0NGOjLNlqNMxztmWLRLv05XtbPCsj8+/MzufUef/1DLql7pcqw/OpJ6qgRjpQ8Vwz/UxOdOAiWb+pTraoi3kTlfm09H938E/kgzR2OQcnINz8IuD/wtOxEBmrUNT+QAAAGJ0RVh0Y29tbWVudABib3JkZXIgYnM6MCBiYzojMDAwMDAwIHBzOjAgcGM6I2VlZWVlZSBlczowIGVjOiMwMDAwMDAgY2s6NTAwZDAyYTRmMWYxZDc0OTczNDBjYzU4Njg5NmJmMTGEn9AAAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE5LTA3LTE5VDIxOjU2OjI1KzAwOjAwlF26LgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxOS0wNy0xOVQyMTo1NjoyNSswMDowMOUAApIAAAAASUVORK5CYII='
                            } );
                        },
                        //image: '<img src="http://www.munibellavista.gob.pe/wp-content/uploads/2019/01/logo_bellavista-e1549153213658.png" width="32px" height="32px"/>',
                        messageBottom: 'Municipalidad de bellavista - 2019'
                        
                    }
                ]
            });
        } else {
            $("#div_table").html(table);
            $("#body_reporte").html(null);
            
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ]
            });
        }
    }).fail(function () {
        alert("error");
    });
}