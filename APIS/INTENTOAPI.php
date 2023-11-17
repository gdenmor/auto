<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET["id"];
        $Intento=TRY_REPOSITORY::FindBy($id);
        if ($Intento!=null){
            $Int= $Intento->toJSON();
            echo $Int;
        }
        
    }
    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $cuerpo = file_get_contents("php://input");
        $Pregunta=json_decode($cuerpo);
        TRY_REPOSITORY::UpdateById($id,$Pregunta);
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $_DELETE = array();
        $id=$_GET["id"];
        parse_str($id, $_DELETE);
        $_DELETE['id'] = $id;
        TRY_REPOSITORY::DeleteById($_DELETE['id']);
        echo "Pregunta borrada";
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $intento=json_decode($objeto);
        $calificacion=0;
        $respuestas=json_decode($intento->JSON);
        $preguntas=PREGUNTA_REPOSITORY::PreguntasdeUnExamen($intento->idExamen);
        for ($i=0;$i<count($preguntas);$i++){
            if ($preguntas[$i]->getcorrecta()==$respuestas[$i]){
                $calificacion=$calificacion+1;
            }
        }

        $intento->calificacion=$calificacion;

        TRY_REPOSITORY::Insert($intento);

    }


?>