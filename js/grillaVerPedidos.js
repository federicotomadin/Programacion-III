window.onload = function() {
    setInterval(CargarAutomatico, 1000);

};

// window.onload = function() {
//     var tokenUsuario = localStorage.getItem("token");
//     var funcionAjax = $.ajax({
//         method: "POST",
//         headers: { token: tokenUsuario },
//         url: "../vendor/ListaPedidos/VerPedidos"
//     });
//     funcionAjax.then(function(dato) {
//         var stringPedidos = " ";
//         for (var i = 0; i < dato.Pedido.length; i++) {
//             stringPedidos += "<tr>";
//             stringPedidos += "<td>" + dato.Pedido[i] + "</td>";
//             stringPedidos += "<td>" + dato.Pedido[i + 1] + "</td>";
//             stringPedidos += "<td><button class='btn btn-warning' onclick='CambiarEstado(" + JSON.stringify(dato.Pedido[i + 1]) + ")' " +
//                 "<span class='glyphicon glyphicon-edit'></span>Cambiar Estado</button></td>";
//             stringPedidos += "</tr>";
//             i++;
//         }
//         document.getElementById("pedidos").innerHTML = stringPedidos;
//     }, function(dato) {

//     });
// };

function CargarAutomatico() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: "POST",
        headers: { token: tokenUsuario },
        url: "../vendor/ListaPedidos/VerPedidos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        for (var i = 0; i < dato.pedidosPendientes.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + cambiarIdPorNombreProducto(parseInt(dato.pedidosPendientes[i].Id_producto)) + "</td>";
            stringPedidos += "<td>" + dato.pedidosPendientes[i].CodigoMesa + "</td>";
            stringPedidos += "<td>" + cambiarIdPorEstadoPedido(parseInt(dato.pedidosPendientes[i].Id_estadoPedido)) + "</td>";
            stringPedidos += "<td align='center' colspan='2'><button  class='btn btn-warning' onclick='CambiarEstado(" + JSON.stringify(dato.pedidosPendientes[i].CodigoMesa) + ")' " +
                "<span class='glyphicon glyphicon-edit'></span>Cambiar Estado</button></td>";
            stringPedidos += "</tr>";
            i++;
        }
        document.getElementById("pedidos").innerHTML = stringPedidos;
    })
}

function CambiarEstado(CodigoMesa) {
    var tokenUsuario = localStorage.getItem("token");
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
        var objJson = { CodigoMesa: CodigoMesa, estadoPedido: parseInt($("#EstadoPedido").val()), AgregarMinutos: parseInt($("#AgregarMinutos").val()) }
        if (result.value) {
            let funcionAjax = $.ajax({
                type: "POST",
                headers: { token: tokenUsuario },
                dataType: "json",
                url: "../vendor/ListaPedidos/CambiarEstadoPedido",
                data: objJson
            })
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
                    alert("El estado fue cambiado correctamente!" + dato.status);
                    window.location.reload();
                });
        }

    });
}


function cambiarIdPorNombreProducto(IdProducto) {
    switch (IdProducto) {
        case IdProducto = 1:
            return "Asado de Tira";
        case IdProducto = 2:
            return "Cerveza Tirada Red";
        case IdProducto = 3:
            return "Caipiroshka";
    }
}

function cambiarIdPorEstadoPedido(IdEstadoPedido) {
    switch (IdEstadoPedido) {
        case IdEstadoPedido = 1:
            return "En Preparacion";
        case IdEstadoPedido = 2:
            return "Listo Para Servir";
        case IdEstadoPedido = 3:
            return "Cancelado";
        case IdEstadoPedido = 4:
            return "Sin Tiempo";
    }
}