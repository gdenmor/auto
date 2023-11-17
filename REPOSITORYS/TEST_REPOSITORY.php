<?php
    AUTOLOAD::AutoLoad();

    class TEST_REPOSITORY{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from EXAMEN");
            $resultado->execute();

            $i=0;
            $array=null;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idExamen=$tuplas->idExamen;
                $fechahora=$tuplas->fechahora;
                $Intentos=TRY_REPOSITORY::IntentosdeUnExamen($idExamen);
                $Preguntas=PREGUNTA_REPOSITORY::PreguntasdeUnExamen($idExamen);
                $Usuarios=TEST_REPOSITORY::UsuariosEXAMEN($idExamen);
                $Examen=new TEST($idExamen,$fechahora,$Intentos,$Usuarios,$Preguntas);
                $array[]=$Examen;
                $i++;
            }

            

            return $array;
        }
        public static function DeleteById($idExamen){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->exec("DELETE from EXAMEN where idExamen=$idExamen");

        }
        public static function UpdateById($idExamen,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $fechahora=$objetoActualizado->getFechahora();
            $idUser=$objetoActualizado->getUser()->getId();
            $resultado=$conexion->exec("UPDATE EXAMEN set idUser=upper('$idUser'), fechahora='$fechahora' where idExamen= '$idExamen'");
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();

            $fechahora=$objeto->fecha;

            $resultado=$conexion->exec("INSERT INTO EXAMEN (fechahora) values ('$fechahora')");
        }

        public static function FindBy($idExamen) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM EXAMEN WHERE idExamen=:idExamen");
        
            $resultado->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);

            $resultado->execute();
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $idExamen=$tuplas->idExamen;
                    $fechahora=$tuplas->fechahora;
                    $Intentos=TRY_REPOSITORY::IntentosdeUnExamen($idExamen);
                    $Preguntas=PREGUNTA_REPOSITORY::PreguntasdeUnExamen($idExamen);
                    $Usuarios=TEST_REPOSITORY::UsuariosEXAMEN($idExamen);
                    $Examen=new TEST($idExamen,$fechahora,$Intentos,$Usuarios,$Preguntas);
                    
                }
            }
        
            return $Examen;
        }

        public static function UsuariosEXAMEN($idExamen){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT U.*
                                        FROM USUARIO U
                                        JOIN INTENTO I ON U.id = I.id
                                        JOIN EXAMEN E ON I.idExamen = E.idExamen
                                        where E.idExamen=:idExamen
                                        ");
            $resultado->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);
            $resultado->execute();

            $i=0;
            $array=null;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id=$tuplas->id;
                $usuario=$tuplas->nombre;
                $contrasena=$tuplas->contraseña;
                $rol=$tuplas->rol;
                $validado=$tuplas->validado;
                $User=new USER($id,$usuario,$contrasena,$rol,$validado);
                $array[$i]=$User;
                $i++;
            }

            

            return $array;
        }

        /*public static function ExamenesUsuario($idUser){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("SELECT * from EXAMEN
                                        where idUser=:idUser
                                        ");
            $resultado->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $resultado->execute();

            $i=0;
            $array=null;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id=$tuplas->idExamen;
                $fechahora=$tuplas->fechahora;
                $idUser=$tuplas->idUser;
                $usuarios=TEST_REPOSITORY::UsuariosEXAMEN($id);
                $preguntas=PREGUNTA_REPOSITORY::PreguntasdeUnExamen($id);
                $intentos=TRY_REPOSITORY::IntentosdeUnUsuario($idUser);
                $Examen=new TEST($id,$fechahora,$intentos,$usuarios,$preguntas);
                $array[]=$Examen;
                $i++;
            }

            

            return $array;

        }*/

        public static function ExamenesUsuario($idUser){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("SELECT * from examen_user
                                        where user_id=:user_id
                                        ");
            $resultado->bindParam(':user_id', $idUser, PDO::PARAM_INT);
            $resultado->execute();

            $i=0;
            $array=null;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id=$tuplas->examen_id;
                $idUser=$tuplas->user_id;
                $Examen=TEST_REPOSITORY::FindBy($id);
                $User=USER_REPOSITORY::FindBy($idUser);
                $Examen_User=new ExamenUser($Examen,$User);
                $array[$i]=$Examen_User;
                $i++;
            }

            

            return $array;
        }

        public static function insertExamen_pregunta($idexamen,$idpregunta){
            $conexion=CONEXION::AbreConexion();


            $resultado=$conexion->exec("INSERT INTO examen_pregunta values ($idexamen,$idpregunta)");
        }



    }
?>