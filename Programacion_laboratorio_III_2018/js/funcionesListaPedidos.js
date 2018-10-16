function InsertarPedido() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea insertar el pedido?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, Insretar Pedido!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'NO, insertar pedido!'
    }).then(function(result) {
        if (result.value) {
            let funcionAjax = $.ajax({
                method: "POST",
                enctype: 'multipart/form-data',
                url: "../vendor/ListaPedidos/InsertarPedido",
                data: { CodigoMesa: $("#CodigoMesa").val(), IdProducto: $("#Productos").val() },
                headers: { token: tokenUsuario }
            });


            funcionAjax.then(function(dato) {
                    if (dato.status == 200) {
                        swal("El pedido fue cargado correctamente!").then(function() {
                            location.reload();
                        });
                    } else {
                        swal("ERROR. El pedido no pudo ser cargado");

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
            window.location.href("insertarPedido.html");
        }

    });

}