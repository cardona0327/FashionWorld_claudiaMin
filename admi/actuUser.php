<?php $_GET['dato'] = $_SESSION['id'];?>  
<center>
  <div class="container" id="con_actu">
    <form action="ctroAdmi.php?ediUser=ola&dato=<?php echo $_GET['dato']; ?>" class="row g-3" method="post">
      <h3 id="titulo-cambiar-datos">Solo puedes cambiar estos datos:</h3>
      <div class="col-12">
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Producto" value="<?php if(isset($_GET['dato']))echo Productos::actualizaDatosUser(1, $_GET['dato']); ?>">
      </div>
      <div class="col-12">
        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" value="<?php if(isset($_GET['dato']))echo Productos::actualizaDatosUser(2, $_GET['dato']); ?>">
      </div>
      <div class="col-12">
        <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" value="<?php if(isset($_GET['dato']))echo Productos::actualizaDatosUser(3, $_GET['dato']); ?>">
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary mb-3" id="btn-actualizar">Actualizar Datos</button>
      </div>
    </form>
  </div>
</center>
