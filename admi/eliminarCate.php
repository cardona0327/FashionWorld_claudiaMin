<br><br>
<div class="row">
<br><br><div class="card">
    <div class="card-content">
      <div class="form-group">
          <label for="id_categoria">id_categoria:</label>
          <input type="number" id="id_categoria" name="id_categoria">
        </div>
        <input type="submit" value="Eliminar" id="borra" onclick="eliminarCate()"><br>
    </div>
    
<div class="row" id="categorias">
<?php 
echo Productos::mostrarCate();
?>
</div>

</div>