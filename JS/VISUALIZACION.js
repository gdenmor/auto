window.addEventListener("load",function(){
    var divpreguntas=this.document.getElementsByClassName("OCULTA");
    var contenedor=this.document.getElementById("visualizacion");
    var params=new URLSearchParams(this.window.location.search);
    var id=params.get("id");
    var examen=params.get("examen");
    var j=0;

    this.fetch("../AUTOESCUELA/APIS/INTENTOAPI.php?id="+id)
        .then(x=>x.json())
        .then(y=>{
            debugger;
            const jsonrespuestas=y.JSONrespuestas;
            var respuestas=JSON.parse(jsonrespuestas);
            this.fetch("../AUTOESCUELA/APIS/EXAMENAPI.php?id="+examen)
                .then(x=>x.json())
                .then(y=>{
                    var preguntas = y.Examen.preguntas;


                    mostrarPregunta(divpreguntas, preguntas,contenedor,respuestas);
            
                    muestraBotones(contenedor);

                    var siguiente=this.document.getElementById("siguiente");

                    var anterior=this.document.getElementById("anterior");

                    var divs=this.document.getElementsByClassName("Hola");

                    divs[j].classList.remove("OCULTA");

                    siguiente.addEventListener("click", function () {
                        divs[j].classList.add("OCULTA"); // Oculta la pregunta actual
                        j++;
                        if (j>=preguntas.length){
                            j=0;
                        }
                        divs[j].classList.remove("OCULTA");
                    },false);

                    anterior.addEventListener("click", function () {
                        divs[j].classList.add("OCULTA"); // Oculta la pregunta actual
                        j--;
                        if (j<0){
                            j=preguntas.length-1;
                        }
                        divs[j].classList.remove("OCULTA");
                    },false);
                })
        })


    function mostrarPregunta(divpreguntas,preguntas,contenedor,respuestasJSON) {
        for (let i=0;i<preguntas.length;i++){
            var divpregunta = document.createElement("div");
            var pregunta = preguntas[i];
            var imagen = document.createElement("img");
            if (pregunta.imagen!=null){
                var ruta = "../AUTOESCUELA/" + pregunta.imagen;
                imagen.src = ruta;
            }
            var p = document.createElement("p");
            var enunciado = pregunta.enunciado;
            p.innerHTML = (i + 1) + "." + " " + enunciado;
    
            var divfoto = document.createElement("div");
            var divenunciado = document.createElement("div");
            var divrespuestas = document.createElement("div");
            var rep1 = document.createElement("div");
            var rep2 = document.createElement("div");
            var rep3 = document.createElement("div");
    
            var respuestas = pregunta.respuestas;
    
            var input1 = document.createElement("input");
            input1.setAttribute("type", "radio");
            input1.setAttribute("name", "rep" + i);
    
            var input2 = document.createElement("input");
            input2.setAttribute("type", "radio");
            input2.setAttribute("name", "rep" + i);
    
            var input3 = document.createElement("input");
            input3.setAttribute("type", "radio");
            input3.setAttribute("name", "rep" + i);

            const inputs=[input1,input2,input3];
    
            var prep1 = document.createElement("p");
            prep1.innerHTML = respuestas[0].respuesta1;
    
            var prep2 = document.createElement("p");
            prep2.innerHTML = respuestas[1].respuesta2;
    
            var prep3 = document.createElement("p");
            prep3.innerHTML = respuestas[2].respuesta3;
    
            var dudosa = document.createElement("div");
            var inputdudosa = document.createElement("input");
            var lbl = document.createElement("label");
            lbl.innerHTML = "DUDOSA: ";
            inputdudosa.setAttribute("type", "checkbox");
            inputdudosa.setAttribute("name", "dudosa" + i);
            inputdudosa.disabled=true;
    
            dudosa.appendChild(inputdudosa);
            dudosa.appendChild(lbl);

            dudosa.style.width="20%";
    
            rep1.appendChild(input1);
            rep2.appendChild(input2);
            rep3.appendChild(input3);
            rep1.appendChild(prep1);
            rep2.appendChild(prep2);
            rep3.appendChild(prep3);
            rep1.style.display="flex";
            rep1.style.marginBottom="0.5%";
            rep2.style.display="flex";
            rep2.style.marginBottom="0.5%";
            rep3.style.display="flex";
            rep3.style.marginBottom="0.5%";
    
            divfoto.appendChild(imagen);
            divfoto.appendChild(dudosa);
            divenunciado.appendChild(p);


            divrespuestas.appendChild(rep1);
            divrespuestas.appendChild(rep2);
            divrespuestas.appendChild(rep3);

            for (let j=0;j<inputs.length;j++){
                if (respuestasJSON[i]==1){
                    inputs[0].checked=true;
                    inputs[0].disabled=true;
                }else if (respuestasJSON[i]==2){
                    inputs[1].checked=true;
                    inputs[1].disabled=true;
                }else if (respuestasJSON[i]==3){
                    inputs[2].checked=true;
                    inputs[2].disabled=true;
                }else if (respuestasJSON[i]==0){
                    inputs[0].checked=false;
                    inputs[1].checked=false;
                    inputs[2].checked=false;
                    inputs[0].disabled=true;
                    inputs[1].disabled=true;
                    inputs[2].disabled=true;
                }
            }



    
            divpregunta.appendChild(divfoto);
            divpregunta.appendChild(dudosa);
            divpregunta.appendChild(divenunciado);
            divpregunta.appendChild(divrespuestas);
            
            divpregunta.classList.add("Hola");

    
            contenedor.appendChild(divpregunta);

            divpregunta.classList.add("OCULTA");

            

            

        }

    }

    function muestraBotones(container){
        var div=document.createElement("div");
        var anterior=document.createElement("input");
        anterior.setAttribute("type","button");
        anterior.setAttribute("value","ANTERIOR");
        anterior.id="anterior";

        var siguiente=document.createElement("input");
        siguiente.setAttribute("type","button");
        siguiente.setAttribute("value","SIGUIENTE");
        siguiente.id="siguiente";

        div.appendChild(anterior);
        div.appendChild(siguiente);
        div.id="botones";

        container.appendChild(div);
    }
})