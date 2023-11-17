window.addEventListener("load",function(){
    var cuerpo=this.document.getElementById("cuerpo");

    var filas=this.document.querySelectorAll("#cuerpo tr");

    for (let i=0;i<filas.length;i++){
                var datos=filas[i].getElementsByTagName("td");

                var aceptar = filas[i].getElementsByClassName("acepta")[0];


            
                aceptar.addEventListener("click",function(ev){
                    ev.preventDefault();
                    var indice=i;
                    datos=filas[i].getElementsByTagName("td");
                    var id = datos[0].textContent; // Supongo que el ID está en la primera celda
                    var usuario = datos[1].textContent; // Supongo que el nombre de usuario está en la segunda celda
                    var contrasena = datos[2].textContent;
                    var rol=datos[3].getElementsByTagName("select")[0];


                    var rolSeleccionado = rol.options[rol.selectedIndex].value;

                    var userData = {
                        id: id
                    };

                    var id = userData.id.trim();


                    fetch("../AUTOESCUELA/APIS/USUARIOAPI.php?id="+id,{
                        method: "DELETE",
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(userData)
                    })
                        .then(response => {
                            if (response.ok) {
                                // Si la solicitud PUT fue exitosa (código de respuesta 200), redirige a la página actual
                                window.location.reload();
                            } else {
                                // Manejar errores si es necesario
                                console.error("Error al borrar el usuario");
                            }
                        })
                });
            }
        }
);