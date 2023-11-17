<?php
    AUTOLOAD::AutoLoad();

    class DIFICULTAD_REPOSITORY{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from DIFICULTAD");
            $resultado->execute();

            $idDificultad=null;

            $array=null;

            $i=0;

            $nombre="";


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idDificultad=$tuplas->idDificultad;
                $nombre=$tuplas->nombre;
                $Dificultad=new DIFICULTAD($idDificultad,$nombre);
                $array[$i]=$Dificultad;
                $i++;
            }

            

            return $array;
        }
        public static function DeleteById($idDificultad){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->exec("DELETE from DIFICULTAD where idDificultad=$idDificultad");

        }
        public static function UpdateById($idDificultad,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objetoActualizado->getNombre();

            $resultado=$conexion->exec("UPDATE DIFICULTAD set nombre=upper('$nombre') where idDificultad='$idDificultad'");
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();

            $nombre=$objeto->getNom();

            $resultado=$conexion->exec("INSERT INTO DIFICULTAD (nombre) values (upper('$nombre'))");
        }

        public static function FindBy($idDificultad) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM DIFICULTAD WHERE idDificultad=:idDificultad");
            $resultado->bindParam(':idDificultad', $idDificultad, PDO::PARAM_INT);
            $resultado->execute();
        
            $Categoria = null;
        
            if ($resultado) {
                $tupla = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tupla) {
                    $idCategoria=$tupla->idDificultad;
                    $nombre=$tupla->nombre;
                    $Categoria=new DIFICULTAD($idCategoria,$nombre);
                }
            }
        
            return $Categoria;
        }

        public static function IDDificultad($nombre){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM DIFICULTAD WHERE nombre=:nombre");
            $resultado->bindParam(':nombre', $nombre, PDO::PARAM_INT);
            $resultado->execute();
        
            $Dificultad = null;
        
            if ($resultado) {
                $tupla = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tupla) {
                    $idDificultad=$tupla->idDificultad;
                    $Dificultad=new DIFICULTAD($idDificultad,$nombre);
                }
            }

            return $Dificultad;
        }

    }
?>