window.addEventListener("load",function(ev){
    var divpreguntas=this.document.getElementsByClassName("OCULTA");
    var container=this.document.getElementById("container");
    var j=0;
    var params=new URLSearchParams(this.window.location.search);
    var id=params.get('examen');
    var idUser=params.get('usuario');
    container.style.marginLeft="25%";
    var header=this.document.getElementsByTagName("header")[0];
    header.style.display="none";
    
    this.fetch("../AUTOESCUELA/APIS/EXAMENAPI.php?id="+id,{
    })
        .then(x=>x.json())
        .then(y=>{
            var preguntas = y.Examen.preguntas;

            const respuestasJSON = Array(preguntas.length).fill(0);

            var divcont=this.document.createElement("div");

            for (let i=0;i<preguntas.length;i++){
                var div=document.createElement("div");
                div.innerHTML=i+1;
                div.classList.add("divs");
                div.style.border="1px solid black";
                div.style.width="1%";
                divcont.appendChild(div);
            }

            divcont.style.display="flex";
            divcont.style.justifyContent="center";
            divcont.style.flexDirection="column";

            mostrarPregunta(divpreguntas, preguntas,container,respuestasJSON,divcont);
            
            muestraBotones(container);
            

            container.appendChild(divcont);


            var siguiente=this.document.getElementById("siguiente");

            var anterior=this.document.getElementById("anterior");

            var divs=this.document.getElementsByClassName("Hola");

            debugger;

            var divselementos=this.document.getElementsByClassName("divs");


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

            for (let i=0;i<divselementos.length;i++){
                divselementos[i].addEventListener("click",function(){
                    divs[j].classList.add("OCULTA");
                    j=i;
                    divs[j].classList.remove("OCULTA");
                })
            }

            const dudosa=this.document.getElementsByClassName("DUDOSA");
            for (let i=0;i<dudosa.length;i++){
                dudosa[i].addEventListener("change",function(){
                    if (dudosa[i].checked==true){
                        divselementos[i].style.backgroundColor="yellow";
                    }else{
                        divselementos[i].style.backgroundColor="white";
                    }
                })
            }

            


            var finalizar=this.document.getElementById("finalizar").addEventListener("click",function(){
                debugger;
                var fecha=new Date();
                var string=fecha.getFullYear()+"-"+fecha.getMonth()+"-"+fecha.getDate()+" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
                    var intento={
                        idUser: idUser,
                        fecha: string,
                        JSON: JSON.stringify(respuestasJSON),
                        idExamen: id
                    }
                    fetch("../AUTOESCUELA/APIS/INTENTOAPI.php",{
                        method: "POST",
                        body: JSON.stringify(intento)
                    })
                    .then(y=>{
                        window.location.href = "http://localhost/AUTOESCUELA/index.php?menu=alumno";
                    })
                    
                        
            });

            this.window.addEventListener("beforeunload",function(){
                this.localStorage.setItem('JSON'+idUser,respuestasJSON);
            })


            
        
        });


        function mostrarPregunta(divpreguntas,preguntas,contenedor,respuestasJSON,divcont) {
            var duracion = 1800; 

            var timerElement = document.getElementById('timer');
            var countdown=document.getElementById("countdown");
            var interval = setInterval(function() {
                if (duracion <= 0) {
                    clearInterval(interval);
                    
                    var fecha=new Date();
                    var string=fecha.getFullYear()+"-"+fecha.getMonth()+"-"+fecha.getDate()+" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
                    var intento={
                        idUser: idUser,
                        fecha: string,
                        JSON: JSON.stringify(respuestasJSON),
                        idExamen: id
                    }
                    fetch("../AUTOESCUELA/APIS/INTENTOAPI.php",{
                        method: "POST",
                        body: JSON.stringify(intento)
                    })
                    .then(y=>{
                        window.location.href = "http://localhost/AUTOESCUELA/index.php?menu=alumno";
                    })
                } else {
                    var minutos = Math.floor(duracion / 60);
                    var segundos = duracion % 60;
                    timerElement.textContent = minutos + ":" + (segundos < 10 ? "0" : "") + segundos;
                    duracion--;
                }
            }, 1000);
            for (let i=0;i<preguntas.length;i++){
                var divpregunta = document.createElement("div");
                var pregunta = preguntas[i];
                var imagen;
                var tipo=pregunta.tipo;
                debugger;
                if (pregunta.tipo=="VIDEO/MP4"){
                    imagen = document.createElement("video");
                    var ruta = "../AUTOESCUELA/" + pregunta.imagen;
                    imagen.src = ruta;
                    imagen.type=pregunta.tipo;
                    imagen.play();
                }else if (pregunta.tipo=="IMAGE/PNG"){
                    imagen = document.createElement("img");
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
                input1.setAttribute("value", 1);

        
                var input2 = document.createElement("input");
                input2.setAttribute("type", "radio");
                input2.setAttribute("name", "rep" + i);
                input2.setAttribute("value", 2);
        
                var input3 = document.createElement("input");
                input3.setAttribute("type", "radio");
                input3.setAttribute("name", "rep" + i);
                input3.setAttribute("value",3);

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
                inputdudosa.classList.add("DUDOSA");

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


                var borrar=document.createElement("div");

                var inputborra=document.createElement("a");
                inputborra.innerHTML="Borrar opción seleccionada";
                inputborra.id="borra"+i;
                inputborra.classList.add("borra");

                var hijos=divcont.childNodes;

                inputborra.addEventListener("click",function(ev){
                    ev.preventDefault();
                    for (let i=0;i<inputs.length;i++){
                        inputs[i].checked=false;
                        hijos[j].style.backgroundColor="white";
                        console.log(inputs[i]);
                    }
                });
                
                for (let j=0;j<inputs.length;j++){
                    inputs[j].addEventListener("change",function(){
                        var selectedIndex = j;
                        respuestasJSON[i] = selectedIndex + 1; // Ajusta el índice según tus necesidades
                        for (let k = 0; k < inputs.length; k++) {
                            if (k !== selectedIndex) {
                                hijos[k].style.backgroundColor = "white";
                            } else {
                                hijos[k].style.backgroundColor = "gray";
                            }
                        }
                    })
                }

                divcont.style.display="flex";
                divcont.style.flexDirection="column";


                borrar.appendChild(inputborra);


        
                divpregunta.appendChild(divfoto);
                divpregunta.appendChild(dudosa);
                divpregunta.appendChild(divenunciado);
                divpregunta.appendChild(divrespuestas);
                divpregunta.appendChild(borrar);

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

            var finalizar=document.createElement("input");
            finalizar.setAttribute("type","button");
            finalizar.setAttribute("value","FINALIZAR TEST");
            finalizar.id="finalizar";

            div.appendChild(anterior);
            div.appendChild(siguiente);
            div.appendChild(finalizar);
            div.id="botones";

            container.appendChild(div);
        }

        
        
},false);