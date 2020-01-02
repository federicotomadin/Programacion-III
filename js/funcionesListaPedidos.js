window.onload = function() {
    $("#PrecioTotal").val(localStorage.getItem("PrecioTotal"));
    let funcionAjaxProductos = $.ajax({
        method: "GET",
        url: "../vendor/ListaPedidos/TraerTodosLosProductos"
    });
    funcionAjaxProductos.then(function(dato) {
            var productos = " ";
            for (var i = 0; i < dato.productos.length; i++) {
                productos += "<option value=" + parseInt(dato.productos[i].id_producto) + ">" + dato.productos[i].Nombre + " ------- $ " + dato.productos[i].Precio + "</option>";
            }
            $("#Productos").html(productos);
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });

    let funcionAjaxMesas = $.ajax({
        method: "GET",
        url: "../vendor/Mesas/TraerLasMesasEsperandoAtencion"

    });

    funcionAjaxMesas.then(function(dato) {
            var mesas = " ";
            for (var i = 0; i < dato.mesas.length; i++) {
                mesas += "<option value=" + dato.mesas[i].CodigoMesa + ">" + dato.mesas[i].CodigoMesa + "</option><br>";

            }
            $("#CodigoMesa").html(mesas);
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });

    let funcionAjaxBotonesMesas = $.ajax({
        method: "GET",
        url: "../vendor/Mesas/TraerTodasLasMesas"
    });

    funcionAjaxBotonesMesas.then(function(dato) {
            var mesas = " ";
            for (var i = 0; i < dato.mesas.length; i++) {
                if (dato.mesas[i].CodigoMesa === 'abc11') {
                    if (dato.mesas[i].EstadoMesa === "EsperandoAtencion") {
                        $('#abc11').css('background-color', 'yellow');
                    }
                    if (dato.mesas[i].EstadoMesa === "Libre") {
                        $('#abc11').css('background-color', 'green');
                    }
                    if (dato.mesas[i].EstadoMesa === "Ocupada") {
                        $('#abc11').css('background-color', 'red');
                    }
                    if (dato.mesas[i].EstadoMesa === "EsperandoPedido") {
                        $('#abc11').css('background-color', 'blue');
                    }
                }

                if (dato.mesas[i].CodigoMesa === 'abc12') {
                    if (dato.mesas[i].EstadoMesa === "EsperandoAtencion") {
                        $('#abc12').css('background-color', 'yellow');
                    }
                    if (dato.mesas[i].EstadoMesa === "Libre") {
                        $('#abc12').css('background-color', 'green');
                    }
                    if (dato.mesas[i].EstadoMesa === "Ocupada") {
                        $('#abc12').css('background-color', 'red');
                    }
                    if (dato.mesas[i].EstadoMesa === "EsperandoPedido") {
                        $('#abc12').css('background-color', 'blue');
                    }
                }
                if (dato.mesas[i].CodigoMesa === 'abc13') {
                    if (dato.mesas[i].EstadoMesa === "EsperandoAtencion") {
                        $('#abc13').css('background-color', 'yellow');
                    }
                    if (dato.mesas[i].EstadoMesa === "Libre") {
                        $('#abc13').css('background-color', 'green');
                    }
                    if (dato.mesas[i].EstadoMesa === "Ocupada") {
                        $('#abc13').css('background-color', 'red');
                    }
                    if (dato.mesas[i].EstadoMesa === "EsperandoPedido") {
                        $('#abc13').css('background-color', 'blue');
                    }
                }
                if (dato.mesas[i].CodigoMesa === 'abc14') {
                    if (dato.mesas[i].EstadoMesa === "EsperandoAtencion") {
                        $('#abc14').css('background-color', 'yellow');
                    }
                    if (dato.mesas[i].EstadoMesa === "Libre") {
                        $('#abc14').css('background-color', 'green');
                    }
                    if (dato.mesas[i].EstadoMesa === "Ocupada") {
                        $('#abc14').css('background-color', 'red');
                    }
                    if (dato.mesas[i].EstadoMesa === "EsperandoPedido") {
                        $('#abc14').css('background-color', 'blue');
                    }
                }

                mesas += "<option value=" + dato.mesas[i].CodigoMesa + ">" + dato.mesas[i].CodigoMesa + "</option><br>";
                $("#CodigoMesa").html(mesas);
            }
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });
};

function AsignarMesaAbc11() {

    console.log("estoy aca");

    var boton = document.querySelector("#abc11");
    if (boton.style.backgroundColor == "yellow" || boton.style.backgroundColor == "blue" ||
        boton.style.backgroundColor == "red") {
        $("#CodigoMesa").val("abc11");
        $("#abc11").css("background-color", "blue");
    }
}

function AsignarMesaAbc12() {
    var boton = document.querySelector("#abc12");
    if (boton.style.backgroundColor == "yellow" || boton.style.backgroundColor == "blue" ||
        boton.style.backgroundColor == "red") {
        $("#CodigoMesa").val("abc12");
        $("#abc12").css("background-color", "blue");
    }
}

function AsignarMesaAbc13() {
    var boton = document.querySelector("#abc13");
    if (boton.style.backgroundColor == "yellow" || boton.style.backgroundColor == "blue" ||
        boton.style.backgroundColor == "red") {
        $("#CodigoMesa").val("abc13");
        $("#abc13").css("background-color", "blue");
    }
}

function AsignarMesaAbc14() {
    var boton = document.querySelector("#abc14");
    if (boton.style.backgroundColor == "yellow" || boton.style.backgroundColor == "blue" ||
        boton.style.backgroundColor == "red") {
        $("#CodigoMesa").val("abc14");
        $("#abc14").css("background-color", "blue");
    }
}

function ReiniciarValores() {
    localStorage.setItem("PrecioTotal", 0);
}


function InsertarPedido() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea insertar el pedido?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Insretar Pedido!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'NO, insertar pedido!'
    }).then(function(result) {
        if (result.value) {
            funcionAjax = $.ajax({
                method: "POST",
                headers: { token: tokenUsuario },
                enctype: 'multipart/form-data',
                url: "../vendor/ListaPedidos/InsertarPedido",
                data: { CodigoMesa: $("#CodigoMesa").val(), IdProducto: $("#Productos").val(), Cantidad: $("#Cantidad").val() }
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    var precio = localStorage.getItem("PrecioTotal");
                    var precioTemporal = parseInt(precio);
                    var precio2 = precioTemporal + dato.precio * parseInt(dato.cantidad);
                    localStorage.setItem("PrecioTotal", precio2);
                    $('#PrecioTotal').val(precio2);
                    swal('El pedido fue cargado correctamente!').then(function() {
                        location.reload();
                    })
                } else if (dato.status == 400) {
                    swal("ERROR. El pedido no pudo ser cargado");
                } else if (dato.status == null) {

                    swal("ERROR. Se termino el tiempo de su sesion");
                    window.location.replace("../enlaces/login.html");
                }
            })
        }
    })
}
