<?php
    AUTOLOAD::AutoLoad();

    class PREGUNTA_REPOSITORY{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from PREGUNTA");
            $resultado->execute();

            $idPregunta=null;

            $array=null;

            $i=0;

            $idUser=0;



            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idPregunta=$tuplas->idPregunta;
                $idCategoria=$tuplas->idcategoria;
                $Categoria=CATEGORIA_REPOSITORY::FindBy($idCategoria);
                $idDificultad=$tuplas->iddificultad;
                $Dificultad=DIFICULTAD_REPOSITORY::FindBy($idDificultad);
                $enunciado=$tuplas->enunciado;
                $rep1=$tuplas->rep1;
                $rep2=$tuplas->rep2;
                $rep3=$tuplas->rep3;
                $correcta=$tuplas->correcta;
                $url=$tuplas->url;
                $tipo=$tuplas->tipo;
                $Pregunta=new PREGUNTA($idPregunta,$Categoria,$Dificultad,$enunciado,$rep1,$rep2,$rep3,$correcta,$url,$tipo);
                $array[$i]=$Pregunta;
                $i++;
            }
            return $array;
        }
        public static function DeleteById($idPregunta){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->exec("DELETE from PREGUNTA where idPregunta=$idPregunta");

        }
        public static function UpdateById($idPregunta,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $idCategoria=$objetoActualizado->getCategoria()->getId();
            $idDificultad=$objetoActualizado->getDificultad()->getId();
            $enunciado=$objetoActualizado->getEnunciado();
            $rep1=$objetoActualizado->getr1();
            $rep2=$objetoActualizado->getrep2();
            $rep3=$objetoActualizado->getrep3();
            $correcta=$objetoActualizado->getcorrecta();
            $url=$objetoActualizado->getUrl();
            $tipo=$objetoActualizado->getTipo();


            $resultado=$conexion->exec("UPDATE PREGUNTA set idcategoria=upper('$idCategoria'), iddificultad='$idDificultad', enunciado=upper('$enunciado'), rep1=upper('$rep1'), rep2=upper('$rep2'), rep3=upper('$rep3'), correcta=upper('$correcta'), url=upper('$url'), tipo=upper('$tipo') where idPregunta= '$idPregunta'");
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();

            $idCategoria=$objeto->getCategoria()->getId();
            $idDificultad=$objeto->getDificultad()->getId();
            $enunciado=$objeto->getEnunciado();
            $rep1=$objeto->getr1();
            $rep2=$objeto->getrep2();
            $rep3=$objeto->getrep3();
            $correcta=$objeto->getcorrecta();
            $url=$objeto->getUrl();
            $tipo=$objeto->getTipo();

            $resultado=$conexion->exec("INSERT INTO PREGUNTA (idcategoria, iddificultad, enunciado ,rep1,rep2,rep3,correcta,url,tipo) values ('$idCategoria','$idDificultad',upper('$enunciado'),upper('$rep1'),upper('$rep2'),upper('$rep3'),upper('$correcta'),upper('$url'),upper('$tipo'))");
        }

        public static function FindBy($idPregunta) {
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM PREGUNTA WHERE idPregunta=:idPregunta");
            $resultado->bindParam(':idPregunta', $idPregunta, PDO::PARAM_INT);
            $resultado->execute();
        
            $Pregunta = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $idPregunta=$tuplas->idPregunta;
                    $idCategoria=$tuplas->idcategoria;
                    $Categoria=CATEGORIA_REPOSITORY::FindBy($idCategoria);
                    $idDificultad=$tuplas->iddificultad;
                    $Dificultad=DIFICULTAD_REPOSITORY::FindBy($idDificultad);
                    $enunciado=$tuplas->enunciado;
                    $rep1=$tuplas->rep1;
                    $rep2=$tuplas->rep2;
                    $rep3=$tuplas->rep3;
                    $correcta=$tuplas->correcta;
                    $url=$tuplas->url;
                    $tipo=$tuplas->tipo;
                    $Pregunta=new PREGUNTA($idPregunta,$Categoria,$Dificultad,$enunciado,$rep1,$rep2,$rep3,$correcta,$url,$tipo);
                }
            }
        
            return $Pregunta;
        }

        public static function PreguntasdeUnExamen($idExamen){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from examen_pregunta where examen_id=:idExamen");
            $resultado->bindParam(':idExamen', $idExamen, PDO::PARAM_INT);
            $resultado->execute();

            $idPregunta=null;

            $array=null;

            $i=0;

            $idUser=0;



            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $idPregunta=$tuplas->pregunta_id;
                $Pregunta=PREGUNTA_REPOSITORY::FindBy($idPregunta);
                $array[]=$Pregunta;
                $i++;
            }
            return $array;
        }

        
    }
?>