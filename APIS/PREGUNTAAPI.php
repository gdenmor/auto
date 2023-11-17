<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET["id"];
        $Pregunta=PREGUNTA_REPOSITORY::FindBy($id);
        $Preg=$Pregunta->toJSON();
        echo $Preg;
    }
    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $cuerpo = file_get_contents("php://input");
        $id=$_GET["id"];
        $Pregunta=json_decode($cuerpo);
        PREGUNTA_REPOSITORY::UpdateById($id,$Pregunta);
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET["id"];
        PREGUNTA_REPOSITORY::DeleteById($id);
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $Pregunta=json_decode($objeto);
        PREGUNTA_REPOSITORY::Insert($Pregunta);
    }


?>