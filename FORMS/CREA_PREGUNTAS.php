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

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $enunciado=$_POST['enunciado'];
        $rep1=$_POST['rep1'];
        $rep2=$_POST['rep2'];
        $rep3=$_POST['rep3'];
        $correcta=0;
        if (isset($_POST["respuestas"])) {
            $correcta = $_POST["respuestas"];
        }

        $archivo=$_FILES['archivo']['name'];

        $rutaCompleta = "";
        $tipo="";

        if ($archivo!=""){
            $temporal=$_FILES['archivo']['tmp_name'];
            $rutaCompleta = "IMAGES/" . $archivo;
            if (move_uploaded_file($temporal, $rutaCompleta)) {
            
            }else{
                $rutaCompleta="";
            }
            $tipo=$_FILES['archivo']['type'];
        }

        $categoria="";

        if (isset($_POST["categoria"])) {
            $categoria = $_POST["categoria"];
        }

        $dificultad="";
        if (isset($_POST["dificultad"])) {
            $dificultad = $_POST["dificultad"];
        }

        $Categoria=CATEGORIA_REPOSITORY::IDCategoria($categoria);
        $Dificultad=DIFICULTAD_REPOSITORY::IDDificultad($dificultad);

        $Pregunta=new PREGUNTA(0,$Categoria,$Dificultad,$enunciado,$rep1,$rep2,$rep3,$correcta,$rutaCompleta,$tipo);

        PREGUNTA_REPOSITORY::Insert($Pregunta);

    }

?>

<div id="contenedor-crea">

<div id="pregunta-creada">
    <form id="form" method="post" enctype="multipart/form-data">
        <div>
            <select name="categoria">
                <?php
                    $categorias=CATEGORIA_REPOSITORY::FindAll();
                    if ($categorias!=null) {
                        for ($i= 0; $i < count($categorias); $i++) {
                            echo '<option value="'.$categorias[$i]->getNombre().'">'.$categorias[$i]->getNombre().'</option>';
                        }
    
                    }

                ?>
            </select>
        </div>
        <div>
            <select name="dificultad">
                <?php
                    $Dificultad=DIFICULTAD_REPOSITORY::FindAll();
                    if ($Dificultad!=null){
                        for ($i= 0; $i < count($Dificultad); $i++) {
                            echo "<option>".$Dificultad[$i]->getNom()."</option>";
                        }
                    }


                ?>
            </select>
        </div>
        <div id="imagenpregunta">
            <input type="file" name="archivo" id="imagenpreguntas">
        </div>
        <div id="enunciadopregunta">
            <input type="text" name="enunciado" placeholder="Introduzca la pregunta" id="enunc">
        </div>
        <div>
            <div class="respuesta">
                <input type="radio" name="respuestas" value="1"><input type="text" name="rep1" class="respuestass">
            </div>
            <div class="respuesta">
                <input type="radio" name="respuestas" value="2"><input type="text" name="rep2" class="respuestass">
            </div>
            <div class="respuesta">
                <input type="radio" name="respuestas" value="3"><input type="text" name="rep3" class="respuestass">
            </div>
        </div>
        <div id="botoncrear">
            <input type="submit" value="CREAR PREGUNTA" id="boton">
        </div>
    </form>
</div>

</div>