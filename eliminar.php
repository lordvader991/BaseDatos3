<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conexion = mysqli_connect("127.0.0.1", "root", "", "ventas_db");
    $query = "SELECT imagen FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    $imagenRuta = $row['imagen'];
    $query = "DELETE FROM productos WHERE id = $id";
    if (mysqli_query($conexion, $query)) {
        if (file_exists($imagenRuta)) {
            unlink($imagenRuta);
        }
        mysqli_close($conexion);
        header("Location: registrar_producto_form.php");
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
}
?>
