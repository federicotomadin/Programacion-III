window.onload = function() {
    $("#PrecioTotal").val(localStorage.getItem("PrecioTotal"));
    let funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/ListaPedidos/TraerTodosLosProductos"
    });
    funcionAjax.then(function(dato) {
            var productos = " ";
            for (var i = 0; i < dato.productos.length; i++) {
                productos += "<option value=" + dato.productos[i].id_producto + ">" + dato.productos[i].Nombre + " ------- $ " + dato.productos[i].Precio + "</option>";
            }
            $("#Productos").html(productos);
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });

    let funcionAjax2 = $.ajax({
        method: "GET",
        url: "../vendor/ListaPedidos/TraerTodasLasMesas"

    });

    funcionAjax2.then(function(dato) {
            var mesas = " ";
            for (var i = 0; i < dato.mesas.length; i++) {
                mesas += "<option value=" + dato.mesas[i].CodigoMesa + ">" + dato.mesas[i].CodigoMesa + "</option><br>";

            }
            $("#CodigoMesa").html(mesas);
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });
};

function ReiniciarValores() {
    localStorage.setItem("PrecioTotal", 0);
}


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
            funcionAjax = $.ajax({
                method: "POST",
                headers: { token: tokenUsuario },
                enctype: 'multipart/form-data',
                url: "../vendor/ListaPedidos/InsertarPedido",
                data: { CodigoMesa: $("#CodigoMesa").val(), IdProducto: $("#Productos").val(), Cantidad: $("#Cantidad").val() }
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    var precio = localStorage.getItem("PrecioTotal");
                    var precioTemporal = parseInt(precio);
                    var precio2 = precioTemporal + dato.precio * parseInt(dato.cantidad);
                    localStorage.setItem("PrecioTotal", precio2);
                    $('#PrecioTotal').val(precio2);
                    swal('El pedido fue cargado correctamente!').then(function() {
                        location.reload();
                    })
                } else if (dato.status == 400) {
                    swal("ERROR. El pedido no pudo ser cargado");
                } else if (dato.status == null) {

                    swal("ERROR. Se termino el tiempo de su sesion");
                    window.location.replace("../enlaces/login.html");
                }
            })
        }
    })
}