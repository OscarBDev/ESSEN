document.getElementById('id_categoria').addEventListener('change', function () {
    var nuevaCategoriaDiv = document.getElementById('nueva_categoria_div');
    if (this.value === 'nuevo') {
        nuevaCategoriaDiv.style.display = 'block';
    } else {
        nuevaCategoriaDiv.style.display = 'none';
    }
});
