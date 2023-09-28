<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ventas</title>
</head>
<body>
    <h1>Bienvenido al Sistema de Ventas</h1>

    <h2>Menú:</h2>
    <ul>
        <li><a href="registrar_producto_form.php"><button>Registrar Producto</button></a></li>
        <li><a href="realizar_venta_form.php"><button>Realizar Venta</button></a></li>
        <li><a href="inventario.php"><button>Ingresar/Retirar del Inventario</button></a></li>
        <li><a href="ganancias_cambio.php"><button>Ingresar Ganancias/Descontar Cambio</button></a></li>
    </ul>

    <h2>Lista de Productos:</h2>
    <?php
    // Conectar a la base de datos
    $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Consultar la lista de productos con ganancias, cambio e imagen
    $sql = "SELECT id, nombre, descripcion, precio, inventario, ganancias, cambio, imagen FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Inventario</th><th>Ganancias</th><th>Cambio</th><th>Imagen</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>" . $row["inventario"] . "</td>";
            echo "<td>" . $row["ganancias"] . "</td>";
            echo "<td>" . $row["cambio"] . "</td>";
            echo "<td><img src='" . $row["imagen"] . "' width='100' height='100'></td>"; // Cambia el tamaño de acuerdo a tus necesidades
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No hay productos registrados.";
    }

    $conn->close();
    ?>
</body>
</html>
