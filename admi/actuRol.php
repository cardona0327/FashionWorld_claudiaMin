<br><br><b>
<form action="ctroAdmi.php?ediRol=bye&dato=<?php echo $_GET['dato']; ?>"class="row g-3" method="post">
<center><div class="col-auto">
<!-- <input type="text" name="id_categoria" class="form-control" id="id_categoria" placeholder="id">
  </div><br> -->
  <div class="col-auto">
    <input type="text" name="rol" class="form-control" id="roles" placeholder="rol" value="<?php if(isset($_GET['dato']))echo Productos::actualizaDatosUser(6, $_GET['dato']);  ?>">
  </div><br>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Actualizar el Rol del usuario</button>
  </div></center>
</form>

