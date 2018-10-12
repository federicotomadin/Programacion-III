function descargarPedidosExcel() {
    var tokenUsuario = localStorage.getItem("token");
    $.ajax({
        url: '../vendor/Pedidos/TraerTodosLosPedidosExcel',
        method: 'GET',
        headers: { token: tokenUsuario }
    });
}