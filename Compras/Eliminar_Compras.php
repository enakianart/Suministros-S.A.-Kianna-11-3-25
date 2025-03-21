
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproducto=$_GET["IDcompra"];

$sql="DELETE FROM compras WHERE IDcompra='$IDcompra'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Compras.php");
}else{

}

?>
