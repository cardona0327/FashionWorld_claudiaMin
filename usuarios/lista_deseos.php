<div id="contenedor-formulario-deseos" class="contenedor-formulario">
    <h2 id="titulo-formulario-deseos">Crea tu Lista de Deseos</h2>
    <form id="formulario-deseo" action="ctroUser.php?accion=agregardeseo" method="POST" enctype="multipart/form-data" class="formulario-deseo">
        <label for="nombre_deseo" id="label-nombre-deseo">Nombre del deseo:</label>
        <input id="input-nombre-deseo" type="text" name="nombre_deseo" placeholder="¿Qué deseas agregar?" required>
        
        <label for="foto_referencia" id="label-foto-referencia">Imágenes de referencia:</label>
        <input id="input-foto-referencia" type="file" name="foto_referencia[]" multiple>

        <button id="btn-agregar-deseo" type="submit">Agregar deseo</button>
        <div id="mensaje-error" style="color: red; display: none;"></div>
    </form>
</div>

<script>
    // Aquí puedes agregar funcionalidad adicional si la necesitas
</script>

<!-- Mostrar los deseos del usuario -->
<?php 
include_once("../method/usuarios_class.php");
Usuarios::mostrarDeseosConEliminar($_SESSION['id']); 
?>
