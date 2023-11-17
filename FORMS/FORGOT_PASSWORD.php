<?php
AUTOLOAD::AutoLoad();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cambiar= isset($_POST['user']) ? $_POST['cambiar'] : "";
    if ($cambiar){
        $usuario = isset($_POST['user']) ? strtoupper(str_replace(" ", "", $_POST['user'])) : "";
        $password = isset($_POST['password']) ? strtoupper(str_replace(" ", "", $_POST['password'])) : "";
        $repeat_password = isset($_POST['repeat_password']) ? strtoupper(str_replace(" ", "", $_POST['repeat_password'])) : "";
        $existe = false;
        $mensajeError = "";
        $user = "";

        $users = USER_REPOSITORY::FindAll();

            if (is_array($users) && count($users) > 0) {
                for ($i = 0; $i < count($users); $i++) {
                    if ($users[$i]->getUsername() == $usuario) {
                        $existe = true;
                        $user = new User($users[$i]->getId(), $users[$i]->getUsername(), $users[$i]->getPassword(), $users[$i]->getRol(),$users[$i]->getvalidado());
                    }
                }

                if ($existe) {
                    if ($password == $repeat_password) {
                        if ((strlen($usuario) > 0 && strlen($usuario) <= 45) && (strlen($password) > 0 && strlen($password) <= 45)) {
                            $user->setPassword($password);
                            $user->setUsername($usuario);
                            $id = $user->getId();
                            USER_REPOSITORY::UpdateById2($id, $user);
                            header("Location: ?menu=inicio");
                        } else {
                            $mensajeError = "Debe de tener entre 1 y 45 caracteres tanto el usuario como la contraseña";
                        }
                    } else {
                        $mensajeError = "Las contraseñas no coinciden";
                    }
                } else {
                    $mensajeError = "No existe este usuario";
                }
            } else {
                $mensajeError = "No existe esta cuenta";
            }

            $mensajeError = '<p id="mensaje_error">' . $mensajeError . '</p>';
        }
}



?>

    <div id="container-forgot">
        <div id="enlace-forgot">
            <h2 id="letralink-forgot"><u>¿Has olvidado tú contraseña?</u></h2>
        </div>
        <form method="post" id="form">
            <div class="campos-forgot">
                <div>
                    <label> Introduzca su usuario: </label>
                </div>
                <div>
                    <input type="text" name="user" size="45">
                </div>
            </div>
            <div class="campos-forgot">
                <div>
                    <label> Introduzca su nueva contraseña: </label>
                </div>
                <div>
                    <input type="password" name="password" size="45">
                </div>
            </div>
            <div class="campos-forgot">
                <div>
                    <label> Repita la contraseña de nuevo: </label>
                </div>
                <div>
                    <input type="password" name="repeat_password" size="45">
                </div>
            </div>
            <div id="cambiar-forgot">
                <input name="cambiar" type="submit" value="CAMBIAR CONTRASEÑA">
            </div>
        </form>
        <div id="error">
            <?php
            if (isset($mensajeError) && $mensajeError !== "") {
                echo $mensajeError;
            }

            ?>
        </div>
    </div>

