function MesaMasUsadaModal() {
    $('#mesaMasUsada').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}

function MesaMenosUsadaModal() {
    $('#mesaMenosUsada').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}

function MesaMasFacturoModal() {
    $('#mesaMasFacturo').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}

function MesaMenosFacturoModal() {
    $('#mesaMenosFacturo').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}

function FacturaMayorImporteModal() {
    $('#facturaMayorImporte').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}

function FacturaMenorImporteModal() {
    $('#facturaMenorImporte').modal('show');

    $.fn.datepicker.dates.es = { days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"], daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"], daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"], today: "Hoy", monthsTitle: "Meses", clear: "Borrar", weekStart: 1, format: "dd/mm/yyyy" };
    $('.fj-date').datepicker({
        language: 'es',
        format: "yyyy/mm/dd",
        autoclose: true
    });
}


function VerMesaMasUsada() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: 'POST',
        headers: { token: tokenUsuario },
        data: { "fechaDesde": $('#fechaDesde').val(), "fechaHasta": $('#fechaHasta').val() },
        url: '../vendor/Pedidos/TraerMesaMasUsada'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa más usada' + "  -  " + dato.IdMesa,
                "Cantidad de Operaciones" + " - " + dato.Cantidad
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato);
    });
}

function VerMesaMenosUsada() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: 'POST',
        headers: { token: tokenUsuario },
        data: { "fechaDesde": $('#fechaDesdeMesaMenosUsada').val(), "fechaHasta": $('#fechaHastaMesaMenosUsada').val() },
        url: '../vendor/Pedidos/TraerMesaMenosUsada'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.CodigoMesa
                //"Cantidad de Operaciones" + "  " + dato.Cantidad
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.status);
    });
}

function VerMesaMasFacturo() {
    var tokenUsuario = localStorage.getItem("token");
    var funcionAjax = $.ajax({
        method: 'POST',
        headers: { token: tokenUsuario },
        data: { "fechaDesde": $('#fechaDesdeMesaMasFacturo').val(), "fechaHasta": $('#fechaHastaMesaMasFacturo').val() },
        url: '../vendor/Pedidos/TraerMesaQueMasFacturo'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.Mesa + " - ",
                "Importe" + " " + dato.Importe
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.status);
    });
}

function VerMesaMenosFacturo() {
    var funcionAjax = $.ajax({
        method: 'POST',
        data: { "fechaDesde": $('#fechaDesdeMesaMenosFacturo').val(), "fechaHasta": $('#fechaHastaMesaMenosFacturo').val() },
        url: '../vendor/Pedidos/TraerMesaQueMenosFacturo'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Mesa' + " - " + dato.Mesa + " - ",
                "Importe" + " " + dato.Importe
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.status);
    });
}

function VerFacturaMenorImporte() {
    var funcionAjax = $.ajax({
        method: 'POST',
        data: { "fechaDesde": $('#fechaDesdeFacturaMenorImporte').val(), "fechaHasta": $('#fechaHastaFacturaMenorImporte').val() },
        url: '../vendor/Pedidos/TraerFacturaMenorImporte'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Factura' + " - " + dato.facturaMenor + " - ",
                "Mesa" + " " + dato.mesa
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.status);
    });
}

function VerFacturaMayorImporte() {
    var funcionAjax = $.ajax({
        method: 'POST',
        data: { "fechaDesde": $('#fechaDesdeFacturaMayorImporte').val(), "fechaHasta": $('#fechaHastaFacturaMayorImporte').val() },
        url: '../vendor/Pedidos/TraerFacturaMayorImporte'
    });
    funcionAjax.then(function(dato) {
        if (dato.status == 200) {
            swal('Factura' + " - " + dato.Importe + " - ",
                "Mesa" + " " + dato.Mesa
            ).then(function() {
                window.location.reload();
            }, function() {
                swal("OCURRIO ALGO INESPERADO!");
            });
        } else if (dato.status == 400) {
            swal("Hubo un error!");
        }
    }, function(dato) {
        console.log("ERROR en la API " + dato.status);
    });
}