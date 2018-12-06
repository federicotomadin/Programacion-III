function MesaMasUsada() {

    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerMesaMasUsada'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa MAS usada' + " - " + dato.IdMesa + "-",
                "Cantidad de Operaciones" + " " + dato.Cantidad
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato);
    });
}

function MesaMenosUsada() {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerMesaMenosUsada'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.CodigoMesa + " - "
                //  "Cantidad de Operaciones" + "  " + dato.Cantidad
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.CodigoMesa);
    });
}

function MesaMasFacturo() {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerMesaQueMasFacturo'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.Mesa + " - ",
                "Importe" + " " + dato.Importe
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.Nombre);
    });
}

function MesaMenosFacturo() {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerMesaQueMenosFacturo'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.Mesa + " - ",
                "Importe" + " " + dato.Importe
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.Nombre);
    });
}

function FacturaMenorImporte() {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerFacturaMenorImporte'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Factura' + " - " + dato.facturaMenor + " - ",
                "Mesa" + " " + dato.mesa
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.Nombre);
    });
}

function FacturaMayorImporte() {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Pedidos/TraerFacturaMayorImporte'
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Factura' + " - " + dato.Importe + " - ",
                "Mesa" + " " + dato.Mesa
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.Nombre);
    });
}