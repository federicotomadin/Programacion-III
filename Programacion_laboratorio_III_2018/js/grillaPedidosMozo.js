window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Pedidos/TraerTodosLosPedidos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        var PedidosFilter = dato.pedidos.filter(function(elemento) {
            return elemento.EstadoCuenta != "Cerrada";
        });
        for (var i = 0; i < PedidosFilter.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_ingreso + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_estimado + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_llegadaMesa + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].EstadoCuenta + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Usuario + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].CodigoMesa + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Importe + "</td>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + PedidosFilter[i].foto + "'/></td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CerrarMesa(" + JSON.stringify(PedidosFilter[i].CodigoMesa) + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Cerrar Mesa</button>";
            stringPedidos += "</tr>";
        }

        var PedidosFiltros = dato.pedidos.map(function(elemento) {
            return elemento.EstadoCuenta != "Cerrada";
        });
        document.getElementById("pedidos").innerHTML = stringPedidos;
        $("#graficoBarra").html(PedidosFiltros);

    }, function(dato) {
        alert("ERROR no se pudieron cargar los pedidos" + dato);
    });
};