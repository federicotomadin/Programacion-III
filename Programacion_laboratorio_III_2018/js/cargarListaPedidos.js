window.onload = function() {
    // document.getElementById("foto").addEventListener("change", readFile);
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