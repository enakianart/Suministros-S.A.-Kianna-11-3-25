<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

// Asegúrate de que el ID del historial se reciba correctamente
if (!isset($_POST['IDhistorial_Inventario']) || empty($_POST['IDhistorial_Inventario'])) {
    echo "Error: El ID del historial de inventario no se recibió correctamente.";
    exit();
}
$IDhistorial_Inventario = $_POST['IDhistorial_Inventario'];

// Recibe los demás datos del formulario
$Estado = $_POST['Estado'];
$Fecha = $_POST['Fecha'];
$Descripcion = $_POST['Descripcion'];
$IDcompra = $_POST['IDcompra'];
$IDproducto = $_POST['IDproducto'];
$Cantidad = $_POST['Cantidad'];

echo "ID Historial: " . $IDhistorial_Inventario . "<br>";
echo $Estado . " " . $Fecha . " " . $Descripcion . " " . $IDcompra . " " . $IDproducto . " " . $Cantidad . "<br>";

// Verificar si el IDproducto existe en la tabla Productos
$sql_verificar_producto = "SELECT IDproducto FROM Productos WHERE IDproducto = '$IDproducto'";
$query_verificar_producto = mysqli_query($con, $sql_verificar_producto);

if (mysqli_num_rows($query_verificar_producto) == 0) {
    echo "Error: El ID de producto '$IDproducto' no existe en la tabla Productos.";
} else {
    // Iniciar transacción
    mysqli_begin_transaction($con);

    // Obtener la información del registro original antes de la edición
    $sql_obtener_original = "SELECT Estado, Cantidad, IDproducto FROM Historial_Inventario WHERE IDhistorial_Inventario = '$IDhistorial_Inventario' FOR UPDATE"; // FOR UPDATE para bloquear la fila
    $query_obtener_original = mysqli_query($con, $sql_obtener_original);
    $fila_original = mysqli_fetch_assoc($query_obtener_original);

    if ($fila_original) {
        // Actualizar el movimiento en Historial_Inventario
        $sql_update_historial = "UPDATE Historial_Inventario SET Estado='$Estado', Fecha='$Fecha', Descripcion='$Descripcion', IDcompra='$IDcompra', IDproducto='$IDproducto', Cantidad='$Cantidad' WHERE IDhistorial_Inventario = '$IDhistorial_Inventario'";
        $query_update_historial = mysqli_query($con, $sql_update_historial);

        if ($query_update_historial) {
            // Calcular la diferencia en cantidad y el cambio de estado para actualizar el inventario
            if ($fila_original['IDproducto'] == $IDproducto) { // Si el producto no ha cambiado
                $diferencia_cantidad = $Cantidad - $fila_original['Cantidad'];

                if ($fila_original['Estado'] == 'Recibido' && $Estado == 'Recibido') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual + $diferencia_cantidad WHERE IDproducto = '$IDproducto'";
                } elseif ($fila_original['Estado'] == 'Despachado' && $Estado == 'Despachado') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual + $diferencia_cantidad WHERE IDproducto = '$IDproducto'"; // Sumamos porque la diferencia podría ser negativa
                } elseif ($fila_original['Estado'] == 'Recibido' && $Estado == 'Despachado') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual - " . ($fila_original['Cantidad'] + $Cantidad) . " WHERE IDproducto = '$IDproducto'";
                } elseif ($fila_original['Estado'] == 'Despachado' && $Estado == 'Recibido') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual + " . ($fila_original['Cantidad'] + $Cantidad) . " WHERE IDproducto = '$IDproducto'";
                } else {
                    $sql_actualizar_inventario = false; // No hay cambio directo de stock en otros casos
                }
            } else { // Si el producto ha cambiado, revertir el efecto del original y aplicar el nuevo
                // Revertir el stock del producto original
                if ($fila_original['Estado'] == 'Recibido') {
                    $sql_revertir_inventario_original = "UPDATE Inventario SET StockActual = StockActual - " . $fila_original['Cantidad'] . " WHERE IDproducto = '" . $fila_original['IDproducto'] . "'";
                    mysqli_query($con, $sql_revertir_inventario_original);
                } elseif ($fila_original['Estado'] == 'Despachado') {
                    $sql_revertir_inventario_original = "UPDATE Inventario SET StockActual = StockActual + " . $fila_original['Cantidad'] . " WHERE IDproducto = '" . $fila_original['IDproducto'] . "'";
                    mysqli_query($con, $sql_revertir_inventario_original);
                }

                // Aplicar el nuevo stock al nuevo producto
                if ($Estado == 'Recibido') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual + $Cantidad WHERE IDproducto = '$IDproducto'";
                } elseif ($Estado == 'Despachado') {
                    $sql_actualizar_inventario = "UPDATE Inventario SET StockActual = StockActual - $Cantidad WHERE IDproducto = '$IDproducto'";
                } else {
                    $sql_actualizar_inventario = false;
                }
            }

            if ($sql_actualizar_inventario !== false) {
                $query_actualizar_inventario = mysqli_query($con, $sql_actualizar_inventario);
                if ($query_actualizar_inventario) {
                    mysqli_commit($con);
                    Header("Location: Historial_Inventario.php");
                } else {
                    mysqli_rollback($con);
                    echo "Error al actualizar el stock en Inventario: " . mysqli_error($con);
                }
            } else {
                mysqli_commit($con); // Si no hay actualización de inventario, confirmar la actualización del historial
                Header("Location: Historial_Inventario.php");
            }
        } else {
            mysqli_rollback($con);
            echo "Error al actualizar el historial del inventario: " . mysqli_error($con);
        }
    } else {
        mysqli_rollback($con);
        echo "Error: No se encontró el registro de historial con el ID proporcionado.";
    }
}

mysqli_close($con);

?>