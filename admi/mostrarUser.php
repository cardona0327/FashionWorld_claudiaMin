

<div class="row"><br><br>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <form id="formulario"class="d-flex ms-auto">
          <input id="nombreUser" class="form-control me-2" type="search" placeholder="Documento del usuario" aria-label="Search">
          <button id="enviar" class="btn btn-outline-success" type="button" onclick="buscadorUser()">Buscar</button>
      </for>
  </div>
</nav>

<div class="row" id="mostrarUser">
<?php
echo Productos::mostrarUsuarios();
?>
</div>


</div>