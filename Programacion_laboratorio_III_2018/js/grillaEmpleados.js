window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Empleado/TraerTodosLosEmpleados"
    });

    funcionAjax.then(function(dato) {
            var stringEmpleados = " ";
            for (var i = 0; i < dato.empleados.length; i++) {
                stringEmpleados += "<tr>";
                stringEmpleados += "<td>" + dato.empleados[i].Nombre + "</td>";
                stringEmpleados += "<td>" + dato.empleados[i].Apellido + "</td>";
                stringEmpleados += "<td>" + dato.empleados[i].Usuario + "</td>";
                stringEmpleados += "<td>" + cambiarIdPorNombreRol(dato.empleados[i].Id_rol) + "</td>";
                stringEmpleados += "<td>" + dato.empleados[i].Sueldo + "</td>";
                stringEmpleados += "<td>" + cambiarHabilitacion(dato.empleados[i].habilitado) + "</td>";
                stringEmpleados += "<td><button id='suspender' class='btn btn-warning' onclick='SuspenderEmpleado(" +
                    dato.empleados[i].id_empleado + ")'>" +
                    "<span class='glyphicon glyphicon-edit'></span>Suspender Empleado</button>" +
                    "<td><button class='btn btn-success' onclick='HabilitarEmpleado(" + dato.empleados[i].id_empleado + ")'>" +
                    "<span class='glyphicon glyphicon-ok'></span >Habilitar Empleado</button>" +
                    "<td><button class='btn btn-danger' onclick='BorrarEmpleado(" + dato.empleados[i].id_empleado + ")'>" +
                    "<span class='glyphicon glyphicon-remove'></span >Borrar Empleado</button>" +
                    "<td><button class='btn btn-info' onclick='VerCantidadOperaciones(" + dato.empleados[i].id_empleado + ")'>" +
                    "<span class='glyphicon glyphicon-play'></span >Cant Operaciones</button>";

                stringEmpleados += "</tr>";
            }
            document.getElementById("empleados").innerHTML = stringEmpleados;
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + dato.empleados);
        });
};

function cambiarIdPorNombreRol(Idrol) {
    switch (Idrol) {
        case IdRol = 1:
            return "Bartender";
        case IdRol = 2:
            return "Cevecero";
        case IdRol = 3:
            return "Cocinero";
        case IdRol = 4:
            return "Mozo";
        case IdRol = 5:
            return "Socio";
        case IdRol = 6:
            return "Cliente";
    }
}

function cambiarHabilitacion(habilitado) {
    switch (habilitado) {
        case habilitado = 1:
            return "Habilitado";
        case habilitado = 0:
            return "No-habilitado";
    }
}

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


function HabilitarEmpleado(idEmpleado) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea habilitar al empleado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero borrarlo!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, cancelar!'
    }).then(function(result) {
        if (result.value) {
            var funcionAjax = $.ajax({
                method: 'POST',
                headers: { token: tokenUsuario },
                url: '../vendor/Empleado/HabilitarElEmpleado/' + idEmpleado,
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal('Empleado habilitado!').then(function() {
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
};

function VerCantidadOperaciones(idEmpleado) {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Empleado/VerOperacionesDelEmpleado/' + idEmpleado,
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Cantidad de Operaciones' + "  " + dato.operacionesEntrada).then(function() {
                // window.location.reload();
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