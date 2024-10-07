<br><br><br>
<form id="formu_pro" action="ctroAdmi.php" method="POST" enctype="multipart/form-data">
  <div id="primer" class="form-group">
    <h2 id="titulo" >Agregar Producto</h2>
    <center>
      <div class="image-preview" id="imagen_prev">
        <img id="preview" src="../img/hellokitty.gif" alt="Vista previa de la imagen">
      </div>
    </center>

    
    <label for="id_categoria">ID Categoría:</label>
    <select id="id_categoria" name="id_categoria" required>
      <option value="">Selecciona una categoría</option>
      <?php
      include_once("../method/modelo.php");
      $categorias = Modelo::obtenerCategorias(); // Verifica si la función devuelve categorías correctamente
      foreach($categorias as $categoria) {
        echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['categoria'] . "</option>";
      }
      ?>
    </select>

    
    <label id="precio" for="nombre">Nombre:</label>
    <input type="text" id="nombre_b" name="nombre" required>

    <label id="precio" for="precio">Precio:</label>
    <input type="number" step="0.01" min="0" id="precio_b" name="precio" placeholder="Precio"  required>

    <label id="cantidad" for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad_b" name="cantidad" required>

    <label id="descripcion" for="descripcion">Descripción:</label>
    <textarea type="text" id="descripcion_b" name="descripcion" rows="4" required></textarea>

    <label id="color" for="color">Color:</label>
    <input type="color" id="color_b" name="color" required>

    <label id="tallas" for="tallas">Tallas:</label>
    <input type="text" id="tallas_b" name="tallas" required>

    <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage()">

    <br><br>
    <input type="submit" id="buton" name="crear" value="Agregar Producto">
  </div>
</form>



