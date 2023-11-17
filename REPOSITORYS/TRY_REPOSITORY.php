<?php
    AUTOLOAD::AutoLoad();

    class TRY_REPOSITORY{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from INTENTO");

            $resultado->execute();

            $idIntento=null;

            $array=null;

            $i=0;

            $idUser=0;



            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idIntento=$tuplas->idIntento;
                $idUser=$tuplas->id;
                $User=USER_REPOSITORY::FindBy($idUser);
                $JSONRespuestas=$tuplas->JSONRespuestas;
                $fechaRealizado=$tuplas->fecha;
                $idExamen=$tuplas->idExamen;
                $calificacion=$tuplas->calificacion;
                $Intento=new TRYS($idIntento,$User,$fechaRealizado,$JSONRespuestas,$idExamen,$calificacion);
                $array[$i]=$Intento;
                $i++;
            }

            

            return $array;
        }
        public static function DeleteById($idIntento){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->exec("DELETE from INTENTO where idIntento=$idIntento");

        }
        public static function UpdateById($id,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $idUser=$objetoActualizado->getUser()->getId();
            $fechaRealizado=$objetoActualizado->getfecha();
            $JSONRespuestas=$objetoActualizado->getJsonFileRespuestas();
            $idExamen=$objetoActualizado->getExamen()->getId();
            $calificacion=$objetoActualizado->getCalificacion();

            $resultado=$conexion->exec("UPDATE INTENTO set id=upper('$idUser'), fecha='$fechaRealizado', JSONRespuestas='upper($JSONRespuestas'), idExamen='$idExamen',calificacion='$calificacion' where idIntento= '$id'");
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();

            $idUser=(int)$objeto->idUser;
            $fechaRealizado=$objeto->fecha;
            $JSONRespuestas=json_encode($objeto->JSON);
            $idExamen=$objeto->idExamen;
            $calificacion=$objeto->calificacion;

            $resultado=$conexion->exec("INSERT INTO INTENTO (id, fecha, JSONRespuestas,idExamen,calificacion) values ('$idUser','$fechaRealizado','$JSONRespuestas','$idExamen','$calificacion')");
        }

        public static function FindBy($idIntento) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM INTENTO WHERE idIntento= :idIntento");
            $resultado->bindParam(':idIntento', $idIntento, PDO::PARAM_INT);
            
            $resultado->execute();



            $Intento=null;


        
            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                    $idIntento=$tuplas->idIntento;
                    $idUser=$tuplas->id;
                    $User=USER_REPOSITORY::FindBy($idUser);
                    $JSONRespuestas=$tuplas->JSONRespuestas;
                    $fechaRealizado=$tuplas->fecha;
                    $idExamen=$tuplas->idExamen;
                    $calificacion=$tuplas->calificacion;
                    $Intento=new TRYS($idIntento,$User,$fechaRealizado,$JSONRespuestas,$idExamen,$calificacion);
            }
            return $Intento;
        }

        public static function IntentosdeUnExamen($idExamen) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM INTENTO WHERE idExamen= :idExamen");
            $resultado->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);
            $resultado->execute();
        
            $User = null;
            $array=null;

            $i=0;
        
            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idIntento=$tuplas->idIntento;
                $idUser=$tuplas->id;
                $User=USER_REPOSITORY::FindBy($idUser);
                $JSONRespuestas=$tuplas->JSONRespuestas;
                $fechaRealizado=$tuplas->fecha;
                $idExamen=$tuplas->idExamen;
                $calificacion=$tuplas->calificacion;
                $Intento=new TRYS($idIntento,$User,$fechaRealizado,$JSONRespuestas,$idExamen, $calificacion);
                $array[$i]=$Intento;
                $i++;
            }
        
            return $array;
        }

        public static function IntentosdeUnUsuario($idUsuario) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM INTENTO WHERE id= :idUsuario");
            $resultado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $resultado->execute();
        
            $User = null;
            $array=null;

            $i=0;
        
            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idIntento=$tuplas->idIntento;
                $idUser=$tuplas->id;
                $User=USER_REPOSITORY::FindBy($idUser);
                $JSONRespuestas=$tuplas->JSONRespuestas;
                $fechaRealizado=$tuplas->fecha;
                $idExamen=$tuplas->idExamen;
                $calificacion=$tuplas->calificacion;
                $Intento=new TRYS($idIntento,$User,$fechaRealizado,$JSONRespuestas,$idExamen, $calificacion);
                $array[$i]=$Intento;
                $i++;
            }
        
            return $array;
        }

        public static function IntentosAlumno() {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare('SELECT i.idIntento,u.id,i.JSONRespuestas,i.fecha,i.idExamen,i.calificacion from INTENTO i inner join USUARIO u on i.id=u.id where u.rol="ALUMNO"');
            $resultado->execute();
        
            $User = null;
            $array=null;

            $i=0;
        
            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idIntento=$tuplas->idIntento;
                $idUser=$tuplas->id;
                $User=USER_REPOSITORY::FindBy($idUser);
                $JSONRespuestas=$tuplas->JSONRespuestas;
                $fechaRealizado=$tuplas->fecha;
                $idExamen=$tuplas->idExamen;
                $calificacion=$tuplas->calificacion;
                $Intento=new TRYS($idIntento,$User,$fechaRealizado,$JSONRespuestas,$idExamen, $calificacion);
                $array[$i]=$Intento;
                $i++;
            }
        
            return $array;
        }
    }
?>