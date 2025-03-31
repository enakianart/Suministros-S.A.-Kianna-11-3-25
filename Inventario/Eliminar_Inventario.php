
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDinventario=$_GET["IDinventario"];

$sql="DELETE FROM inventario WHERE IDinventario='$IDinventario'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Inventario.php");
}else{

}

?>
