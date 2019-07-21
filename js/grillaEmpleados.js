function BuscarEmpleado() {
    var funcionAjax = $.ajax({
        type: "GET",
        url: "../vendor/Empleado/TraerTodosLosEmpleadosMenosSocios"
    });



    funcionAjax.then(function(dato) {

            var stringEmpleados = " ";
            var arrayEmpleados = "";

            var palabraBuscada = $('#palabraBuscada').val();

            if (palabraBuscada != "") {
                var nuevoArray = dato.empleados;
                arrayEmpleados = nuevoArray.filter(function(empleado) {
                    return empleado.Nombre.match(palabraBuscada);
                });
            }
            // } else
            // nuevoArray = dato.empleados;
            //  arrayEmpleados = nuevoArray.filter(function(empleado) {
            //     return empleado.Nombre;
            // });

            for (var i = 0; i < arrayEmpleados.length; i++) {
                if (arrayEmpleados[i].habilitado == 1) {
                    stringEmpleados += "<td>" + arrayEmpleados[i].Nombre + "</td>";
                    stringEmpleados += "<td>" + arrayEmpleados[i].Apellido + "</td>";
                    stringEmpleados += "<td>" + arrayEmpleados[i].Usuario + "</td>";
                    stringEmpleados += "<td>" + cambiarIdPorNombreRol(parseInt(arrayEmpleados[i].Id_rol)) + "</td>";
                    stringEmpleados += "<td>" + arrayEmpleados[i].Sueldo + "</td>";
                    stringEmpleados += "<td>" + cambiarHabilitacion(parseInt(arrayEmpleados[i].habilitado)) + "</td>";
                    stringEmpleados += "<td><button id='suspender' class='btn btn-warning' onclick='SuspenderEmpleado(" +
                        arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-edit'></span>Suspender Empleado</button>" +
                        "<td><button class='btn btn-success' onclick='HabilitarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-ok'></span >Habilitar Empleado</button>" +
                        "<td><button class='btn btn-danger' onclick='BorrarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-remove'></span >Borrar Empleado</button>" +
                        "<td><button data-toggle='modal' data-target='#modalCalendario' class='btn btn-info' onclick='TraerModalDeFecha(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-play'></span >Cant Operaciones</button>";
                    stringEmpleados += "</tr>";
                }

                if (arrayEmpleados[i].habilitado == 0 && arrayEmpleados[i].borrado == 0) {
                    stringEmpleados += "<tr>";
                    stringEmpleados += "<td class='filaSuspendida'>" + arrayEmpleados[i].Nombre + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'>" + arrayEmpleados[i].Apellido + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'>" + arrayEmpleados[i].Usuario + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'>" + cambiarIdPorNombreRol(parseInt(arrayEmpleados[i].Id_rol)) + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'>" + arrayEmpleados[i].Sueldo + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'>" + cambiarHabilitacion(parseInt(arrayEmpleados[i].habilitado)) + "</td>";
                    stringEmpleados += "<td class='filaSuspendida'><button id='suspender' class='btn btn-warning' onclick='SuspenderEmpleado(" +
                        arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-edit'></span>Suspender Empleado</button>" +
                        "<td class='filaSuspendida'><button class='btn btn-success' onclick='HabilitarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-ok'></span >Habilitar Empleado</button>" +
                        "<td class='filaSuspendida'><button class='btn btn-danger' onclick='BorrarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-remove'></span >Borrar Empleado</button>" +
                        "<td class='filaSuspendida'><button data-toggle='modal' data-target='#modalCalendario' class='btn btn-info' onclick='TraerModalDeFecha(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-play'></span >Cant Operaciones</button>";
                    stringEmpleados += "</tr>";
                }

                if (arrayEmpleados[i].habilitado == 0 && arrayEmpleados[i].borrado == 1) {
                    stringEmpleados += "<tr>";
                    stringEmpleados += "<td class='filaBorrada'>" + arrayEmpleados[i].Nombre + "</td>";
                    stringEmpleados += "<td class='filaBorrada'>" + arrayEmpleados[i].Apellido + "</td>";
                    stringEmpleados += "<td class='filaBorrada'>" + arrayEmpleados[i].Usuario + "</td>";
                    stringEmpleados += "<td class='filaBorrada'>" + cambiarIdPorNombreRol(parseInt(arrayEmpleados[i].Id_rol)) + "</td>";
                    stringEmpleados += "<td class='filaBorrada'>" + arrayEmpleados[i].Sueldo + "</td>";
                    stringEmpleados += "<td class='filaBorrada'>" + cambiarHabilitacion(parseInt(arrayEmpleados[i].habilitado)) + "</td>";
                    stringEmpleados += "<td class='filaBorrada'><button id='suspender' class='btn btn-warning' onclick='SuspenderEmpleado(" +
                        arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-edit'></span>Suspender Empleado</button>" +
                        "<td class='filaBorrada'><button class='btn btn-success' onclick='HabilitarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-ok'></span >Habilitar Empleado</button>" +
                        "<td class='filaBorrada'><button class='btn btn-danger' onclick='BorrarEmpleado(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-remove'></span >Borrar Empleado</button>" +
                        "<td class='filaBorrada'><button data-toggle='modal' data-target='#modalCalendario' class='btn btn-info' onclick='TraerModalDeFecha(" + arrayEmpleados[i].id_empleado + ")'>" +
                        "<span class='glyphicon glyphicon-play'></span >Cant Operaciones</button>";
                    stringEmpleados += "</tr>";
                }
            }
            document.getElementById("empleados").innerHTML = stringEmpleados;
        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + arrayEmpleados);
        });
}



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
        title: 'Suspender empleado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, suspender!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Cancelar!'
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

