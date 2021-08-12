<?php

class conexion{


    public static function conectar(){
     
        $nombreServidor="127.0.0.1";
        $baseDatos="lista";
        $usuarioServidor="root";
        $password="";

        try {

            $objConexion = new PDO('mysql:host='.$nombreServidor.';dbname='.$baseDatos.';',$usuarioServidor,$password,array(
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            )); //instanciar conexion
            $objConexion->exec("set names utf8");

        } catch (Exception $e) {
            $objConexion=$e;
        }
        
        return $objConexion;

    }
}