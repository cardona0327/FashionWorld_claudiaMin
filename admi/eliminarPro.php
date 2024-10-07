<br><br>
<div class="row">
<br><br><div class="card">
    <div class="card-content">
      <div class="form-group">
          <label for="id_producto">ID_producto:</label>
          <input type="number" id="id_producto" name="id_producto">
        </div>
        <input type="submit" value="Eliminar" id="borra" onclick="eliminarPro()"><br>
    </div>
    
<div class="row" id="productos">
<?php 
echo Productos::mostrarPro();
?>
</div>

</div>