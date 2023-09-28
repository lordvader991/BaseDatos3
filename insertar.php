<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "usuario", "contraseña", "ventas_db");

    // Consulta SQL para insertar un nuevo producto
    $query = "INSERT INTO productos (nombre, descripcion, precio, cantidad) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad')";
    
    if (mysqli_query($conexion, $query)) {
        $id = mysqli_insert_id($conexion);
        $ruta = "imagenes_productos/$id.jpg";
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
        $query = "UPDATE productos SET imagen = '$ruta' WHERE id = $id";
        mysqli_query($conexion, $query);
        mysqli_close($conexion);
        header("Location: registrar_producto_form.php");
    } else {
        echo "Error al insertar el producto: " . mysqli_error($conexion);
    }
}
?>
