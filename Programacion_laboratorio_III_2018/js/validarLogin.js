function EnviarDatos() {
    var funcionAjax = $.ajax({
        url: '../vendor/Login/ValidarUsuario',
        type: 'POST',
        dataType: 'json',
        data: { Usuario: $("#Usuario").val(), clave: $("#Clave").val() },
    });

    funcionAjax.then(function(dato) {

        if (dato.status == "200" && dato.tipo == "Socio") {
            swal(
                'USUARIO VÁLIDO!',
                'Usted esta registrado en la base de datos!',
                'success', { button: 'aceptar', }
            ).then(function() {
                console.log(dato);
                localStorage.setItem("hora", dato.hora);
                localStorage.setItem("usuario", dato.Usuario);
                localStorage.setItem("rol", dato.tipo);
                localStorage.setItem("token", dato.token);
                window.location.replace("../enlaces/restaurante.html");
            }, function() {
                swal('Algo inesperado ocurrio');
            });
        } else if (dato.status == "200" && dato.tipo == "Mozo") {
            localStorage.setItem("hora", dato.hora);
            localStorage.setItem("usuario", dato.Usuario);
            localStorage.setItem("rol", dato.tipo);
            localStorage.setItem("token", dato.token);
            swal(
                'USUARIO VÁLIDO!',
                'Usted esta registrado en la base de datos!',
                'success'
            ).then(function() {
                window.location.replace("../enlaces/restauranteMozo.html");
            }, function() {
                swal('Ocurrio algo inesperado!');
            });
        } else if (dato.status == "200" && dato.tipo == "Cocinero") {
            localStorage.setItem("hora", dato.hora);
            localStorage.setItem("usuario", dato.Usuario);
            localStorage.setItem("rol", dato.tipo);
            localStorage.setItem("token", dato.token);
            swal(
                'USUARIO VÁLIDO!',
                'Usted esta registrado en la base de datos!',
                'success'
            ).then(function() {
                window.location.replace("../enlaces/restauranteCocinero.html");
            }, function() {
                swal('Ocurrio algo inesperado!');
            });
        } else if (dato.status == "200" && dato.tipo == "Bartender") {
            localStorage.setItem("hora", dato.hora);
            localStorage.setItem("usuario", dato.Usuario);
            localStorage.setItem("rol", dato.tipo);
            localStorage.setItem("token", dato.token);
            swal(
                'USUARIO VÁLIDO!',
                'Usted esta registrado en la base de datos!',
                'success'
            ).then(function() {
                window.location.replace("../enlaces/restauranteBartender.html");
            }, function() {
                swal('Ocurrio algo inesperado!');
            });
        } else if (dato.status == "200" && dato.tipo == "Cervecero") {
            localStorage.setItem("hora", dato.hora);
            localStorage.setItem("usuario", dato.Usuario);
            localStorage.setItem("rol", dato.tipo);
            localStorage.setItem("token", dato.token);
            swal(
                'USUARIO VÁLIDO!',
                'Usted esta registrado en la base de datos!',
                'success'
            ).then(function() {
                window.location.replace("../enlaces/restauranteCervecero.html");
            }, function() {
                swal('Ocurrio algo inesperado!');
            });
        } else if (dato.status == "400") {
            swal('USUARIO INCORRECTO!',
                'Revise su usuario y/o su contraseña',
                'warning').then(function() {
                location.reload();
            });
        } else if (dato.status == "401") {
            swal('USUARIO INHABILITADO!',
                'Comuniquese con su administrador!',
                'warning');
        }
    }, function(dato) {
        alert(console.log(dato));
        console.log("ERROR" + dato);
    });
}

function Registrarme() {
    location.reload();
    window.location.replace("../enlaces/registrar.html");
}