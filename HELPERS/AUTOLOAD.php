<?php
    class AUTOLOAD{
        public static function AutoLoad() {
            spl_autoload_register('autocargador');
        }

    }

    function autocargador($Clase){
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/ENTITYS" . "/" . $Clase .".php")) {
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/ENTITYS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/APIS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/APIS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/CSS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/CSS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/FORMS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/FORMS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/HELPERS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/HELPERS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/HTML" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/HTML" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/IMAGES" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/IMAGES" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/JS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/JS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/REPOSITORYS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/AUTOESCUELA/REPOSITORYS" . "/" . $Clase .".php";
        }
    }

    AUTOLOAD::AutoLoad();


    
?>