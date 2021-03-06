window.onload = function() {
    setInterval(CargarAutomatico, 1000);
};

function CargarAutomatico() {

    var funcionAjax = $.ajax({
        type: "GET",
        url: "../vendor/Pedidos/TraerLosPedidosSinDuplicar"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        for (var i = 0; i < dato.pedidos.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + dato.pedidos[i].Tiempo_ingreso + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Tiempo_llegadaMesa + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].EstadoCuenta + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Usuario + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].CodigoMesa + "</td>";
            stringPedidos += "<td>" + dato.pedidos[i].Importe + "</td>";
            stringPedidos += "<td><img src='../fotosPedidosCambiadas/" + dato.pedidos[i].foto + "'/></td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CerrarMesa(" + JSON.stringify(dato.pedidos[i].CodigoMesa) + ")'>" +
                "<span class='glyphicon glyphicon-edit'></span>Cerrar Mesa</button>";
            stringPedidos += "</tr>";
        }
        document.getElementById("pedidos").innerHTML = stringPedidos;
    });
}