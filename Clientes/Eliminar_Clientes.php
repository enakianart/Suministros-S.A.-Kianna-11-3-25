
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDcliente=$_GET["IDcliente"];

$sql="DELETE FROM clientes WHERE IDcliente='$IDcliente'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Clientes.php");
}else{

}

?>
