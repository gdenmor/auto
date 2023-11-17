<?php
    SESSION::CreaSesion();
    if (SESSION::estaLogueado('USER')==false){
        SESSION::Cerrar_Sesion();
    }else{
        $usuario=SESSION::leer_session('USER');
        if ($usuario->getRol()!="ALUMNO"){
            SESSION::Cerrar_Sesion();
        }
    }
?>
<div id="practica">
    
</div>