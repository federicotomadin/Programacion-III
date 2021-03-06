window.onload = function() {

    // localStorage.setItem("CodigoMesa", $('#CodigoMesa').val());
    cliente = localStorage.getItem('cliente');
    if (cliente == null) {
        swal('tiene que loguearse');
        window.location.replace("../enlaces/login.html");
    }

    var codigoMesa = localStorage.getItem('CodigoMesa');
    if (codigoMesa != "" || codigoMesa == null) {
        $('#modalFormMesa').modal('hide');
    } else {
        $('#modalFormMesa').modal('show');
        localStorage.setItem("CodigoMesa", $('#CodigoMesa').val());
    }
};

function ElegirMozoParaCalificarRemus() {

    localStorage.setItem("idEmpleado", $("#aremus").val());
    window.location.replace("../enlaces/calificaciones.html");

}

function CambiarEstadoMesaEsperandoAtencion() {
    var funcionAjax = $.ajax({
        method: "POST",
        data: { usuario: localStorage.getItem("usuario") },
        url: '../vendor/Mesas/CambiarEstadoMesaEsperandoAtencion/' + $('#CodigoMesa').val()
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            localStorage.setItem("CodigoMesa", $('#CodigoMesa').val());
            swal({
                title: "ASIGNADA",
                icon: "success",
            }).then(function() {
                $('#modalFormMesa').modal('hide');
            })
        } else {
            swal("ERROR");
        }
    })

}

function ElegirMozoParaCalificarReinoso() {

    localStorage.setItem("idEmpleado", $("#mreinoso").val());
    window.location.replace("../enlaces/calificaciones.html");

}

function Calificar() {
    var funcionAjax = $.ajax({
        method: "POST",
        enctype: 'multipart/form-data',
        url: '../vendor/Cliente/InsertarCalificacion',
        data: { idEmpleado: localStorage.getItem("idEmpleado"), calificacion: $('input[name=star]:checked', '#calificaciones').val() }
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal({
                title: "CALIFICADO",
                text: "Gracias por su tiempo",
                icon: "success",
            }).then(function() {
                window.location.replace("../enlaces/restauranteCliente.html");
            })
        } else {
            swal("ERROR. La calificacion no se cargo");
        }
    })
}

function CalificarCocinero() {
    localStorage.setItem("idEmpleado", $("#atomadin").val());
    window.location.replace("../enlaces/calificaciones.html");
}

function CalificarCervecero() {
    localStorage.setItem("idEmpleado", $("#ddaroli").val());
    window.location.replace("../enlaces/calificaciones.html");
}

function CalificarBartender() {
    localStorage.setItem("idEmpleado", $("#fsaiegh").val());
    window.location.replace("../enlaces/calificaciones.html");
}