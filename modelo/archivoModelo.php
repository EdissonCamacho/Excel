<?php

require_once "conexion.php";


class archivoModelo
{


    public static function mdlMostrarArchivo($ruta)
    {




        $mensaje = "";
        $nombreArchivo = $ruta['name'];
        $extension = substr($nombreArchivo, -4);
        $rutaArchivo = "../vista/archivos/" . "archivo"  . $extension;





        if (move_uploaded_file($ruta["tmp_name"], $rutaArchivo)) {

            $mensaje = "ok";
        }

        if ($mensaje == "ok") {
            $rutaLrctor = "../vista/archivos/archivo.csv";

            $fp = fopen($rutaLrctor, "r");
            $contador = 0;
            $columnas = [];
            $filas = [];
            $concatenar = "";
            $concatenar2 = "";


            while ($data = fgetcsv($fp, 1000, ";")) {
                $num = count($data);

                if ($contador == 0) {
                    $columnas = $data;
                }

                $contador++;
            }
            $contador = 0;

            foreach ($columnas as $key => $value) {

                $valorColumna = $value;

                $concatenar .= "$valorColumna varchar(30),";
                if (count($columnas) == $contador + 1) {
                    $concatenar2 .= $valorColumna;
                } else {
                    $concatenar2 .= "$valorColumna" . ",";
                }

                $contador++;
            }

            $objConectar = conexion::conectar()->prepare("DROP TABLE IF EXISTS excel");
            if ($objConectar->execute()) {
                $consulta = "Create table excel(id int not null auto_increment," . $concatenar . "primary key(id)) ";

                $objConectar = conexion::conectar()->prepare($consulta);
                if ($objConectar->execute()) {
                    $objConectar = "";
                    $objConectar = conexion::conectar()->prepare("LOAD DATA LOCAL INFILE '" . $rutaLrctor . "' INTO TABLE excel FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES (" . $concatenar2 . ") ");
                    if ($objConectar->execute()) {
                        $mensaje="ok";
                    }
                }
            } else {
                $consulta = "Create table excel(id int not null auto_increment," . $concatenar . "primary key(id)) ";

                $objConectar = conexion::conectar()->prepare($consulta);
                if ($objConectar->execute()) {
                    $objConectar = "";
                    $objConectar = conexion::conectar()->prepare("LOAD DATA LOCAL INFILE '" . $rutaLrctor . "' INTO TABLE excel FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES (" . $concatenar2 . ") ");
                    if ($objConectar->execute()) {
                        $mensaje="ok";
                    }
                }
            }
            return $columnas;


            



        }
    }


    public static function mdlCargarTabla(){
        $objCargar=conexion::conectar()->prepare("SELECT * FROM excel");
        $objCargar->execute();
        $lista=$objCargar->fetchAll();
        $objCargar=null;
        return $lista;

    }
}
