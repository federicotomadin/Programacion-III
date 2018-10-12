function CerrarMesa(idMesa) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea cerrar la mesa?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, cerrar mesa!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no cerrar mesa!'
    }).then(function(value) {
        if (value == "true") {
            var funcionAjax = $.ajax({
                url: "../vendor/Pedidos/CerrarMesa/" + idMesa,
                headers: { token: tokenUsuario },
                method: "POST"
            });

            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal("La mesa fue cerrada correctamente!").then(function() {
                        location.reload();
                    });
                } else {
                    swal("ERROR. La mesa no pudo ser cerrada");
                }
            });
        } else {
            location.reload();
        }
    });
}

function DescargarPedidosExcel() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea descargar el Excel?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, descargar!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no descargar!'
    }).then(function() {
        var funcionAjax = $.ajax({
            url: "../vendor/Pedidos/TraerTodosLosPedidosExcel",
            headers: { token: tokenUsuario },
            contentType: 'application/vnd.ms-excel',
            method: "GET",

            success: function(data) {
                console.log('ok');
                var blob = new Blob([data], { type: 'application/vnd.ms-excel' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "report.xls";
                link.click();
            }
        });
        funcionAjax.then(function(data) {
                // if (dato.success) {
                swal("El listado fue descargado correctamente!").then(function() {
                    location.reload();
                });
                //} else {
                //  swal("ERROR. El listado no pudo ser descargado");
                // }
            },
            funcionAjax.then(function(dato) {

                swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
                    var funcionAjax = $.ajax({
                        method: 'POST',
                        url: '../vendor/Login/CerrarSesion'

                    });
                    funcionAjax.then(function(dato) {
                        if (dato.status == 200) {
                            localStorage.clear();
                            window.location.replace("../enlaces/login.html");
                        } else if (dato.status == 400) {
                            swal("Hubo un error al cerrar sesión del usuario!");
                        }
                    }, function(dato) {
                        console.log("ERROR en la API " + dato);
                    });
                });
            }));
    });
}

function DescargarPedidosPdf() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea descargar el PDF?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, descargar!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no descargar!'
    }).then(function() {
        var funcionAjax = $.ajax({
            url: "../vendor/Pedidos/TraerTodosLosPedidosPdf",
            headers: { token: tokenUsuario },
            method: "GET",
            success: function(data) {
                console.log('ok');
                var blob = new Blob([data], { type: 'application/pdf' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "report.pdf";
                link.click();
            }
        });
        funcionAjax.then(function(data) {
                // if (dato.success) {
                swal("El listado fue descargado correctamente!").then(function() {
                    location.reload();
                });
                //} else {
                //  swal("ERROR. El listado no pudo ser descargado");
                // }
            },
            funcionAjax.then(function(dato) {

                swal("ERROR. Su tiempo de sesión se ha acabado!").then(function() {
                    var funcionAjax = $.ajax({
                        method: 'POST',
                        url: '../vendor/Login/CerrarSesion'

                    });
                    funcionAjax.then(function(dato) {
                        if (dato.status == 200) {
                            localStorage.clear();
                            window.location.replace("../enlaces/login.html");
                        } else if (dato.status == 400) {
                            swal("Hubo un error al cerrar sesión del usuario!");
                        }
                    }, function(dato) {
                        console.log("ERROR en la API " + dato);
                    });
                });
            }));
    });
}