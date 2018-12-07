window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Pedidos/TraerTodosLosPedidos"
    });
    funcionAjax.then(function(dato) {
        var stringPedidos = " ";
        /*  var dato.pedidos = dato.pedidos.filter(function(elemento) {
              return elemento.EstadoCuenta != "Cerrada";
          });*/
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
            stringPedidos += "<td><button class='btn btn-warning' onclick='CerrarMesa(" + JSON.stringify(dato.pedidos[i].CodigoMesa) + ")'>" +
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

function Graficar(datos) {

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 18;

    var densityData = {
        label: 'Empleados por Operacion',
        data: [datos]
    };

    var barChart = new Chart(densityCanvas, {
        type: 'bar',
        data: {
            labels: ["Cocinero", "Bartender", "Cervecero", "Socio"],
            datasets: [densityData]
        }
    });
}