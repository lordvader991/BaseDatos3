<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Ganancias/Descontar Cambio</title>
</head>
<body>
    <h1>Ingresar Ganancias/Descontar Cambio</h1>

    <!-- Formulario para seleccionar el producto y realizar cambios -->
    <form action="procesar_ganancias_cambio.php" method="POST">
        <label for="producto">Seleccionar Producto:</label>
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

        <label for="ganancias">Ingresar Ganancias:</label>
        <input type="number" name="ganancias" step="0.01" required><br>

        <label for="cambio">Descontar Cambio:</label>
        <input type="number" name="cambio" step="0.01" required><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
