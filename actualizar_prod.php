<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $inventario = $_POST['inventario'];
    $conexion = mysqli_connect("127.0.0.1", "root", "", "ventas_db");
    $query = "SELECT imagen FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    $imagenRuta = $row['imagen'];
    $nuevaRuta = "imagenes/$id.jpg";
    if ($_FILES["imagenNueva"]["tmp_name"]) {
        move_uploaded_file($_FILES["imagenNueva"]["tmp_name"], $nuevaRuta);
    }
    $query = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', inventario = '$inventario' WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        if ($_FILES["imagenNueva"]["tmp_name"]) {
            $query = "UPDATE productos SET imagen = '$nuevaRuta' WHERE id = $id";
            mysqli_query($conexion, $query);
            if (file_exists($imagenRuta)) {
                unlink($imagenRuta);
            }
        }
        mysqli_close($conexion);
        header("Location: registrar_producto_form.php");
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
}
?>
