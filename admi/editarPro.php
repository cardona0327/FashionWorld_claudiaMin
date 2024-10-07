<form id="formu_edi" action="ctroAdmi.php?ediPro=ola&dato=<?php echo $_GET['dato']; ?>" method="post" enctype="multipart/form-data">
    <div class="row g-3">
        <!-- Nombre del producto -->
        <div class="col-12 col-md-6">
            <label for="producto">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" id="producto" placeholder="Nombre del Producto" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(1,$_GET['dato']); ?>">
        </div>

        <!-- Precio del producto -->
        <div class="col-12 col-md-6">
            <label for="precio">Precio</label>
            <input type="text" name="precio" class="form-control" id="precio" placeholder="Precio" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(2,$_GET['dato']); ?>">
        </div>

        <!-- Cantidad del producto -->
        <div class="col-12 col-md-6">
            <label for="cantidad">Cantidad</label>
            <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(3,$_GET['dato']); ?>">
        </div>

        <!-- Detalles del producto -->
        <div class="col-12 col-md-6">
            <label for="detalles">Detalles</label>
            <input type="text" name="detalles" class="form-control" id="detalles" placeholder="Detalles" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(4,$_GET['dato']); ?>">
        </div>

        <!-- Color del producto -->
        <div class="col-12 col-md-6">
            <label for="color">Color</label>
            <input type="text" name="color" class="form-control" id="color" placeholder="Color" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(5,$_GET['dato']); ?>">
        </div>

        <!-- Tallas del producto -->
        <div class="col-12 col-md-6">
            <label for="tallas">Tallas</label>
            <input type="text" name="tallas" class="form-control" id="tallas" placeholder="Tallas" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(6,$_GET['dato']); ?>">
        </div>

        <!-- Mostrar imagen actual y previa -->
        <div class="col-12 img-container">
            <div>
                <label id="label_i">Imagen Actual:</label><br>
                <img id="imgActual" src="../img/<?php if(isset($_GET['dato'])) echo Productos::datoPro(7,$_GET['dato']); ?>" alt="Imagen actual del producto">
            </div>
            <div>
                <label id="label_ni">Seleccionar Nueva Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previeImage()">
                <img id="imgPrevia" alt="Vista previa de la nueva imagen" style="display:none;">
            </div>
        </div>

        <!-- Botón para actualizar el producto -->
        <div class="col-12 text-center" id="col_sub">
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </div>
    </div>
</form>

<!-- Script para previsualizar la nueva imagen seleccionada -->
<script>
    function previeImage() {
        const input = document.getElementById('imagen');
        const imgPrevia = document.getElementById('imgPrevia');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPrevia.src = e.target.result;
                imgPrevia.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imgPrevia.style.display = 'none';
        }
    }
</script>
