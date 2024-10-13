<div>
    <!-- campos -->
    <div class="row">

        <!-- campos de detalle compras -->
        <div class="col-md-12 mt-2 mb-2">
            <h4>Datos de Detalle Compra</h4>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" wire:model="cantidad" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="total_compra" class="form-label">Total compra</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Bs</span>
                    <input type="number" name="total_compra" id="total_compra" class="form-control" step="0.01" min="0" wire:model="total_compra" required>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="margen_de_ganancia" class="form-label">Margen de Ganancia</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">%</span>
                    <input type="number" name="margen_de_ganancia" id="margen_de_ganancia" class="form-control" step="0.01" min="0" wire:model="margen_de_ganancia">
                </div>
            </div>
        </div>

        <!-- fin de los campos de detalle compras -->

        <!-- Campos del producto -->
        <div class="col-md-12 mt-2 mb-2">
            <h4>Datos de Producto</h4>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="form-label"># Producto</label>
                <input type="text" name="id_producto" id="id_producto" class="form-control" wire:model="id_producto" value="{{ $id_producto }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control" wire:model="nombre" wire:change="update" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="codigo" class="form-label">Código del Producto</label>
                <input type="number" name="codigo" id="codigo" class="form-control" wire:model="codigo" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="color" class="form-label">Color</label>
                <input type="text" name="color" id="color" class="form-control" wire:model="color" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="comensales" class="form-label">Comensales</label>
                <input type="number" name="comensales" id="comensales" class="form-control" wire:model="comensales" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="medida" class="form-label">Medida</label>
                <input type="text" name="medida" id="medida" class="form-control" wire:model="medida" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" wire:model="stock" required readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Bs</span>
                    <input type="number" name="precio_unitario" id="precio_unitario" class="form-control" wire:model="precio_unitario" required readonly>
                </div>
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

        <!-- Campo para nueva categoría -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="nueva_categoria" class="form-label">Agregar Nueva Categoría</label>
                <input type="text" name="nueva_categoria" id="nueva_categoria" class="form-control" placeholder="Nombre de nueva categoría" wire:model="nueva_categoria">
            </div>
        </div>

        <!-- Botón de enviar -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Registrar Producto</button>
        </div>
        <!-- fin del boton -->

    </div>
    <!-- fin de los campos del formulario -->
</div>