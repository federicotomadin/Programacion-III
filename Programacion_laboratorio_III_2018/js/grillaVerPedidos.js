window.onload = function() {
    setInterval(CargarAutomatico, 1000);

};

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
        cancelButtonText: 'NO, no cambiar el estado!'
    }).then(function(result) {
        if (result.value) {
            let funcionAjax = $.ajax({
                method: "POST",
                headers: { token: tokenUsuario },
                enctype: 'multipart/form-data',
                url: "../vendor/ListaPedidos/CambiarEstadoPedido",
                data: { CodigoMesa: CodigoMesa, estadoPedido: $("#EstadoPedido").val() }
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
                        var funcionAjax = $.ajax({
                            method: 'POST',
                            url: '../vendor/Login/CerrarSesion',
                        });

                    });
                });
        } else {
            location.reload();
        }

    });
}