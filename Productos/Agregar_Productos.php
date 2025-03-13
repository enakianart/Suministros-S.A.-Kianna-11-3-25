<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$CodigoBarras = $_POST['CodigoBarras'];
$CostoUnitario = $_POST['CostoUnitario'];
$PrecioUnitario = $_POST['PrecioUnitario'];
$StockActual = $_POST['StockActual'];
$StockMinimo = $_POST['StockMinimo'];
$IDunidadMedida = $_POST['IDunidadMedida'];
$IDcategoria = $_POST['IDcategoria'];

echo $Nombre." ".$Descripcion." ".$CodigoBarras." ".$CostoUnitario." ".$PrecioUnitario." ".$StockActual." ".$StockMinimo." ".$IDunidadMedida." ".$IDcategoria;


$sql = "INSERT INTO productos (Nombre, Descripcion, CodigoBarras, CostoUnitario, PrecioUnitario, StockActual, StockMinimo, IDunidadMedida, IDcategoria) VALUES ('$Nombre', '$Descripcion', $CodigoBarras, $CostoUnitario, $PrecioUnitario, $StockActual, $StockMinimo, $IDunidadMedida, $IDcategoria)";

$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Productos.php");
} else {
   
    echo "Error al insertar el producto: " . mysqli_error($con); 
}

?>