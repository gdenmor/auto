<?php
    //AÑADE
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $preguntas=json_decode($objeto);
        $preguntass=$preguntas->preguntass;
        $usuarios=$preguntas->usuarios;

        TEST_REPOSITORY::Insert($preguntas);

        $idExamen=EXAMEN_PREGUNTA_REPOSITORY::verNumeroExamenes();
        for ($i= 0;$i<count($preguntass);$i++){
            $pregunta=$preguntass[$i];

            TEST_REPOSITORY::insertExamen_pregunta($idExamen,$preguntass[$i]->id);
        }

        for ($i=0;$i<count($usuarios);$i++){ 
            $usuario=$usuarios[$i];
            EXAMEN_USER_REPOSITORY::EXAMEN_USUARIO($idExamen,$usuario->id);
        }
        
    }


?>