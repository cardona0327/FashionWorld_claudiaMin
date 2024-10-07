<head>
    <title>Buscar Usuario</title>
    <link href="../css/busqueUsuarios.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card" id="card_busUser">
            <div class="card-content" id="car_cont"> 
                <h2>Buscar por ID</h2>
                <form onsubmit="buscarUser(event)" method="post" id="on_bus">
                    <div class="form-group">
                        <label for="id_producto">Ingresa el nombre del usuario:</label>
                        <input type="number" id="id_persona" name="busqueda">
                    </div>
                    <input type="submit" value="Buscar">
                </form>
            </div>
        </div>
    </div> 
    <p id="personas"></p>

    <div class="row" id="idDato">
        <?php
        
        ?>
    </div>
</body>