function BorrarEmpleado(idEmpleado) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Borrar empleado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Cancelar!'
    }).then(function(result) {
        if (result.value) {
            var funcionAjax = $.ajax({
                method: 'POST',
                headers: { token: tokenUsuario },
                url: '../vendor/Empleado/BorrarElEmpleado/' + idEmpleado,
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal('Empleado borrado!').then(function() {
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
        title: 'Habilitar empleado?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero habilitarlo!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Cancelar!'
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

function TraerModalDeFecha($IdEmpleado) {
    localStorage.setItem("IdEmpleado", $IdEmpleado);

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "dd/mm/yyyy",
        autoclose: true
    });
}

function CerrarModal() {
    $('#fecha').val("");
}

function VerCantidadOperaciones() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: 'POST',
        headers: { token: tokenUsuario },
        data: { IdEmpleado: parseInt(localStorage.getItem("IdEmpleado")), Fecha: $('#fecha').val() },
        url: '../vendor/Empleado/TraerCantidadOperacionesPorFecha'
    })
    funcionAjax.then(function(dato) {
            if (dato.status == 200) {
                swal('Cantidad de Operaciones' + " - " + cambiarIdEmpleadoPorNombre(parseInt(localStorage.getItem("IdEmpleado"))) + "  " + dato.cantidadOperaciones).then(function() {
                    // window.location.reload();
                }, function() {
                    swal("OCURRIO ALGO INESPERADO!");
                });
            } else if (dato.status == 400) {
                swal("Hubo un error!");
            }
        },
        function(dato) {
            console.log("ERROR en la API " + dato);
        });
}


function cambiarIdEmpleadoPorNombre(IdEmpleado) {
    switch (IdEmpleado) {
        case IdEmpleado = 1:
            return "ftomadin";
        case IdEmpleado = 2:
            return "aremus";
        case IdEmpleado = 3:
            return "ddaroli";
        case IdEmpleado = 4:
            return "fsaiegh";
        case IdEmpleado = 12:
            return "atomadin";
        case IdEmpleado = 47:
            return "mreinoso";
    }
}