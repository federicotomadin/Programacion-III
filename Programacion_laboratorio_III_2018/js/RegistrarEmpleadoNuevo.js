function RegistrarEmpleado() {
    var tokenUsuario = localStorage.getItem("token");
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
        } else {
            swal("No se pudo registrar el usuario " + dato.status);
        }
    }, function(dato) {
        swal("ERROR. Hubo un problema con registrar el administrador " + dato);
    });
}