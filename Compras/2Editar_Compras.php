<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDcompra = $_POST['IDcompra'];
$FechaCompra = $_POST['FechaCompra'];
$NumeroFactura = $_POST['NumeroFactura'];
$FechaEstimadaEntrega = $_POST['FechaEstimadaEntrega'];
$EstadoCompra = $_POST['EstadoCompra'];
$RecepcionProductos = $_POST['RecepcionProductos'];
$CostoTotal = $_POST['CostoTotal'];
$IDproveedor = $_POST['IDproveedor'];
$IDmetodoPago = $_POST['IDmetodoPago'];

$errores = array();

// Validar que NumeroFactura sea único (excluyendo el registro actual)
$sql_check_serie = "SELECT NumeroFactura FROM Compras WHERE NumeroFactura = '$NumeroFactura' AND IDcompra != '$IDcompra'";
$result_serie = mysqli_query($con, $sql_check_serie);
if (mysqli_num_rows($result_serie) > 0) {
    $errores[] = "Error: El número de Factura ya existe en otro registro.";
}

if (empty($errores)) {
    $sql = "UPDATE compras SET FechaCompra='$FechaCompra', NumeroFactura='$NumeroFactura', FechaEstimadaEntrega='$FechaEstimadaEntrega', EstadoCompra='$EstadoCompra', RecepcionProductos='$RecepcionProductos', CostoTotal=$CostoTotal, IDproveedor=$IDproveedor, IDmetodoPago='$IDmetodoPago' WHERE IDcompra='$IDcompra'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: Compras.php?mensaje=exito_editar");
        exit();
    } else {
        echo "Error al actualizar la compra: " . mysqli_error($con);
    }
} else {
    foreach ($errores as $error) {
        echo "<div style='color: red;'>$error</div>";
    }
    include("1Actualizar_Compras.php?IDcompra=" . $IDcompra); 
    exit();
}

mysqli_close($con);

?>