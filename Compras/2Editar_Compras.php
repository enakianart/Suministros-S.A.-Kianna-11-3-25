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

$sql = "UPDATE compras SET FechaCompra='$FechaCompra', NumeroFactura='$NumeroFactura', FechaEstimadaEntrega='$FechaEstimadaEntrega', EstadoCompra='$EstadoCompra', RecepcionProductos='$RecepcionProductos', CostoTotal=$CostoTotal, IDproveedor=$IDproveedor, IDmetodoPago='$IDmetodoPago' WHERE IDcompra='$IDcompra'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Compras.php");
} else {
    echo "Error al actualizar la compra: " . mysqli_error($con);
}

?>