<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Productos</title>
</head>
<body>
    <h1>CRUD de Productos</h1>

    <!-- Formulario para agregar un nuevo producto -->
    <h2>Agregar Producto</h2>
    <form action="insertar.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"><br>
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" required><br>
        <label for="inventario">inventario:</label>
        <input type="text" id="inventario" name="inventario" required><br>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br>
        <input type="submit" value="Agregar">
    </form>

    <!-- Tabla para mostrar los productos -->
    <h2>Lista de Productos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>inventario</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("127.0.0.1", "root", "", "ventas_db");

        // Verificar si la conexión fue exitosa
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta SQL para obtener los productos
        $query = "SELECT * FROM productos";
        $result = mysqli_query($conexion, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['inventario'] . "</td>";
            echo "<td><img src='" . $row['imagen'] . "' width='100' height='100'></td>";
            echo "<td><a href='editar.php?id=" . $row['id'] . "'>Editar</a> | <a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </table>
</body>
</html>
