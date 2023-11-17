<?php
    //SELECT
    require_once "../HELPERS/AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET["id"];
        $Categoria=CATEGORIA_REPOSITORY::FindBy($id);
        $Cat=$Categoria->toJSON();
        echo $Cat;
    }
    //ACTUALIZA
    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        $cuerpo = file_get_contents("php://input");
        $obj=json_decode($cuerpo);
        $id=$_GET["id"];
        CATEGORIA_REPOSITORY::UpdateById($id,$obj);
    }
    //BORRA
    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET["id"];
        CATEGORIA_REPOSITORY::DeleteById($id);
        echo "Categoría borrada";
    }
    //AÑADE
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $objeto=file_get_contents("php://input");
        $Categoria=json_decode($objeto);
        CATEGORIA_REPOSITORY::Insert($Categoria);
        echo "Categoría insertada";
    }


?>