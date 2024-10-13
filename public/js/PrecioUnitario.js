// Escucha los cambios en los campos de entrada
document.addEventListener('DOMContentLoaded', function () {
    const cantidadInput = document.getElementById('cantidad');
    const totalCompraInput = document.getElementById('total_compra');
    const precioUnitarioInput = document.getElementById('precio_unitario');
    const margenDeGananciaInput = document.getElementById('margen_de_ganancia');
    //stock
    const StockInput = document.getElementById('stock');


    function calcularPrecioUnitario() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const totalCompra = parseFloat(totalCompraInput.value) || 0;
        const margen_de_ganancia = parseFloat(margenDeGananciaInput.value) || 0;
        //stock
        const stock = parseFloat(StockInput.value) || 0;

        if (cantidad > 0) {
            //encontramos el precio unitario
            const precioUnitario1 = totalCompra / cantidad;
            //margen de ganacia si es que lo hay
            const precioUnitario = precioUnitario1*(1+margen_de_ganancia/100);
            precioUnitarioInput.value = precioUnitario.toFixed(2); // Redondea a 2 decimales 
            //stock
            StockInput.value = cantidad;
        } else {
            precioUnitarioInput.value = 0;
            //stock
            StockInput.value = 0;
        }
    }

    // Agregar event listeners para que el cálculo se ejecute al escribir
    cantidadInput.addEventListener('input', calcularPrecioUnitario);
    totalCompraInput.addEventListener('input', calcularPrecioUnitario);
    margenDeGananciaInput.addEventListener('input', calcularPrecioUnitario);
    //stock
    StockInput.addEventListener('input', calcularPrecioUnitario);
});