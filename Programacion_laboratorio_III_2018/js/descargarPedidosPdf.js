function descargarPedidosExcel() {
    var tokenUsuario = localStorage.getItem("token");
    $.ajax({
        url: '../vendor/Pedidos/TraerTodosLosPedidosPdf',
        method: 'GET',
        headers: { token: tokenUsuario }
    });
}