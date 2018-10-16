window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Pedidos/TraerTodosLosPedidos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        var PedidosFilter = dato.pedidos.filter(function(elemento) {
            return elemento.Id_estadoCuenta != 4;
        });
        for (var i = 0; i < PedidosFilter.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_ingreso + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_estimado + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Tiempo_llegadaMesa + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Id_estadoCuenta + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Id_empleado + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].CodigoMesa + "</td>";
            stringPedidos += "<td>" + PedidosFilter[i].Importe + "</td>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + PedidosFilter[i].foto + "'/></td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CerrarMesa(" + JSON.stringify(PedidosFilter[i].CodigoMesa) + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Cerrar Mesa</button>";
            stringPedidos += "</tr>";
        }
        console.log(PedidosFilter);
        document.getElementById("pedidos").innerHTML = stringPedidos;
    }, function(dato) {
        alert("ERROR no se pudieron cargar los pedidos" + dato);
    });
};