<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion = mysqli_connect("127.0.0.1", "root", "", "ventas_db");
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="actualizar_prod.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['descripcion']; ?>"><br>
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" value="<?php echo $row['precio']; ?>" required><br>
        <label for="inventario">inventario:</label>
        <input type="text" id="inventario" name="inventario" value="<?php echo $row['inventario']; ?>" required><br>
        <label for="imagen">Imagen Actual:</label>
        <img src="<?php echo $row['imagen']; ?>" width='100' height='100'><br>
        <label for="imagenNueva">Cambiar Imagen:</label>
        <input type="file" id="imagenNueva" name="imagenNueva" accept="image/*"><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
