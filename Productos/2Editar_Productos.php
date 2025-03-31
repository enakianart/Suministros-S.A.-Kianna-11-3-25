<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproducto = $_POST["IDproducto"];
$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$CodigoBarras = $_POST['CodigoBarras'];
$CostoUnitario = $_POST['CostoUnitario'];
$PrecioUnitario = $_POST['PrecioUnitario'];
$StockActual = $_POST['StockActual'];
$StockMinimo = $_POST['StockMinimo'];
$IDunidadMedida = $_POST['IDunidadMedida'];
$IDcategoria = $_POST['IDcategoria'];

// Verificar si el código de barras ya existe en otros registros (excluyendo el actual)
$sql_verificar_codigo = "SELECT CodigoBarras FROM Productos WHERE CodigoBarras = '$CodigoBarras' AND IDproducto != '$IDproducto'";
$query_verificar_codigo = mysqli_query($con, $sql_verificar_codigo);

if (mysqli_num_rows($query_verificar_codigo) > 0) {
    echo "Error: El código de barras '$CodigoBarras' ya existe en otro registro.";
} else {
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
                // Actualizar el producto si el costo es correcto
                $sql = "UPDATE productos SET Nombre='$Nombre', Descripcion='$Descripcion', CodigoBarras='$CodigoBarras', CostoUnitario=$CostoUnitario, PrecioUnitario=$PrecioUnitario, StockActual=$StockActual, StockMinimo=$StockMinimo, IDunidadMedida=$IDunidadMedida, IDcategoria=$IDcategoria WHERE IDproducto='$IDproducto'";
                $query = mysqli_query($con, $sql);

                if ($query) {
                    Header("Location: Productos.php");
                } else {
                    echo "Error al actualizar el producto: " . mysqli_error($con);
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
}
?>