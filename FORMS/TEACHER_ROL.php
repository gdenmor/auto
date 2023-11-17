<?php
    SESSION::CreaSesion();
    if (SESSION::estaLogueado('USER')==false){
        SESSION::Cerrar_Sesion();
    }else{
        $usuario=SESSION::leer_session('USER');
        if ($usuario->getRol()!="PROFESOR"){
            SESSION::Cerrar_Sesion();
        }
    }
?>

<div>
    <?php
        $user= SESSION::leer_session('USER');
        echo '<div>
                    <div>
                        <div id="rol">'
                            .$user->getRol().'
                        </div> 
                        <div>'
                            .$user->getUsername().'
                            <br> 
                            <b>AUTOESCUELA PROYECTO</b>
                            <input id="idUser" type="hidden" value="'.$user->getId().'">
                        </div>
                    </div>
                </div>';

    ?>
    <div id="container-profesor">
        <div id="historico">
            <table id="tabla-profesor"border="1">
                <thead>
                    <tr>
                        <th>NOMBRE ALUMNO</td>
                        <th>ID EXAMEN</th>
                        <th>CALIFICACIÓN</th>
                        <th>ID INTENTO</td>
                        <th>VISUALIZACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $user=SESSION::leer_session('USER');
                       $Intentos=TRY_REPOSITORY::IntentosAlumno();
                       if ($Intentos==null){

                       }else{
                            for ($i= 0; $i < count($Intentos); $i++) {
                                echo '<input class="idIntento" type="hidden" value="'.$Intentos[$i]->getIdTry().'">';
                                echo'<tr class="fila">
                                        <td>'.$Intentos[$i]->getUser()->getUsername().'</td>
                                        <td>'.$Intentos[$i]->getIdExamen().'</td>
                                        <td>'.$Intentos[$i]->getCalificacion().'/10'.'</td>
                                        <td>'.$Intentos[$i]->getIdTry().'</td>
                                        <td><input type="button" value="VISUALIZAR"></td>
                                    </tr>';
                            }
                       }


                    ?>
                </tbody>
            </table>
        </div>