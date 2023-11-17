if (window.location.search === '') {
    // Si no hay parámetros de consulta, agrega uno
    var nuevaURL = window.location.href + '?menu=inicio';
    window.location.href = nuevaURL;
}