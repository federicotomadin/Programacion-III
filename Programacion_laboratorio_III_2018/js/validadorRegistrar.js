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
                        message: 'El campo nombre  es requerido'
                    }
                }
            },
            Apellido: {
                validators: {
                    notEmpty: {
                        message: 'El campo apellido es requerido'
                    }
                }
            },
            Usuario: {
                validators: {
                    notEmpty: {
                        message: 'El campo usuario es requerido'
                    },
                }
            },
            Clave: {
                validators: {
                    notEmpty: {
                        message: 'El campo clave es requerido'
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
                        message: 'El campo Sueldo es requerido'
                    }
                }
            },
            Habilitado: {
                validators: {
                    notEmpty: {
                        message: 'El campo habilitado es requerido'
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