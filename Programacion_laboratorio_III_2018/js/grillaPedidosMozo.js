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
            stringPedidos += "<td>" + dato.pedidos[i].Tiempo_estimado + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Tiempo_llegadaMesa + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].EstadoCuenta + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Usuario + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].CodigoMesa + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Importe + "</td>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + dato.pedidos[i].foto + "'/></td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CambiarEstadoMesa(" + dato.pedidos[i].Id_pedido + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Cambiar Estado</button>";
            stringPedidos += "</tr>";
        }

        document.getElementById("pedidos").innerHTML = stringPedidos;
    });
};


function CambiarEstadoMesa(Id_pedido) {
    var tokenUsuario = localStorage.getItem("token");
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
    }).then(function(result) {
        if (result.value) {
            let funcionAjax = $.ajax({
                method: "POST",
                headers: { token: tokenUsuario },
                enctype: 'multipart/form-data',
                url: "../vendor/Pedidos/CambiarEstadoMesa",
                data: { idPedido: Id_pedido, estadoMesa: $("#EstadoPedido").val() }
            });
            funcionAjax.then(function(dato) {
                    if (dato.status == 200) {
                        swal("El estado fue cambiado correctamente!").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("ERROR. El estado no pudo ser cambiado");
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
        } else {
            location.reload();
        }
    });
}