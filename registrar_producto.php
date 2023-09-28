<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $inventario = $_POST["inventario"];
    $ganancias = 0; // Inicialmente 0 ganancias
    $imagen = null;

    // Subir imagen
    if ($_FILES["imagen"]["tmp_name"]) {
        $imagen = "imagenes/" . $_FILES["imagen"]["name"];
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen);
    }

    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Insertar el producto en la base de datos
    $sql = "INSERT INTO productos (nombre, descripcion, precio, inventario, ganancias, imagen)
            VALUES ('$nombre', '$descripcion', $precio, $inventario, $ganancias, '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto registrado con éxito.";
    } else {
        echo "Error al registrar el producto: " . $conn->error;
    }

    $conn->close();
}
?>
