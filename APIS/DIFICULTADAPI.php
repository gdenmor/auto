<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET["id"];
        $Dificultad=DIFICULTAD_REPOSITORY::FindBy($id);
        $Dif= $Dificultad->toJSON();
        echo $Dif;
    }
    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $cuerpo = file_get_contents("php://input");
        $id=$_GET["id"];
        $Dificultad=json_decode($cuerpo);
        DIFICULTAD_REPOSITORY::UpdateById($id,$Dificultad);
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET["id"];
        DIFICULTAD_REPOSITORY::DeleteById($id);
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $Dificultad=json_decode($objeto);
        DIFICULTAD_REPOSITORY::Insert($Dificultad);
    }


?>