document.getElementById('CategoriaBtn').addEventListener('click', function() {
    var categoriaContainer = document.getElementById('nuevaCategoriaContainer');
    //cambiando el select
    var categoriaSelect = document.getElementById('id_categoria'); 

    if (categoriaContainer.style.display === "none") {
        categoriaContainer.style.display = "block";
    } else {
        categoriaContainer.style.display = "none";
    }

    categoriaSelect.value = "nothing";
});
