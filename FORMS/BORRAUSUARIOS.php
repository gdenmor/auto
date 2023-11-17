<?php
    SESSION::CreaSesion();
    if (SESSION::estaLogueado('USER')==false){
        SESSION::Cerrar_Sesion();
    }else{
        $usuario=SESSION::leer_session('USER');
        if ($usuario->getRol()!="ADMINISTRADOR"){
            SESSION::Cerrar_Sesion();
        }
    }


?>
    <div>
        <div id="divtablaborra">
        <table border="1">
            <thead>
                <th>ID</th>
                <th>USUARIO</th>
                <th>CONTRASEÑA</th>
                <th>ROL</th>
                <th>ACEPTAR/RECHAZAR</th>
            </thead>
            <tbody id="cuerpo">
                <?php
                    $Users=USER_REPOSITORY::FindAllnoAdmin();
                    if ($Users!=null){
                        for ($i=0;$i<count($Users);$i++) {
                            $User=$Users[$i];

                            echo'<tr>
                                    <td> '.$User->getId() . '</td>
                                    <td> ' .$User->getUsername(). '</td>
                                    <td>'. $User->getPassword(). '</td>
                                    <td>  <select> <option> ALUMNO </option> <option> PROFESOR </option> </td>
                                    <td><form method="post" class="user_form"><input id="aceptar" class="acepta" name="aceptar'.$i.'" type="submit" value="BORRAR"></form> </td>
                                </tr>';
                        }
                    }


                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>