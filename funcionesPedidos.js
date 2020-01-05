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
            }).then(function(dato) {
                console.log(dato.status);
                if (dato.status === 200) {
                    swal({ 
                        title:'CERRADA CORRECTAMENTE',
                        timer: 1000,
                        showConfirmButton: false }).then(function() {
                            location.reload();
                        });               
                } else if (dato.status === 401) {
                    swal({ 
                        title:'No se puede cerrar una mesa antes de la orden del mozo',
                        timer: 1000,
                        showConfirmButton: false }).then(function() {
                            location.reload();
                        });           
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
                    data: { CodigoMesa: $("#CodigoMesa").val(), foto: foto }

                });
                funcionAjax.then(function(dato) {
                    if (dato.status == 200) {
                        swal("El pedido fue confirmado correctamente!").then(function() {
                            location.reload();
                        });
                    } else if (dato.status == 403) {
                        swal("ERROR. No se puede confirmar mesa de un pedido que no se tomó");
                    } else {
                        swal("ERROR");
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
    var headers = {
        Id_pedido: 'Id_pedido',
        Tiempo_ingreso: "Tiempo_ingreso",
        Tiempo_estimado: "Tiempo_estimado",
        Tiempo_llegadaMesa: "Tiempo_llegadaMesa",
        Id_estadoCuenta: "Id_estadoCuenta",
        Id_empleado: "Id_empleado",
        CodigoMesa: "CodigoMesa",
        Importe: "Importe"
    };
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
            url: "../vendor/Pedidos/TraerTodosLosPedidos",
            method: "GET"
        });
        funcionAjax.then(function(data) {
                exportCSVFile(headers, data.pedidos, "pedidos");
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
            }))
    });
}


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
    json2pdf.setFontSize(5);
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

function convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';
    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }
        str += line + '\r\n';
    }
    return str;
}

function exportCSVFile(headers, items, fileTitle) {
    if (headers) {
        items.unshift(headers);
    }

    // Convert Object to JSON
    var jsonObject = JSON.stringify(items);

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}