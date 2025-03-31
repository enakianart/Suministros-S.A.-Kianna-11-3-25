<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDventa = $_POST['IDventa'];
$IDproducto = $_POST['IDproducto'];
$Cantidad = $_POST['Cantidad'];
$CostoUnitario = $_POST['CostoUnitario'];
$Subtotal = $_POST['Subtotal'];

echo $IDventa." ".$IDproducto." ".$Cantidad." ".$CostoUnitario." ".$Subtotal."<br>";

$errores = array();

// Verificar si IDproducto existe en la tabla productos
$sql_producto = "SELECT IDproducto, CostoUnitario FROM Productos WHERE IDproducto = '$IDproducto'";
$query_producto = mysqli_query($con, $sql_producto);
if (mysqli_num_rows($query_producto) == 0) {
    $errores[] = "Error: El ID de producto ingresado no existe en la tabla de productos.";
} else {
    $row_producto = mysqli_fetch_assoc($query_producto);
    $costo_unitario_producto = $row_producto['CostoUnitario'];

    // Verificar que el costo unitario sea igual al de la tabla productos
    if ($CostoUnitario != $costo_unitario_producto) {
        $errores[] = "Error: El costo unitario ingresado no coincide con el costo unitario del producto en la tabla Productos (Costo Unitario Correcto: $costo_unitario_producto).";
        $CostoUnitario = $costo_unitario_producto; // Corregir el valor
    }
}

// Verificar si IDventa existe en la tabla ventas
$sql_venta = "SELECT IDventa FROM Ventas WHERE IDventa = '$IDventa'";
$query_venta = mysqli_query($con, $sql_venta);
if (mysqli_num_rows($query_venta) == 0) {
    $errores[] = "Error: El ID de venta ingresado no existe en la tabla de ventas.";
}

// Verificar si ya existe otro registro con el mismo IDproducto e IDventa
$sql_duplicado = "SELECT IDventa FROM DetalleVentas WHERE IDventa = '$IDventa' AND IDproducto = '$IDproducto'";
$query_duplicado = mysqli_query($con, $sql_duplicado);
if (mysqli_num_rows($query_duplicado) > 0) {
    $errores[] = "Error: Ya existe un registro en el detalle de ventas para la misma venta y producto.";
}

// Calcular el subtotal correcto
$subtotal_correcto = $Cantidad * $CostoUnitario;
if ($Subtotal != $subtotal_correcto) {
    $errores[] = "Error: El subtotal calculado no coincide con el valor ingresado (Subtotal Correcto: $subtotal_correcto).";
    $Subtotal = $subtotal_correcto; // Corregir el valor
}

// Mostrar errores si existen
if (!empty($errores)) {
    echo "Se encontraron los siguientes errores:<br>";
    foreach ($errores as $error) {
        echo "- " . $error . "<br>";
    }
    echo "<br>Los campos corregidos se insertarán en la base de datos.<br>";
}

// Insertar el detalle de ventas SI NO HAY ERRORES CRÍTICOS
if (empty($errores) || (count($errores) == 1 && (strpos($errores[0], 'costo unitario') !== false)) || (count($errores) == 1 && (strpos($errores[0], 'subtotal') !== false)) || (count($errores) == 2 && ((strpos($errores[0], 'costo unitario') !== false && strpos($errores[1], 'subtotal') !== false) || (strpos($errores[1], 'costo unitario') !== false && strpos($errores[0], 'subtotal') !== false)))) {
    $sql = "INSERT INTO DetalleVentas (IDventa, IDproducto, Cantidad, CostoUnitario, Subtotal) VALUES ('$IDventa', '$IDproducto', '$Cantidad', '$CostoUnitario', '$Subtotal')";
    $query = mysqli_query($con, $sql);

    if ($query) {
        // Calcular y actualizar el total en la tabla Ventas
        $sql_suma_subtotal = "SELECT SUM(Subtotal) AS TotalSubtotal FROM DetalleVentas WHERE IDventa = '$IDventa'";
        $query_suma_subtotal = mysqli_query($con, $sql_suma_subtotal);
        $row_suma_subtotal = mysqli_fetch_assoc($query_suma_subtotal);
        $total_venta = $row_suma_subtotal['TotalSubtotal'];

        $sql_actualizar_venta = "UPDATE Ventas SET Total = '$total_venta' WHERE IDventa = '$IDventa'";
        $query_actualizar_venta = mysqli_query($con, $sql_actualizar_venta);

        if ($query_actualizar_venta) {
            Header("Location: DetalleVentas.php");
            exit();
        } else {
            echo "Error al actualizar el total de la venta: " . mysqli_error($con);
        }
    } else {
        echo "Error al insertar el detalle de ventas: " . mysqli_error($con);
    }
} else {
    echo "<br>No se pudo insertar el registro debido a los errores encontrados.";
}

?>