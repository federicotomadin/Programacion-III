window.onload = function() {
    let usuario = localStorage.getItem("usuario");
    if (usuario == null) {
        swal('Tiene que loguearse');
        window.location.replace("../enlaces/login.html");
    }
    let funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Login/TraerEmpleado/' + usuario
    });
    funcionAjax.then(function(dato) {
        document.getElementById("usuario").innerHTML = "<p id='Usuario' style='color:white;'><span class='glyphicon glyphicon-user'>" + dato.Usuario + "</span></p>";
    }, function(dato) {});

}

function CerrarSesion() {
    swal({
        title: 'Desea cerrar Sesión la concha de la lora?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero cerrar sesión!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, no deseo cerrar sesión!'
    }).then(function(result) {
        if (result.value) {


            //FALTA AJAX CON SESION - REGISTRAR SU SALIDA
            var funcionAjax = $.ajax({
                method: 'POST',
                url: '../vendor/Login/CerrarSesion',
            });
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal({ 
                        title:'SESION CERRADA',
                        timer: 1000,
                        showConfirmButton: false                                     
                    }).then(function() {
                        localStorage.clear();
                        window.location.replace("../enlaces/login.html");
                    }, function() {
                        swal({ 
                            title:'SESION CERRADA',
                            timer: 1000,
                            showConfirmButton: false });
                    });
                } else if (dato.status == 400) {
                    swal("Hubo un error al cerrar sesión del usuario!");
                }
            }, function(dato) {
                console.log("ERROR en la API " + dato);
            });
        }
    });
}