<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET["id"];
        $Usuario=USER_REPOSITORY::FindBy($id);
        $User=$Usuario->toJSON();
        echo $User;
    }
    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $cuerpo = file_get_contents("php://input");
        $id=$_GET["id"];
        $usuario=json_decode($cuerpo);
        USER_REPOSITORY::UpdateById($id,$usuario);
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET["id"];
        USER_REPOSITORY::DeleteById($id);
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $user=json_decode($objeto);
        USER_REPOSITORY::Insert($user);
    }


?>