<?php
function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect = mysqli_connect($servername, $username, $password, $database);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connect;
}

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cantidad = $_POST["Cantidad"];
    $CostoUnitario = $_POST["CostoUnitario"];
    $IDcompra = $_POST["IDcompra"];
    $IDproducto = $_POST["IDproducto"];

    // Verificar si el IDproducto existe
    $sql_check_producto = "SELECT COUNT(*) FROM Productos WHERE IDproducto = $IDproducto";
    $result_check_producto = mysqli_query($con, $sql_check_producto);
    $row_check_producto = mysqli_fetch_array($result_check_producto);

    if ($row_check_producto[0] == 0) {
        echo "<script>alert('Error: El ID de producto no existe.'); window.location.href='DetalleCompras.php';</script>";
        exit;
    }

    // Obtener el costo unitario correcto del producto
    $sql_costo_producto = "SELECT CostoUnitario FROM Productos WHERE IDproducto = $IDproducto";
    $result_costo_producto = mysqli_query($con, $sql_costo_producto);
    $row_costo_producto = mysqli_fetch_assoc($result_costo_producto);

    if ($row_costo_producto) {
        $costo_correcto = $row_costo_producto['CostoUnitario'];

        // Validar si el costo ingresado coincide con el costo correcto
        if ($CostoUnitario == $costo_correcto) {
            // Insertar detalle de compra si el costo es correcto
            $sql_insert_detalle = "INSERT INTO Detalle_Compras (Cantidad, CostoUnitario, IDcompra, IDproducto) VALUES ($Cantidad, $CostoUnitario, $IDcompra, $IDproducto)";
            if (mysqli_query($con, $sql_insert_detalle)) {
                // Actualizar CostoTotal en Compras
                $total_detalle = $Cantidad * $CostoUnitario;
                $sql_update_total = "UPDATE Compras SET CostoTotal = CostoTotal + $total_detalle WHERE IDcompra = $IDcompra";
                mysqli_query($con, $sql_update_total);
                echo "<script>alert('Detalle de compra agregado correctamente.'); window.location.href='DetalleCompras.php';</script>";
            } else {
                echo "<script>alert('Error al agregar detalle de compra: " . mysqli_error($con) . "'); window.location.href='DetalleCompras.php';</script>";
            }
        } else {
            echo "<script>alert('Error: El costo unitario ingresado (" . $CostoUnitario . ") no coincide con el costo correcto del producto (" . $costo_correcto . ").'); window.location.href='DetalleCompras.php';</script>";
        }
    } else {
        echo "<script>alert('No se encontró el producto con ID: " . $IDproducto . "'); window.location.href='DetalleCompras.php';</script>";
    }
}

mysqli_close($con);
?>