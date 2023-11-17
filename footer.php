<footer id="footer">
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
                                
                            ?>
                            <div class="padre">
                                <div class="grupo-redes">
                                    <div class="redes">
                                        <img src="../Autoescuela/IMAGES/pegatinas-coches-motos-logo-instagram.png">
                                        <p>@gabrieldeniamoreno</p>
                                    </div>
                                    <div class="redes">
                                        <img src="../Autoescuela/IMAGES/twitter.png">
                                        <span>@gabrieldeniamoreno</span>
                                    </div>
                                    <div class="redes">
                                        <img src="../Autoescuela/IMAGES/tiktok.png">
                                        <span>@gabrieldeniamoreno</span>
                                    </div>
                                </div>
                                <div class="iframe">
                                        <iframe frameborder="0" scrolling="no" 
                                        marginheight="0" marginwidth="0" 
                                        src="https://maps.google.com/maps?width=100%25&amp;
                                        height=600&amp;hl=es&amp;q=Ja%C3%A9n+(Mi%20nombre%20de%20egocios)&amp;
                                        t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                        <a href="https://www.gps.ie/car-satnav-gps/">GPS devices</a>
                                        </iframe>
                                </div>
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
                                
                            ?>
                                <div class="padre">
                                    <div class="grupo-redes">
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/pegatinas-coches-motos-logo-instagram.png">
                                            <p>@gabrieldeniamoreno</p>
                                        </div>
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/twitter.png">
                                            <span>@gabrieldeniamoreno</span>
                                        </div>
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/tiktok.png">
                                            <span>@gabrieldeniamoreno</span>
                                        </div>
                                    </div>
                                    <div class="iframe">
                                        <iframe frameborder="0" scrolling="no" 
                                        marginheight="0" marginwidth="0" 
                                        src="https://maps.google.com/maps?width=100%25&amp;
                                        height=600&amp;hl=es&amp;q=Ja%C3%A9n+(Mi%20nombre%20de%20egocios)&amp;
                                        t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                        <a href="https://www.gps.ie/car-satnav-gps/">GPS devices</a>
                                        </iframe>
                                    </div>
                                </div>
                                <?php
                            }
                            
                        }

                        if($rol == "ADMINISTRADOR")
                        {
                            ?>
                                <div class="padre">
                                    <div class="grupo-redes">
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/pegatinas-coches-motos-logo-instagram.png">
                                            <p>@gabrieldeniamoreno</p>
                                        </div>
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/twitter.png">
                                            <span>@gabrieldeniamoreno</span>
                                        </div>
                                        <div class="redes">
                                            <img src="../Autoescuela/IMAGES/tiktok.png">
                                            <span>@gabrieldeniamoreno</span>
                                        </div>
                                    </div>
                                    <div class="iframe">
                                        <iframe frameborder="0" scrolling="no" 
                                            marginheight="0" marginwidth="0" 
                                            src="https://maps.google.com/maps?width=100%25&amp;
                                            height=600&amp;hl=es&amp;q=Ja%C3%A9n+(Mi%20nombre%20de%20egocios)&amp;
                                            t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                            <a href="https://www.gps.ie/car-satnav-gps/">GPS devices</a>
                                            </iframe>
                                    </div>
                                </div>
                                
                            <?php
                        }



                    }
                

?>
        
</footer>