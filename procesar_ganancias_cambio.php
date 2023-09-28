<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto"];
    $ganancias = $_POST["ganancias"];
    $cambio = $_POST["cambio"];

    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Actualizar la tabla "productos" con las ganancias y el cambio para el producto seleccionado
    $sql = "UPDATE productos SET ganancias = $ganancias, cambio = $cambio WHERE id = $producto_id";

    if ($conn->query($sql) === TRUE) {
        echo "Ganancias y cambio actualizados con éxito para el producto seleccionado.";
    } else {
        echo "Error al actualizar ganancias y cambio: " . $conn->error;
    }

    $conn->close();
}
?>
