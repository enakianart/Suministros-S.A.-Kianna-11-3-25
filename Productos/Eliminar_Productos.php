
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproducto=$_GET["IDproducto"];

$sql="DELETE FROM productos WHERE IDproducto='$IDproducto'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Productos.php");
}else{

}

?>
