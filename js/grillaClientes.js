window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Productos/TraerTodosLosProductos"
    });
    funcionAjax.then(function(dato) {
            var stringProductos = " ";
            for (var i = 0; i < dato.productos.length; i++) {
                stringProductos += "<tr>";
                stringProductos += "<td>" + dato.productos[i].Nombre + "</td>";
                stringProductos += "<td>" + dato.productos[i].Descripcion + "</td>";
                stringProductos += "<td>" + dato.productos[i].Precio + "</td>";
                stringProductos += "</tr>";
            }
            document.getElementById("productos").innerHTML = stringProductos;

        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + dato);
        });
};