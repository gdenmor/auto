<?php
    class EXAMEN_USER_REPOSITORY{
        public static function EXAMEN_USUARIO($idexamen,$iduser){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->exec("INSERT INTO EXAMEN_USER values ('$idexamen','$iduser')");
        }
    }

?>