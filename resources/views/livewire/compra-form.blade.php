<div>
    <!-- campos -->
    <div class="row">

        <!-- Campos del producto -->
        <div class="col-md-12 mt-2 mb-2">
            <h4>Datos de Producto</h4>
        </div>

        <div class="col-md-6" style="display:none;">
            <div class="form-group">
                <label for="nombre" class="form-label"># Producto</label>
                <input type="hidden" name="id_producto" id="id_producto" class="form-control" wire:model="id_producto" value="{{ $id_producto }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" wire:model="nombre" wire:change="update" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="codigo" class="form-label">Código del Producto</label>
                <input type="number" name="codigo" id="codigo" class="form-control" wire:model="codigo" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="color" class="form-label">Color</label>
                <input type="text" name="color" id="color" class="form-control" wire:model="color" pattern="[A-Za-z]+" title="Solo se permiten letras" >
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="comensales" class="form-label">Comensales</label>
                <input type="number" name="comensales" id="comensales" class="form-control" wire:model="comensales" min="0" step="1" title="Ingrese un número entero no negativo">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="medida" class="form-label">Medida</label>
                <input type="text" name="medida" id="medida" class="form-control" wire:model="medida">
            </div>
        </div>
        <!-- fin de los campos de producto -->

        <!-- Selección de categoría existente -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_categoria" class="form-label">Seleccionar Categoría</label>
                <select wire:model="id_categoria" name="id_categoria" id="id_categoria" class="form-control">
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- fin de la selección de categoría existente -->

    </div>
    <!-- fin de los campos del formulario -->
</div>