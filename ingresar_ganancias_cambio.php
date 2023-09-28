<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ganancias = $_POST["ganancias"];
    $cambio = $_POST["cambio"];

    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener ganancias actuales
    $sql = "SELECT ganancias FROM productos";
    $result = $conn->query($sql);

    $total_ganancias = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_ganancias += $row["ganancias"];
        }
    }

    // Actualizar ganancias y descuento de cambio
    $nuevas_ganancias = $total_ganancias + $ganancias;
    $cambio_actual = $total_ganancias - $cambio;

    $update_sql = "UPDATE productos SET ganancias = $nuevas_ganancias";
    if ($conn->query($update_sql) === TRUE) {
        echo "Ganancias ingresadas con éxito.<br>";
    } else {
        echo "Error al ingresar ganancias: " . $conn->error;
    }

    echo "Cambio actual: $cambio_actual";
    $conn->close();
}
?>
