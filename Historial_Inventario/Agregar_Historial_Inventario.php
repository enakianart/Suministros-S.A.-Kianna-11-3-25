<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$Estado = $_POST['Estado'];
$Fecha = $_POST['Fecha'];
$Descripcion = $_POST['Descripcion'];
$IDcompra = $_POST['IDcompra'];
$IDproducto = $_POST['IDproducto'];
$Cantidad = $_POST['Cantidad'];

echo $Estado . " " . $Fecha . " " . $Descripcion . " " . $IDcompra . " " . $IDproducto . " " . $Cantidad . "<br>";

// Verificar si el IDproducto existe en la tabla Productos
$sql_verificar_producto = "SELECT IDproducto FROM Productos WHERE IDproducto = '$IDproducto'";
$query_verificar_producto = mysqli_query($con, $sql_verificar_producto);

if (mysqli_num_rows($query_verificar_producto) == 0) {
    echo "Error: El ID de producto '$IDproducto' no existe en la tabla Productos.";
} else {
    // Iniciar transacción para asegurar la integridad de los datos
    mysqli_begin_transaction($con);

    // Insertar el movimiento en Historial_Inventario
    $sql_insert_historial = "INSERT INTO Historial_Inventario (Estado, Fecha, Descripcion, IDcompra, IDproducto, Cantidad) VALUES ('$Estado', '$Fecha', '$Descripcion', '$IDcompra', '$IDproducto', '$Cantidad')";
    $query_insert_historial = mysqli_query($con, $sql_insert_historial);

    if ($query_insert_historial) {
        // Actualizar el stock en la tabla Inventario
        if ($Estado == 'Recibido') {
            $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual + $Cantidad WHERE IDproducto = '$IDproducto'";
        } elseif ($Estado == 'Despachado') {
            $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual - $Cantidad WHERE IDproducto = '$IDproducto'";
        } else {
            $sql_actualizar_inventario = false; // No se necesita actualizar el inventario para otros estados
        }

        if ($sql_actualizar_inventario) {
            $query_actualizar_inventario = mysqli_query($con, $sql_actualizar_inventario);

            if ($query_actualizar_inventario) {
                mysqli_commit($con); // Confirmar la transacción
                Header("Location: Historial_Inventario.php");
            } else {
                mysqli_rollback($con); // Revertir la transacción en caso de error
                echo "Error al actualizar el stock en Inventario: " . mysqli_error($con);
            }
        } else {
            mysqli_commit($con); // Confirmar la inserción en Historial si no hay actualización de inventario
            Header("Location: Historial_Inventario.php");
        }
    } else {
        mysqli_rollback($con); // Revertir la transacción en caso de error en la inserción del historial
        echo "Error al insertar el movimiento en Historial_Inventario: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>