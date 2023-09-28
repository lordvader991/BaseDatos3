<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto"];
    $cantidad = $_POST["cantidad"];

    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener información del producto seleccionado
    $sql = "SELECT nombre, precio, inventario, ganancias FROM productos WHERE id = $producto_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre_producto = $row["nombre"];
        $precio_producto = $row["precio"];
        $inventario_actual = $row["inventario"];
        $ganancias_actual = $row["ganancias"];

        // Calcular el costo total de la venta
        $costo_total = $precio_producto * $cantidad;

        // Verificar si hay suficiente inventario
        if ($inventario_actual >= $cantidad) {
            // Actualizar el inventario y las ganancias
            $nuevo_inventario = $inventario_actual - $cantidad;
            $nuevas_ganancias = $ganancias_actual + $costo_total;

            $update_sql = "UPDATE productos SET inventario = $nuevo_inventario, ganancias = $nuevas_ganancias WHERE id = $producto_id";

            if ($conn->query($update_sql) === TRUE) {
                echo "Venta realizada con éxito. Costo total: $costo_total";
            } else {
                echo "Error al actualizar el inventario y las ganancias: " . $conn->error;
            }
        } else {
            echo "No hay suficiente inventario para realizar la venta.";
        }
    } else {
        echo "Producto no encontrado.";
    }

    $conn->close();
}
?>
