window.addEventListener("load",function(){
    var params=new URLSearchParams(this.window.location.search);
    var idUser=params.get('usuario');
    var dificultad=params.get('dificultad');
    this.fetch("")
})