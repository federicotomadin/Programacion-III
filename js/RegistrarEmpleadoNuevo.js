function ValidarRol() {
    if ($("#Rol").val() == "Cliente") {
        $("#sueldo").attr('disabled', 'disabled');
    }
}



function RegistrarEmpleado() {
    var tokenUsuario = localStorage.getItem("token");

    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    var contrasenia = $("#clave").val();
    var repetirContrasenia = $("#clave2").val();
    if (!regex.test(contrasenia)) {
        swal("La contraseña debe tener una mayuscula, una minustcula y un numero");
        return;
    }
    var funcionAjax = $.ajax({
        method: "POST",
        url: "../vendor/Empleado/IngresarEmpleado",
        headers: { token: tokenUsuario },
        data: {
            Nombre: $("#nombre").val(),
            Apellido: $("#apellido").val(),
            Usuario: $("#usuario").val(),
            Clave: $("#clave").val(),
            Rol: $("#Rol").val(),
            Sueldo: $("#sueldo").val(),
            Habilitado: $("#habilitado").val()
        }
    });



    funcionAjax.then(function(dato) {
            if (dato.status == 200) {
                swal(
                    'USUARIO REGISTRADO',
                    'Su usuario fue registrado correctamente en la base de datos!',
                    'success'
                ).then(function() {
                    window.location.replace("../enlaces/restaurante.html");
                }, function() {
                    swal("Ocurrio algo inesperado!");
                });
            } else if (dato.status == 402) {
                swal("Hay campos vacios en el formulario ERROR " + dato.status);
            }
        },
        function(dato) {
            swal("ERROR. Hubo un problema al registrar " + dato);
        });

}

function RegistrarCliente() {
    var funcionAjax = $.ajax({
        method: "POST",
        url: "../vendor/Cliente/IngresarCliente",
        data: {
            Nombre: $("#nombre").val(),
            Apellido: $("#apellido").val(),
            Usuario: $("#usuario").val(),
            clave: $("#clave").val()
        }
    })
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal(
                'USUARIO REGISTRADO',
                'Su usuario fue registrado correctamente!',
                'success'
            ).then(function() {
                window.location.replace("../enlaces/login.html");
            }, function() {
                swal("Ocurrio algo inesperado!");
            });
        } else if (dato.status == 402) {
            swal("Hay campos vacios en el formulario ERROR " + dato.status);
        }
    }, function(dato) {
        swal("ERROR. Hubo un problema al registrar " + dato.status);
    });
}