<br><br>
<title>agregar categorias</title>
    <div class="card-content" id="categoria">
      <h2>Agregar Categoría</h2>
      <form action="ctroAdmi.php?agreCate=hd" enctype="multipart/form-data" method="post">
        <div class="form-group" id="categoria_id">
          <label for="id_categoria" id="id_cat">ID Categoría:</label>
          <input type="number" id="id_categoria" name="id_categoria">
        </div>
        <div class="form-group" id="categoria_nom">
          <label for="categoria" id="nom_cate">Categoría:</label>
          <input type="text" id="categoria" name="categoria">
        </div>
        <input type="submit" id="b_cate" value="Agregar Categoría"><br>
      </form>
    </div>