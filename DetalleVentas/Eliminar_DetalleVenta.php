<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDdetalleVenta=$_GET["IDdetalleVenta"];

// Obtener el ID de la venta y el subtotal del detalle de venta a eliminar
$sql_select = "SELECT IDVenta, SubTotal FROM DetalleVentas WHERE IDdetalleVenta='$IDdetalleVenta'";
$result_select = mysqli_query($con, $sql_select);

if ($row_select = mysqli_fetch_assoc($result_select)) {
    $IDVenta = $row_select["IDVenta"];
    $subtotal_a_descontar = $row_select["SubTotal"];

    // Eliminar el detalle de venta
    $sql_delete = "DELETE FROM DetalleVentas WHERE IDdetalleVenta='$IDdetalleVenta'";
    $query_delete = mysqli_query($con, $sql_delete);

    if($query_delete){
        // Descontar el subtotal del total de la venta
        $sql_update_venta = "UPDATE Ventas SET Total = Total - $subtotal_a_descontar WHERE IDVenta='$IDVenta'";
        $query_update_venta = mysqli_query($con, $sql_update_venta);

        if ($query_update_venta) {
            Header("Location: DetalleVentas.php?IDVenta=$IDVenta"); // Redirigir pasando el IDVenta para recargar los detalles actualizados
        } else {
            // Manejar el error al actualizar el total de la venta
            echo "Error al actualizar el total de la venta: " . mysqli_error($con);
        }
    } else {
        // Manejar el error al eliminar el detalle de venta
        echo "Error al eliminar el detalle de venta: " . mysqli_error($con);
    }
} else {
    // Manejar el caso en que no se encontró el detalle de venta
    echo "No se encontró el detalle de venta con ID: " . $IDdetalleVenta;
}

?>