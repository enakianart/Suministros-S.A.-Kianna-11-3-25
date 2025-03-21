
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproducto=$_GET["IDdetalleCompra"];

$sql="DELETE FROM detalle_compras WHERE IDdetalleCompra='$IDdetalleCompra'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: DetalleCompras.php");
}else{

}

?>
