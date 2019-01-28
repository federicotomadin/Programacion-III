window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Empleado/TraerMozos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        for (var i = 0; i < dato.mozos.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + dato.pedidos[i].foto + "'/></td>";
            stringPedidos += "<td>" + dato.mozos[i].Nombre + "</td>";
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