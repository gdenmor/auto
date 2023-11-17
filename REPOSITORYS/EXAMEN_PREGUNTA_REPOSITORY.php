<?php
    class EXAMEN_PREGUNTA_REPOSITORY{
        public static function verNumeroExamenes(){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT COUNT(idExamen) as ids FROM EXAMEN");
            $resultado->execute();
        
            $nums=0;
        
            if ($resultado) {
                $tupla = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tupla) {
                    $nums=$tupla->ids;
                }
            }
        
            return $nums;
        }

        public static function GeneraExamenAleatorio($preguntas,$numexamenes){
            $conexion=CONEXION::AbreConexion();
            $idExamen=rand(1,$numexamenes);
            for ($i=0;$i<count($preguntas);$i++) {
                $idPregunta=$preguntas[$i]->id;

                $resultado=$conexion->exec("INSERT INTO EXAMEN_PREGUNTA values ('$idExamen','$idPregunta')");
            }
        }

        public static function insert($idpregunta,$idexamen){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->exec("INSERT INTO EXAMEN_PREGUNTA (examen_id,pregunta_id) values ('$idexamen','$idpregunta')");
            
        }

        
    }
?>