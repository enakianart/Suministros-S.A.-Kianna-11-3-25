<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$UnidadMedida = $_POST['UnidadMedida'];
$CostoPromedioUnidadIngresado = $_POST['CostoPromedioUnidad'];

// Calcular el costo promedio real basado en los productos
$sql_productos_unidad = "SELECT p.CostoUnitario FROM Productos p JOIN UnidadMedida u ON p.IDunidadMedida = u.IDunidadMedida WHERE u.UnidadMedida = '$UnidadMedida'";
$result_productos = mysqli_query($con, $sql_productos_unidad);

$total_costo = 0;
$num_productos = 0;

while ($row_producto = mysqli_fetch_assoc($result_productos)) {
    $total_costo += $row_producto['CostoUnitario'];
    $num_productos++;
}

$costo_promedio_real = ($num_productos > 0) ? ($total_costo / $num_productos) : 0;

if ($CostoPromedioUnidadIngresado == $costo_promedio_real) {
    $sql_insert = "INSERT INTO UnidadMedida (UnidadMedida, CostoPromedioUnidad) VALUES ('$UnidadMedida', '$CostoPromedioUnidadIngresado')";
    $query_insert = mysqli_query($con, $sql_insert);

    if ($query_insert) {
        Header("Location: UnidadMedida.php?mensaje=exito_agregar");
        exit();
    } else {
        echo "Error al insertar la Unidad de Medida: " . mysqli_error($con);
    }
} else {
    echo "<div style='color: red;'>Error: El costo promedio por unidad ingresado (" . number_format($CostoPromedioUnidadIngresado, 2) . ") no coincide con el costo promedio real calculado para la unidad de medida '" . $UnidadMedida . "' (" . number_format($costo_promedio_real, 2) . "). Por favor, verifica el valor.</div>";
    // Incluir el formulario nuevamente para que el usuario pueda corregir
    include("UnidadMedida.php"); // Asegúrate de que esta ruta sea correcta para mostrar el formulario
    exit();
}

mysqli_close($con);
?>