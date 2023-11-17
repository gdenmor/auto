<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
        if ($id != '') {
            $Examen = TEST_REPOSITORY::FindBy($id);

            if ($Examen!=null) {
                $Ex = new stdClass();
                $Ex->id = $id;
    
                $Preguntas = $Examen->getPreguntas();
                $Preguntass = [];
    
                foreach ($Preguntas as $pregunta) {
                    $respuesta1 = $pregunta->getr1();
                    $respuesta2= $pregunta->getrep2();
                    $respuesta3=$pregunta->getrep3();
                    $respuestas = [$respuesta1,$respuesta2,$respuesta3];
                    $respuestasArray=[];

                    $i=1;
        
                    foreach ($respuestas as $respuesta) {
                        $respuestasArray[] = [
                            "respuesta".$i => $respuesta
                        ];
                        $i++;
                    }
        
                    $Preguntass[] = [
                        "id" => $pregunta->getId(),
                        "Categoria" => $pregunta->getCategoria(),
                        "Dificultad" => $pregunta->getDificultad(),
                        "enunciado" => $pregunta->getEnunciado(),
                        "imagen" => $pregunta->getUrl(),
                        "tipo" => $pregunta->getTipo(),
                        "respuestas" => $respuestasArray
                ];
            }
        
            $Ex->preguntas = $Preguntass;
            }
        
            echo json_encode(["Examen" => $Ex]);

        }
        
    }

    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $_PUT = array();
        $cuerpo = file_get_contents("php://input");
        $id=$_GET["id"];
        parse_str($Examen, $_PUT);
        $Examen=json_decode($cuerpo);
        $_PUT['id'] = $id;
        TEST_REPOSITORY::UpdateById($id,$Examen);
        echo "Pregunta actualizada";
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $_DELETE = array();
        $id=$_GET["id"];
        parse_str($id, $_DELETE);
        $_DELETE['id'] = $id;
        TEST_REPOSITORY::DeleteById($_DELETE['id']);
        echo "Pregunta borrada";
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $Intento=json_decode($objeto);
        TEST_REPOSITORY::Insert($Intento);
        echo "Pregunta insertada";

    }

?>