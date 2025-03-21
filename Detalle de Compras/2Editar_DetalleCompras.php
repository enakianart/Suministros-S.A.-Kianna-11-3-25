<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDdetalleCompra = $_POST["IDdetalleCompra"];
$Cantidad = $_POST['Cantidad'];
$CostoUnitario = $_POST['CostoUnitario'];
$IDcompra = $_POST['IDcompra'];
$IDproducto = $_POST['IDproducto'];

// Obtener el nombre del artículo asociado al producto
$sql_nombre_articulo = "SELECT Articulo FROM Articulos WHERE IDarticulo = (SELECT IDarticulo FROM Productos WHERE IDproducto = '$IDproducto')";
$query_nombre_articulo = mysqli_query($con, $sql_nombre_articulo);

if ($row_nombre_articulo = mysqli_fetch_assoc($query_nombre_articulo)) {
    $nombre_articulo = $row_nombre_articulo['Articulo'];

    // Buscar el costo correcto del artículo
    $sql_costo_articulo = "SELECT Costo FROM Articulos WHERE Articulo = '$nombre_articulo'";
    $query_costo_articulo = mysqli_query($con, $sql_costo_articulo);

    if ($row_costo_articulo = mysqli_fetch_assoc($query_costo_articulo)) {
        $costo_correcto = $row_costo_articulo['Costo'];

        // Validar si el costo unitario coincide con el costo del artículo
        if ($CostoUnitario == $costo_correcto) {
            // Actualizar el detalle de compra si el costo es correcto
            $sql = "UPDATE Detalle_Compras SET Cantidad=$Cantidad, CostoUnitario=$CostoUnitario, IDcompra=$IDcompra, IDproducto=$IDproducto WHERE IDdetalleCompra='$IDdetalleCompra'";
            $query = mysqli_query($con, $sql);

            if ($query) {
                Header("Location: DetalleCompras.php"); // Asegúrate de que esta página exista
            } else {
                echo "Error al actualizar el detalle de compra: " . mysqli_error($con);
            }
        } else {
            echo "Error: El costo unitario ingresado (" . $CostoUnitario . ") no coincide con el costo correcto del artículo (" . $costo_correcto . ").";
        }
    } else {
        echo "No se encontró el costo del artículo: " . $nombre_articulo;
    }
} else {
    echo "No se encontró el artículo asociado al producto con ID: " . $IDproducto;
}
?>