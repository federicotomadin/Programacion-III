window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Empleado/TraerTodosLosEmpleados"
    });

    funcionAjax.then(function(dato) {
            var empleados = " ";
            for (var i = 0; i < dato.empleados.length; i++) {
                empleados += "<option value=" + dato.empleados[i].id_empleado + ">" + dato.empleados[i].Usuario + "----------" + cambiarIdPorNombreRol(dato.empleados[i].Id_rol) + "</option>";
            }
            $("#SelectEmpleado").html(empleados);

        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + dato.empleados);
        });

};


function cambiarIdPorNombreRol(Idrol) {
    switch (Idrol) {
        case IdRol = 1:
            return 'Bartender';
        case IdRol = 2:
            return Cevecero;
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

function TraerSesiones() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Empleado/VerSesionesDelEmpleado/" + $("#SelectEmpleado").val()
    });

    funcionAjax.then(function(dato) {
            var stringSesiones = " ";
            for (var i = 0; i < dato.sesiones.length; i++) {
                stringSesiones += "<tr>";
                stringSesiones += "<td>" + dato.sesiones[i].fechaIngreso + "</td>";
                stringSesiones += "<td>" + dato.sesiones[i].FechaSalida + "</td>";
                stringSesiones += "</tr>";
            }
            document.getElementById('sesiones').innerHTML = stringSesiones;

        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + dato.sesiones);
        });
};