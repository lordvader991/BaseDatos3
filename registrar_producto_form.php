<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
</head>
<body>
    <h1>Registrar Producto</h1>
    <form action="registrar_producto.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>

        <label for="inventario">Inventario:</label>
        <input type="number" name="inventario" required><br>

        <label for="imagen">Imagen del Producto:</label>
        <input type="file" name="imagen"><br>

        <input type="submit" value="Registrar Producto">
    </form>
</body>
</html>
