<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDventa=$_GET["IDventa"];

// eliminamos los detalles de venta asociados a esta venta
$sql_detalles = "DELETE FROM DetalleVentas WHERE IDventa='$IDventa'";
$query_detalles = mysqli_query($con, $sql_detalles);

// eliminamos la venta
$sql_venta="DELETE FROM ventas WHERE IDventa='$IDventa'";
$query_venta = mysqli_query($con, $sql_venta);

if($query_venta){
    Header("Location: Ventas.php");
}else{

    echo "Error al eliminar la venta.";
}

?>