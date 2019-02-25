window.onload = function() {
    let funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/ListaPedidos/TraerTodosLosProductos"
    });
    funcionAjax.then(function(dato) {
            var productos = " ";
            for (var i = 0; i < dato.productos.length; i++) {
                productos += "<option value=" + dato.productos[i].id_producto + ">" + dato.productos[i].Nombre + "</option>";
            }
            $("#Productos").html(productos);
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });

    let funcionAjax2 = $.ajax({
        method: "GET",
        url: "../vendor/Mesas/TraerLasMesasEsperandoPedido"
    });

    funcionAjax2.then(function(dato) {
            for (var i = 0; i < dato.mesas.length; i++) {
                $("#CodigoMesa").val(dato.mesas[i].CodigoMesa);
            }

        },
        function(dato) {
            alert("ERROR no se pudieron cargar los productos" + dato);
        });
};