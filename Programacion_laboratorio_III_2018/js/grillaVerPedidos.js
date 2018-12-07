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
        for (var i = 0; i < dato.Pedido.length; i++) {
            stringPedidos += "<tr>";
            stringPedidos += "<td>" + dato.Pedido[i] + "</td>";
            stringPedidos += "<td>" + dato.Pedido[i + 1] + "</td>";
            stringPedidos += "<td><button class='btn btn-warning' onclick='CambiarEstado(" + JSON.stringify(dato.Pedido[i + 1]) + ")' " +
                "<span class='glyphicon glyphicon-edit'></span>Cambiar Estado</button></td>";
            stringPedidos += "</tr>";
            i++;
        }
        document.getElementById("pedidos").innerHTML = stringPedidos;
    }, function(dato) {

    });
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
        var objJson = { CodigoMesa: CodigoMesa, estadoPedido: parseInt($("#EstadoPedido").val()) }
        if (result.value) {
            let funcionAjax = $.ajax({
                method: "POST",
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
};