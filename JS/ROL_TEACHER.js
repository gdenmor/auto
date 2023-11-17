window.addEventListener("load",function(){
    var idUser=this.document.getElementById("idUser");
    const link=this.document.getElementsByClassName("link1");

    for (let i=0;i<link.length;i++){
        link[i].addEventListener("click",function(){
            var User=idUser.value;
            window.location.href="http://localhost/AUTOESCUELA/index.php?menu=pila&idUser="+User;
        });
    }

    const tabla=this.document.getElementsByClassName("fila");

    for (let i=0;i<tabla.length;i++){
        var fila=tabla[i].getElementsByTagName("td");
        for (let j=0;j<fila.length;j++){
            fila[4].addEventListener("click",function(){
                var id=document.getElementsByClassName("idIntento")[i].value;
                var examen=fila[1].textContent;
                window.location.href='http://localhost/AUTOESCUELA/index.php?menu=visualizacion&id='+id+'&examen='+examen;
            })
        }
    }
});