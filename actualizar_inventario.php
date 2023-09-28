<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto"];
    $accion = $_POST["accion"];
    $cantidad = $_POST["cantidad"];

    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener información del producto seleccionado
    $sql = "SELECT nombre, inventario FROM productos WHERE id = $producto_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre_producto = $row["nombre"];
        $inventario_actual = $row["inventario"];

        if ($accion == "ingresar") {
            // Actualizar el inventario al ingresar productos
            $nuevo_inventario = $inventario_actual + $cantidad;
        } elseif ($accion == "retirar" && $inventario_actual >= $cantidad) {
            // Actualizar el inventario al retirar productos (si hay suficiente inventario)
            $nuevo_inventario = $inventario_actual - $cantidad;
        } else {
            echo "No se puede retirar la cantidad especificada. Inventario insuficiente.";
            exit();
        }

        $update_sql = "UPDATE productos SET inventario = $nuevo_inventario WHERE id = $producto_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "$accion de $cantidad unidades de $nombre_producto realizado con éxito.";
        } else {
            echo "Error al actualizar el inventario: " . $conn->error;
        }
    } else {
        echo "Producto no encontrado.";
    }

    $conn->close();
}
?>
