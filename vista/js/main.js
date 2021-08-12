$(document).ready(function() {


    $("#archivo").on("change", function() {

        alert("hola");
        var ruta = document.getElementById("archivo").files[0];
        alert(ruta);
        //console.log(ruta.file[0].mozFullPath);


        var objData = new FormData();
        objData.append("ruta", ruta);

        $.ajax({
            url: "control/controlArchivo.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                if (respuesta != "" || respuesta != null) {

                    cargarDatos(respuesta);
                }
            }






        })










    })


    function cargarDatos(columnas) {
        alert("Esto es Cargar Datos")
        console.log(columnas);
        var mensaje = "CargarTabla";
        var objData = new FormData();

        objData.append("mensaje", mensaje);

        $.ajax({
            url: "control/controlArchivo.php",
            type: "post",
            dataType: "json",
            data: objData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                $("#cuerpo").html("");
                $("#cabecera").html("");
                var concatenar = "";
                var cantidadColumnas = columnas.length + 1;
                console.log(respuesta);
                var cantidadFilas = respuesta.length;
                var cantidadCiclos = Number(cantidadColumnas) * (cantidadFilas);
                var fila = Number(cantidadCiclos) / Number(cantidadFilas);
                alert(cantidadCiclos);

                columnas.forEach(columnasTabla);

                function columnasTabla(item, index) {
                    concatenar += '<th>' + item + '</th>';

                }
                $("#cabecera").html(concatenar);

                concatenar = "";

                var contador = 0;
                var contador2 = 0;

                for (let index = 0; index < cantidadCiclos; index++) {

                    if (contador == 0) {
                        concatenar += '<tr>';

                    } else if (contador == fila) {
                        concatenar += '</tr>';
                        contador2++;
                        contador = 0;

                    } else {
                        concatenar += '<td>' + respuesta[contador2][contador] + '</td>';


                    }






                    contador++;










                }

                $("#cuerpo").html(concatenar);











            }






        })




    }


})