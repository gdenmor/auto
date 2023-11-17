<header id="header">
            <?php
                SESSION::CreaSesion();

                
                if(SESSION::estaLogueado('USER'))
                {
                    $usuario =SESSION::leer_session('USER');

                        $rol = $usuario->getRol();
                        if($rol == "ALUMNO")
                        {
                            if ($_GET['menu']=="examen"||$_GET['menu']=="visualizacion"){

                            }else{
                                if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                    $logout=isset($_POST['logout'])?$_POST['logout']: "";
                                    if ($logout){
                                        SESSION::Cerrar_Sesion();
                                    }
                                }
                            ?>
                                <div id="menu">
                                    <nav id="nav-alumno">
                                        <div class="elementos-profesor" id="loginalumno">
                                            <img src="IMAGES/LOGO.png">
                                        </div>
                                        <div class="elementos-alumno">
                                            <a class="link1"><input type="button" class="boton-profesor" value="GENERAR EXAMENES"></input></a>
                                            <div class="elementos_desplegable-alumno">
                                                <div class="elementos-alumno">
                                                    <a class="dificultad"><b>FÁCIL</b></a>
                                                </div>
                                                <div class="elementos-alumno">
                                                    <a class="dificultad"><b>MEDIO</b></a>
                                                </div>
                                                <div class="elementos-alumno">
                                                    <a class="dificultad"><b>DIFÍCIL</b></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementos-alumno">
                                            <a class="link1"><input type="button" class="boton-profesor" value="REPETIR EXAMEN"></input></a>
                                            <div class="elementos_desplegable-alumno">
                                                <?php 
                                                    $user=SESSION::leer_session('USER');
                                                    $ExamenesUsuario=TEST_REPOSITORY::ExamenesUsuario($user->getId());
                                                    if ($ExamenesUsuario!=null){
                                                        for ($i= 0; $i < count($ExamenesUsuario); $i++) {
                                                            echo
                                                                '<div class="elementos-alumno">
                                                                    <a class="Examenes"><b>'."Examen"." ".$ExamenesUsuario[$i]->getExamen()->getIds().'</b></a>
                                                                </div>';
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <form method="post">
                                        <div class="elementos-alumno">
                                            <a class="link2"><input type="submit" name="logout" class="boton-profesor" value="CERRAR SESIÓN"></input></a>
                                        </div>
                                    </form>
                                    </nav>
                                </div>
                            
                            <?php
                        }
                        }

                        if($rol == "PROFESOR")
                        {
                            if ($_GET['menu']=="examen"||$_GET['menu']=="visualizacion"){
                            ?>
                            
                            <?php
                            }else{
                                if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                    $logout=isset($_POST['logout'])?$_POST['logout']: "";
                                    if ($logout){
                                        SESSION::Cerrar_Sesion();
                                    }
                                }
                            ?>
                                <div id="menu-profesor">
                                    <nav id="nav-profesor">
                                        <div class="elementos-profesor" id="loginprofesor">
                                            <img src="IMAGES/LOGO.png">
                                        </div>
                                        <div class="elementos-profesor">
                                            <a class="link1"><input type="button" class="boton-profesor" value="GENERAR EXAMENES CON PILA DE PREGUNTAS"></input></a>
                                        </div>
                                        <div class="elementos-profesor">
                                            <a class="link1" href="http://localhost/AUTOESCUELA/index.php?menu=preguntas"><input type="button" class="boton-profesor" value="CREAR PREGUNTAS"></input></a>
                                        </div>
                                    <form method="post">
                                        <div id="elementos-profesor">
                                            <a class="link2"><input name="logout" type="submit" class="boton-profesor" value="CERRAR SESIÓN"></input></a>
                                        </div>
                                    </form>
                                    </nav>
                                </div>
                                <?php
                            }
                            
                        }

                        if($rol == "ADMINISTRADOR")
                        {
                            ?>
                            <?php
                                if ($_SERVER["REQUEST_METHOD"]=="POST"){
                                    $logout=isset($_POST['logout'])?$_POST['logout']: "";;
                                    if ($logout=="CERRAR SESIÓN"){
                                        SESSION::Cerrar_Sesion();
                                    }
                                }
                            ?>
                                <nav id="navegacion">
                                    <div class="elementos-profesor">
                                        <a class="link1" href="http://localhost/AUTOESCUELA/index.php?menu=admin"><img src="../AUTOESCUELA/IMAGES/LOGO.png"></a>
                                    </div>
                                    <div class="elementos-profesor">
                                        <a class="link1" href="http://localhost/AUTOESCUELA/index.php?menu=crea"><input class="boton-profesor" type="button" value="CREAR USUARIOS"></a>
                                    </div>
                                    <div class="elementos-profesor">
                                        <a class="link1" href="http://localhost/AUTOESCUELA/index.php?menu=borra"><input class="boton-profesor" type="button" value="BORRAR USUARIOS"></a>
                                    </div>
                                    <form method="post">
                                    <div id="elementos-profesor">
                                        <input id="logout" type="submit" value="CERRAR SESIÓN" name="logout">
                                    </div>
                                    </form>
                                </nav>
                            <?php
                        }

                        if (isset($_GET['menu']) && $_GET['menu'] === 'inicio') {
                            session_destroy();
                            header("Location: http://localhost/AUTOESCUELA/index.php");
                            exit();
                        }



                    }
                

?>
        </nav>
    </header>