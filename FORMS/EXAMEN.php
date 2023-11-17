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
    <?php
       $user=SESSION::leer_session('USER');
    ?>
    <div id="container">
        <div id="countdown">Tiempo restante: <span id="timer">0:00</span></div>


    </div>