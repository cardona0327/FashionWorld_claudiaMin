<br><br><b>
<form action="ctroAdmi.php?ediCate=try&dato=<?php echo $_GET['dato']; ?>"class="row g-3" method="post">
<center><div class="col-auto">
<!-- <input type="text" name="id_categoria" class="form-control" id="id_categoria" placeholder="id">
  </div><br> -->
  <div class="col-auto">
    <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Nombre" value="<?php if(isset($_GET['dato']))echo Productos::editarCate(1,$_GET['dato'])  ?>">
  </div><br>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Actualizar Nombre dela Categoría</button>
  </div></center>
</form>

