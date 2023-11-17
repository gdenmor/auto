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
    <div id="container-alumno">
        <?php
            $user= SESSION::leer_session('USER');
            echo '  <div id="padre-alumno">
                    <div>
                        <div id="rol">'
                            .$user->getRol().'
                        </div> 
                        <div>'
                            .$user->getUsername().'
                            <br> 
                            <b>AUTOESCUELA PROYECTO</b>
                            <input id="User" type="hidden" value="'.$user->getId().'">
                        </div>
                    </div>
                </div>';

        ?>
        

        <div id="historico">
            <table id="tabla-alumno">
                <thead>
                    <tr>
                        <th>FECHA</td>
                        <th>ID EXAMEN</th>
                        <th>CALIFICACIÓN</th>
                        <th>VISUALIZAR</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       $user=SESSION::leer_session('USER');
                       $Intentos=TRY_REPOSITORY::IntentosdeUnUsuario($user->getId());
                       if ($Intentos==null){

                       }else{
                            for ($i= 0; $i < count($Intentos); $i++) {
                                echo '<input class="idIntento" type="hidden" value="'.$Intentos[$i]->getIdTry().'">';
                                echo'<tr class="fila">
                                        <td>'.$Intentos[$i]->getfecha().'</td>
                                        <td>'.$Intentos[$i]->getIdExamen().'</td>
                                        <td>'.$Intentos[$i]->getCalificacion().'/10'.'</td>
                                        <td><input type="button" value="VISUALIZAR"></td>
                                    </tr>';
                            }
                       }


                    ?>
                </tbody>
            </table>
        </div>




    </div>
