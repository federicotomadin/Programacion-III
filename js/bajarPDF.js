var json2pdf;

function bajarPDF(json) {

    espacioX = 29;
    espacioY = 7;
    cantLineasPorPag = 27;


    json2pdf = new jsPDF('l', 'mm', [297, 210]);


    json2pdf.setFont("helvetica");
    //header
    json2pdf.setFontSize(10);
    json2pdf.setFontType("bold");
    cont = 0;
    $.each(json[0], function(key, value) {
        json2pdf.text(espacioX * cont + espacioX / 3, espacioY, key);
        cont++;
    });


    //data
    json2pdf.setFontSize(5);
    json2pdf.setFontType("regular");
    var fila = 1;
    $.each(json, function(key, value) {
        col = 0;
        $.each(json[key], function(key2, value2) {
            json2pdf.text(espacioX * col + espacioX / 3, fila * espacioY + espacioY, String(value2));
            col++;

        })
        fila++;
        if (cantLineasPorPag <= fila) {
            json2pdf.addPage()
            fila = 1;
        }
    })


    json2pdf.save('pdf.pdf');
}