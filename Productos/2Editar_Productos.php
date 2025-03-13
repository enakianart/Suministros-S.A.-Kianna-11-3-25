<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproducto=$_POST["IDproducto"];
$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$CodigoBarras = $_POST['CodigoBarras'];
$CostoUnitario = $_POST['CostoUnitario'];
$PrecioUnitario = $_POST['PrecioUnitario'];
$StockActual = $_POST['StockActual'];
$StockMinimo = $_POST['StockMinimo'];
$IDunidadMedida = $_POST['IDunidadMedida'];
$IDcategoria = $_POST['IDcategoria'];

$sql="UPDATE productos SET Nombre='$Nombre', Descripcion='$Descripcion', CodigoBarras=$CodigoBarras, CostoUnitario=$CostoUnitario, PrecioUnitario=$PrecioUnitario, StockActual=$StockActual, StockMinimo=$StockMinimo, IDunidadMedida=$IDunidadMedida, IDcategoria=$IDcategoria WHERE IDproducto='$IDproducto'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Productos.php");
}else{

}

?>
