function InsertarPedido() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: "POST",
        url: "../vendor/ListaPedidos/InsertarPedido",
        headers: { token: tokenUsuario },
        data: { CodigoMesa: $("#CodigoMesa").val(), IdProducto: $("#Productos").val() }

    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal("El pedido fue cargado correctamente!").then(function() {
                location.reload();
            });
        } else {
            swal("ERROR. El pedido no pudo ser cargado");

        }
    }, function(dato) {

        swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
            var funcionAjax = $.ajax({
                method: 'POST',
                url: '../vendor/Login/CerrarSesion',
            });

        });
    });
}