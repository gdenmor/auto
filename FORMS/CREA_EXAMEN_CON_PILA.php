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
<div id="pila">
    <div class="tabla-container">
    <table border="1" style="text-align: center;">
        <thead>
            <th>ENUNCIADO</th>
            <th>REP1</th>
            <th>REP2</th>
            <th>REP3</th>
            <th>CORRECTA</th>
            <th>CATEGORIA ID</th>
            <th>CATEGORIA NOMBRE</th>
            <th>DIFICULTAD ID</th>
            <th>DIFICULTAD NOMBRE</th>
            <th>URL</th>
            <th>TIPO</th>
            <th>MARCADA</th>
        </thead>
        <tbody>
            <?php
                $preguntas=PREGUNTA_REPOSITORY::FindAll();
                for ($i= 0;$i<count($preguntas);$i++) {
                    echo '<tr>
                            <input class="ids" type="hidden" value='.$preguntas[$i]->getId().'>
                            <td>'.$preguntas[$i]->getEnunciado().'</td>
                            <td>'.$preguntas[$i]->getr1().'</td>
                            <td>'.$preguntas[$i]->getrep2().'</td>
                            <td>'.$preguntas[$i]->getrep3().'</td>
                            <td>'.$preguntas[$i]->getcorrecta().'</td>
                            <td>'.$preguntas[$i]->getCategoria()->getId().'</td>
                            <td>'.$preguntas[$i]->getCategoria()->getNombre().'</td>
                            <td>'.$preguntas[$i]->getDificultad()->getId().'</td>
                            <td>'.$preguntas[$i]->getDificultad()->getNom().'</td>
                            <td>'.$preguntas[$i]->getUrl().'</td>
                            <td>'.$preguntas[$i]->getTipo().'</td>
                            <td><input type="checkbox"></td>';
                }
            ?>
        </tbody>
    </table>
    </div>
    <div class="tabla-container">
    <table border="1">
        <thead>
            <th>USUARIO</th>
            <th>MARCADO</th>
        </thead>
        <tbody>
            <?php
                $usuarios=USER_REPOSITORY::alumnos();
                for ($i= 0;$i<count($usuarios);$i++) {
                    echo '<tr>
                            <input class="idus" type="hidden" value="'.$usuarios[$i]->getId().'">
                            <td>'.$usuarios[$i]->getUsername().'</td>
                            <td><input type="checkbox"></td>
                            </tr>';
                }
            ?>
        </tbody>
    </table>
    </div>
    <div>
        <input id="pila-container" type="button" value="CREAR">
    </div>
</div>