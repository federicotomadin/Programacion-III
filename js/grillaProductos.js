window.onload = function() {
    var funcionAjax = $.ajax({
        method: "GET",
        url: "../vendor/Productos/TraerTodosLosProductos"
    });
    funcionAjax.then(function(dato) {
            var stringProductos = " ";
            for (var i = 0; i < dato.productos.length; i++) {
                stringProductos += "<tr>";
                stringProductos += "<td>" + dato.productos[i].Nombre + "</td>";
                stringProductos += "<td>" + dato.productos[i].Descripcion + "</td>";
                stringProductos += "<td>" + dato.productos[i].Precio + "</td>";
                stringProductos += "<td align='center'><button data-toggle='modal' data-target='#modalForm' class='btn btn-warning' onclick='Editar(" + dato.productos[i].id_producto + ")'>" +
                    "<span class='glyphicon glyphicon-edit'></span>Editar</button>";
                stringProductos += "<td align='center'><button class='btn btn-remove' onclick='Borrar(" + dato.productos[i].id_producto + ")'>" +
                    "<span class='glyphicon glyphicon-remove'></span>Borrar</button>";
                stringProductos += "<td align='center'><button data-toggle='modal' data-target='#modalFormAgregar' class='btn btn-success' onclick='InsertarProducto(" + dato.productos[i].id_producto + ")'>" +
                    "<span class='glyphicon glyphicon-plus'></span>Agregar</button>";
                stringProductos += "</tr>";
            }
            document.getElementById("productos").innerHTML = stringProductos;

        },
        function(dato) {
            alert("ERROR no se pudieron cargar los pedidos" + dato);
        });
};

function Editar(IdProducto) {
    var funcionAjax = $.ajax({
        method: 'GET',
        url: '../vendor/Productos/TraerProducto/' + IdProducto
    })
    funcionAjax.then(function(dato) {
        localStorage.setItem("IdProducto", dato.id_producto);
        $('#inputNombre').val(dato.Nombre);
        $('#inputDescripcion').val(dato.Descripcion);
        $('#inputPrecio').val(dato.Precio);
    })
}

function ModificarProducto() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea modificar el producto?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero modificarlo!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, cancelar!'
    }).then(function(result) {
        var objJson = {
            "Nombre": $('#inputNombre').val(),
            "Descripcion": $('#inputDescripcion').val(),
            "Precio": parseInt($('#inputPrecio').val())
        }
        if (result.value) {
            var funcionAjax = $.ajax({
                method: 'POST',
                headers: { token: tokenUsuario },
                url: '../vendor/Productos/ModificarProducto/' + localStorage.getItem("IdProducto"),
                data: JSON.stringify(objJson),
                contentType: "application/json",
                dataType: "json"
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal('Producto Modificado!').then(function() {
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
    });
};


function Borrar(IdProducto) {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea borrar el producto?',
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
                method: 'DELETE',
                headers: { token: tokenUsuario },
                url: '../vendor/Productos/BorrarProducto/' + IdProducto
            })
            funcionAjax.then(function(dato) {
                if (dato.status == 200) {
                    swal('Producto Borrado!').then(function() {
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
    });
}

function InsertarProducto() {
    var tokenUsuario = localStorage.getItem("token");

}

function AgregarProducto() {
    var tokenUsuario = localStorage.getItem("token");
    swal({
        title: 'Desea agregar el producto?',
        type: 'warning',
        showCancelButton: true,
        showCloseButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, quiero agregarlo!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'No, cancelar!'
    }).then(function(result) {
        var objJson = {
            "Nombre": $('#Nombre').val(),
            "Descripcion": $('#Descripcion').val(),
            "Precio": $('#Precio').val(),
            "id_rol": $('#Roles').val()
        }
        if (result.value && ValidarCamposAgregar(objJson)) {
            $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>');
            sleep(2000);
            var funcionAjax = $.ajax({
                method: 'POST',
                headers: { token: tokenUsuario },
                url: '../vendor/Productos/InsertarProducto',
                data: JSON.stringify(objJson),
                contentType: "application/json",
                dataType: "json"
            })

            funcionAjax.then(function(dato) {
                setTimeout(5);
                if (dato.status == 200) {
                    swal('Producto Agregado!').then(function() {
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
    })
}


function ValidarCamposAgregar(objJson) {
    if (objJson.Nombre.trim() == '') {
        alert('Ingrese un nombre');
        $('#Nombre').focus();
        $('#Nombre').css("border-bottom-color", "#E81A1E");
        $('#Descripcion').css("border-bottom-color", "#929090");
        $('#Precio').css("border-bottom-color", "#929090");
        return false;
    } else if (objJson.Descripcion.trim() == '') {
        alert('Ingrese una descriptcion');
        $('#Descripcion').focus();
        $('#Descripcion').css("border-bottom-color", "#E81A1E");
        $('#Nombre').css("border-bottom-color", "#929090");
        $('#Precio').css("border-bottom-color", "#929090");
        return false;
    } else if (objJson.Precio.trim() == '') {
        alert('Ingrese un precio');
        $('#Precio').focus();
        $('#Precio').css("border-bottom-color", "#E81A1E");
        $('#Descripcion').css("border-bottom-color", "#929090");
        $('#Nombre').css("border-bottom-color", "#929090");
        return false;
    }
    return true;
}

function sleep(milisegundos) {
    var comienzo = new Date().getTime();
    while (true) {
        if ((new Date().getTime() - comienzo) > milisegundos)
            break;
    }
}