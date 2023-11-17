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
        <div id="divcrea">
        <table border="1">
            <thead>
                <th>USUARIO</th>
                <th>CONTRASEÑA</th>
                <th>ROL</th>
                <th>ACEPTAR/RECHAZAR</th>
            </thead>
            <tbody id="cuerpo">
                <tr>
                    <td><input id="usuario" type="text"></td>
                    <td><input id="contrasena" type="text"></td>
                    <td><select><option>ALUMNO</option><option>PROFESOR</option></select></td>
                    <td><input type="button" value="+" id="aceptar"></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>