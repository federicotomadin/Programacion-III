function CerrarMesa(idMesa) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea cerrar la mesa?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cerrar mesa!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no cerrar mesa!'
    }).then(function(result) {
        if (result.value) {
            var funcionAjax = $.ajax({
                url: "../vendor/Pedidos/CerrarMesa/" + idMesa,
                headers: { token: tokenUsuario },
                method: "POST"
            });

            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal("La mesa fue cerrada correctamente!").then(function() {
                        location.reload();
                    });
                } else {
                    swal("ERROR. La mesa no pudo ser cerrada");
                }
            });
        } else {
            location.reload();
        }
    });
}

function ConfirmarPedido() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea confirmar el pedido?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar el pedido!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no confirmar el pedido!'
    }).then(function(result) {
        if (result.value) {
            console.log($("#foto")[0].files[0]);
            base64($("#foto")[0].files[0], function(foto) {
                var funcionAjax = $.ajax({
                    url: "../vendor/Pedidos/ConfirmarPedido",
                    headers: { token: tokenUsuario },
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: { CodigoMesa: $("#CodigoMesa").val(), foto: foto, AgregarMinutos: $("#AgregarMinutos").val() }

                });
                funcionAjax.then(function(dato) {
                    if (dato.status == 200) {
                        swal("El pedido fue confirmado correctamente!").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("ERROR. El pedido no fue confirmado");
                    }
                });
            });


        } else {
            location.reload();
        }
    });
}


function base64(fotoObj, callback) {
    console.log("base64 " + fotoObj.name)
    var reader = new FileReader();

    reader.onload = function(readerEvt) {
        var binaryString = readerEvt.target.result;
        var fotoBase64 = btoa(binaryString);
        //$(thumb).show();
        //$(thumb).attr("src", "data:image/png;base64," + fotoBase64);
        console.log("foto cargada");
        callback(fotoBase64);
    };

    reader.readAsBinaryString(fotoObj);
}

function DescargarPedidosExcel() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea descargar el Excel?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, descargar!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no descargar!'
    }).then(function() {
        var funcionAjax = $.ajax({
            url: "../vendor/Pedidos/TraerTodosLosPedidosExcel",
            headers: { token: tokenUsuario },
            contentType: 'application/vnd.ms-excel',
            method: "GET",

            success: function(data) {
                console.log('ok');
                var blob = new Blob([data], { type: 'application/vnd.ms-excel' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "report.xls";
                link.click();
            }
        });
        funcionAjax.then(function(data) {
                // if (dato.success) {
                swal("El listado fue descargado correctamente!").then(function() {
                    location.reload();
                });
                //} else {
                //  swal("ERROR. El listado no pudo ser descargado");
                // }
            },
            funcionAjax.then(function(dato) {

                swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
                    var funcionAjax = $.ajax({
                        method: 'POST',
                        url: '../vendor/Login/CerrarSesion'

                    });
                    funcionAjax.then(function(dato) {
                        if (dato.status == 200) {
                            localStorage.clear();
                            window.location.replace("../enlaces/login.html");
                        } else if (dato.status == 400) {
                            swal("Hubo un error al cerrar sesión del usuario!");
                        }
                    }, function(dato) {
                        console.log("ERROR en la API " + dato);
                    });
                });
            }));
    });
}

jQuery.download = function(url, data, method) {
    //url and data options required
    if (url && data) {
        //data can be string of parameters or array/object
        data = typeof data == 'string' ? data : jQuery.param(data);
        //split params into form inputs
        var inputs = '';
        jQuery.each(data.split('&'), function() {
            var pair = this.split('=');
            inputs += '<input type="hidden" name="' + pair[0] + '" value="' + pair[1] + '" />';
        });
        //send request
        jQuery('<form action="' + url + '" method="' + (method || 'post') + '">' + inputs + '</form>')
            .appendTo('body').submit().remove();
    };
};

function DescargarPedidosPdf() {
    swal({
        title: 'Desea descargar el PDF?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, descargar!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no descargar!'
    }).then(function() {

        var funcionAjax = $.ajax({
            url: "../vendor/Pedidos/TraerTodosLosPedidos",
            //  headers: { token: tokenUsuario },
            method: "GET"
        });
        funcionAjax.then(function(data) {
                bajarPDF(data.pedidos);
                swal("El listado fue descargado correctamente!").then(function() {
                    location.reload();
                });
            },
            funcionAjax.then(function(dato) {

                swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
                    var funcionAjax = $.ajax({
                        method: 'POST',
                        url: '../vendor/Login/CerrarSesion'

                    });
                    funcionAjax.then(function(dato) {
                        if (dato.status == 200) {
                            localStorage.clear();
                            window.location.replace("../enlaces/login.html");
                        } else if (dato.status == 400) {
                            swal("Hubo un error al cerrar sesión del usuario!");
                        }
                    }, function(dato) {
                        console.log("ERROR en la API " + dato);
                    });
                });
            }));

    });
}





var json2pdf;

function bajarPDF(json) {

    espacioX = 29;
    espacioY = 7;
    cantLineasPorPag = 27;


    json2pdf = new jsPDF('l', 'mm', [297, 210]);


    json2pdf.setFont("helvetica");
    //header
    json2pdf.setFontSize(10);
    json2pdf.setFontType("bold");
    cont = 0;
    $.each(json[0], function(key, value) {
        json2pdf.text(espacioX * cont + espacioX / 3, espacioY, key);
        cont++;
    });


    //data
    json2pdf.setFontSize(8);
    json2pdf.setFontType("regular");
    var fila = 1;
    $.each(json, function(key, value) {
        col = 0;
        $.each(json[key], function(key2, value2) {
            json2pdf.text(espacioX * col + espacioX / 3, fila * espacioY + espacioY, String(value2));
            col++;

        })
        fila++;
        if (cantLineasPorPag <= fila) {
            json2pdf.addPage()
            fila = 1;
        }
    })


    json2pdf.save('pdf.pdf');
}