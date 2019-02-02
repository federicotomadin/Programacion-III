function SuspenderEmpleado(idEmpleado) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea suspender al empleado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero suspenderlo!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, cancelar!'
    }).then(function(result) {
        if (result.value) {
            var funcionAjax = $.ajax({
                method: 'POST',
                headers: { token: tokenUsuario },
                url: '../vendor/Empleado/SuspenderElEmpleado/' + idEmpleado,
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal('Empleado suspendido!').then(function() {
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
    });
}


function ElegirMozoParaCalificarRemus() {

    localStorage.setItem("idEmpleado", $("#aremus").val());
    window.location.replace("../enlaces/calificaciones.html");

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