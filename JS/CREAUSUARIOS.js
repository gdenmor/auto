window.addEventListener("load",function(){
    var cuerpo=this.document.getElementById("cuerpo");

    var filas=this.document.querySelectorAll("#cuerpo tr");

    for (let i=0;i<filas.length;i++){
                var datos=filas[i].getElementsByTagName("td");

                var aceptar = this.document.getElementById("aceptar");


            
                aceptar.addEventListener("click",function(ev){
                    ev.preventDefault();
                    var indice=i;
                    datos=filas[i].getElementsByTagName("td");
                    var user=document.getElementById("usuario");
                    var password=document.getElementById("contrasena");
                    var usuario = user.value; // Supongo que el nombre de usuario está en la segunda celda
                    var contrasena = password.value;
                    var rol=datos[2].getElementsByTagName("select")[0];


                    var rolSeleccionado = rol.options[rol.selectedIndex].value;

                    var userData = {
                        username: usuario,
                        password: contrasena,
                        rol: rolSeleccionado
                    };


                    fetch("../AUTOESCUELA/APIS/USUARIOAPI.php",{
                        method: "POST",
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
                            console.error("Error al crear el usuario");
                        }
                    })
                });
            }
        }
);