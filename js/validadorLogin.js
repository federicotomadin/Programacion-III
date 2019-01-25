$(document).ready(function () {

    $('#loginInicioForm').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-zoom-in'
        },

        fields: {
            Usuario: {
                validators: {
                    notEmpty: {
                        message: 'El usuario es requerido'
                    },
                   emailAddress: {
                        message: 'El usuario ingresado no es válido'
                    }
                }
            },
            clave: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    }
                }
            }
        }
    });


});