<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$CodigoBarras = $_POST['CodigoBarras'];
$CostoUnitario = $_POST['CostoUnitario']; // Obtener el costo ingresado por el usuario
$PrecioUnitario = $_POST['PrecioUnitario'];
$StockActual = $_POST['StockActual'];
$StockMinimo = $_POST['StockMinimo'];
$IDunidadMedida = $_POST['IDunidadMedida'];
$IDcategoria = $_POST['IDcategoria'];

// Verificar si el código de barras ya existe
$sql_verificar_codigo = "SELECT CodigoBarras FROM Productos WHERE CodigoBarras = '$CodigoBarras'";
$query_verificar_codigo = mysqli_query($con, $sql_verificar_codigo);

if (mysqli_num_rows($query_verificar_codigo) > 0) {
    echo "Error: El código de barras '$CodigoBarras' ya existe en otro registro.";
} else {
    // Buscar el costo correcto del artículo
    $sql_articulo = "SELECT Costo FROM Articulos WHERE Articulo = '$Nombre'";
    $query_articulo = mysqli_query($con, $sql_articulo);

    if ($row_articulo = mysqli_fetch_assoc($query_articulo)) {
        $costo_correcto = $row_articulo['Costo'];

        // Validar si el costo ingresado coincide con el costo correcto
        if ($CostoUnitario == $costo_correcto) {
            // Insertar el producto si el costo es correcto
            $sql = "INSERT INTO Productos (Nombre, Descripcion, CodigoBarras, CostoUnitario, PrecioUnitario, StockActual, StockMinimo, IDunidadMedida, IDcategoria) VALUES ('$Nombre', '$Descripcion', '$CodigoBarras', $CostoUnitario, $PrecioUnitario, $StockActual, $StockMinimo, $IDunidadMedida, $IDcategoria)";

            $query = mysqli_query($con, $sql);

            if ($query) {
                Header("Location: Productos.php");
            } else {
                echo "Error al insertar el producto: " . mysqli_error($con);
            }
        } else {
            echo "Error: El costo unitario ingresado (" . $CostoUnitario . ") no coincide con el costo correcto del artículo (" . $costo_correcto . ").";
        }
    } else {
        echo "No se encontró el artículo: " . $Nombre;
    }
}
?>