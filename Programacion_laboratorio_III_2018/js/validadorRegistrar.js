$(document).ready(function() {

    $("#RegistrarForm").bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-zoom-in'
        },

        fields: {
            Nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre del administrador es requerido'
                    }
                }
            },
            Apellido: {
                validators: {
                    notEmpty: {
                        message: 'El nombre del administrador es requerido'
                    }
                }
            },
            Usuario: {
                validators: {
                    notEmpty: {
                        message: 'El mail del usuario es requerido'
                    },
                    emailAddress: {
                        message: 'El mail ingresado no es válido'
                    }
                }
            },
            Clave: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    }
                }
            },
            Rol: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    }
                }
            },
            Sueldo: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    }
                }
            },
            Habilitado: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerida'
                    }
                }
            },
            repetirClave: {
                validators: {
                    notEmpty: {
                        message: 'Este campo no puede estar vacío'
                    }
                }
            }
        }
    });


});