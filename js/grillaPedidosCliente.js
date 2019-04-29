window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Pedidos/TraerLosPedidos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        for (var i = 0; i < dato.pedidos.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + dato.pedidos[i].Tiempo_ingreso + "</td>";
            stringPedidos += "<td>" + ActualizarEstadoCuenta(dato.pedidos[i].EstadoCuenta) + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Usuario + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Importe + "</td>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + dato.pedidos[i].foto + "'/></td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CambiarEstadoMesa(" + dato.pedidos[i].Id_pedido + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Pedir la cuenta</button>";
            stringPedidos += "<td><button data-toggle='modal' data-target='#modalFormEstadoPedidos' class='btn btn-warning' onclick='CargarEstadoPedidos(" + parseInt(dato.pedidos[i].Id_pedido) + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Ver Pedidos</button>";
            stringPedidos += "</tr>";
        }

        document.getElementById("pedidos").innerHTML = stringPedidos;
    });

    function ActualizarEstadoCuenta($estadoCuenta) {
        switch ($estadoCuenta) {
            case $estadoCuenta = "En Preparacion":
                return "En Curso";
            case $estadoCuenta = "Comiendo":
                return "Consumiendo";
            case $estadoCuenta = "Sin Tiempo":
                return "Esperando";
            case $estadoCuenta = "Cancelada":
                return "Cancelada";
            case $estadoCuenta = "Cerrada":
                return "Cerrada";
            case $estadoCuenta = "Esperando Cierre":
                return "Esperando Cierre";
        }
    }
};

function CargarEstadoPedidos(IdPedido) {
    var funcionAjax = $.ajax({
        type: 'POST',
        url: '../vendor/ListaPedidos/VerPedido/' + IdPedido,
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        for (var i = 0; i < dato.pedidosPendientes.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + CambiarIdPorNombreProducto(dato.pedidosPendientes[i].Id_producto) + "</td>";
            stringPedidos += "<td>" + CambiarIdEstadoPedido(dato.pedidosPendientes[i].Id_estadoPedido) + "</td>";
            stringPedidos += "<td>" + dato.pedidosPendientes[i].Tiempo_estimado + "</td>";
            stringPedidos += "<td>" + dato.pedidosPendientes[i].Tiempo_esperandoEntrega + "</td>";
            stringPedidos += "<td>" + dato.pedidosPendientes[i].Tiempo_llegadaMesa + "</td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='RecibiElPedido(" + JSON.stringify(dato.pedidosPendientes[i].CodigoMesa) + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Recibì Pedido</button>";
            stringPedidos += "</tr>";
        }

        document.getElementById("pedidosPendientes").innerHTML = stringPedidos;
    });
}

function RecibiElPedido(CodigoMesa) {
    swal({
        title: 'Desea cambiar el estado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, cambiar el estado!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Cancelar!'
    }).then(function(result) {
        var objJson = { CodigoMesa: CodigoMesa, estadoPedido: 4 };
        if (result.value) {
            funcionAjax = $.ajax({
                type: "POST",
                dataType: "json",
                url: "../vendor/ListaPedidos/CambiarEstadoPedido",
                data: objJson
            });
            funcionAjax.then(function(dato) {
                    if (dato.status == 200) {
                        swal('El estado fue cambiado correctamente!').then(function() {
                            window.location.reload();
                        }, function() {
                            swal("OCURRIO ALGO INESPERADO!");
                        })
                    }
                },
                function(dato) {
                    alert("ERROR" + dato.status);
                    window.location.reload();
                });
        }

    });
}

function CambiarIdEstadoPedido(IdEstadoPedido) {
    switch (IdEstadoPedido) {
        case IdEstadoPedido = 1:
            return "Pendiente";
        case IdEstadoPedido = 2:
            return "Listo Para Servir";
        case IdEstadoPedido = 3:
            return "Cerrada";
        case IdEstadoPedido = 4:
            return "Sin Tiempo";
    }
}

function CambiarIdPorNombreProducto(IdProducto) {
    switch (IdProducto) {
        case IdProducto = 1:
            return "Asado de Tira";
        case IdProducto = 2:
            return "Cerveza Tirada Red";
        case IdProducto = 3:
            return "Caipiroshka";
    }
}


function CambiarEstadoMesa(Id_pedido) {
    swal({
        title: 'Desea cambiar el estado de la Mesa?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, cambiar el estado!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Cancelar!'
    }).then(function() {
        let funcionAjax = $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: "../vendor/Pedidos/CambiarEstadoMesa",
            data: { idPedido: Id_pedido, estadoMesa: 'Esperando Cierre' }
        });
        funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal("El estado fue cambiado correctamente!").then(function() {
                        location.reload();
                    });
                } else if (dato.status == 403) {
                    swal("ERROR. una mesa cerrada no puede ser abierta nuevamente");
                }
            },
            function(dato) {
                swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
                    var funcionAjax2 = $.ajax({
                        method: 'POST',
                        url: '../vendor/Login/CerrarSesion',
                    });
                    funcionAjax2.then(function(dato) {})
                });
            });

    });
}