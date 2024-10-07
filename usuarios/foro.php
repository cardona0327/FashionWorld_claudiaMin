<div id="foro-container">
    <?php echo Productos::mostrarForo(); ?>
</div>

<div id="formulario-comentario">
    <textarea id="mensaje" placeholder="Escribe tu comentario..."></textarea>
    <button onclick="enviarComentario()">Enviar Comentario</button>
</div>
