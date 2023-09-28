<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Venta</title>
</head>
<body>
    <h1>Realizar Venta</h1>
    <form action="realizar_venta.php" method="POST">
        <label for="producto">Producto:</label>
        <select name="producto">
            <?php
            $conn = new mysqli("127.0.0.1", "root", "", "ventas_db");

            if ($conn->connect_error) {
                die("Error en la conexión: " . $conn->connect_error);
            }

            $sql = "SELECT id, nombre FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required><br>

        <input type="submit" value="Realizar Venta">
    </form>
</body>
</html>
