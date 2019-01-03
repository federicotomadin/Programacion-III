$(document).ready(function() {
    $('#reg_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese un nombre'
                    }
                }
            },
            apellido: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese un apellido'
                    }
                }
            },

            usuario: {
                validators: {
                    stringLength: {
                        min: 6,
                    },
                    notEmpty: {
                        message: 'Por favor ingrese un usuario'
                    }
                }
            },

            password: {
                validators: {
                    identical: {
                        field: 'confirmPassword',
                        message: 'Ingrese contraseña'
                    },
                    notEmpty: {
                        message: 'Por favor ingrese una clave'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'La contraseña y su confirmacino no son iguales'
                    },
                    notEmpty: {
                        message: 'Por favor confirme la clave'
                    }
                }
            },
            sueldo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ingrese un sueldo'
                    },

                }
            }
        },
    })


    .on('success.form.bv', function(e) {
        $('#success_message').slideDown({
            opacity: "show"
        }, "slow"); // Do something ...
        $('#reg_form').data('bootstrapValidator').resetForm();

        // Prevent form submission
        e.preventDefault();

        // Get the form instance
        var $form = $(e.target);

        // Get the BootstrapValidator instance
        var bv = $form.data('bootstrapValidator');
        $('.submit-button', $this).attr('disabled', !formIsValid);
        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function(result) {
            console.log(result);
        }, 'json');
    });
});