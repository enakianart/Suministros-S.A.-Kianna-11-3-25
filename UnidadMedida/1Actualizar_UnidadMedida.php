
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDunidadMedida=$_GET['IDunidadMedida'];

    $sql="SELECT * FROM unidadmedida WHERE IDunidadMedida='$IDunidadMedida'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Unidades de Medida</title>
</head>

<body  bgcolor="#a0aafc" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla Unidades de Medida ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >

<br>


        <div class="UnidadMedida-form">
        <form action="2Editar_UnidadMedida.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#a0aafc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDunidadMedida" value="<?= $row['IDunidadMedida']?>"> </td>

                <td> <label for="UnidadMedida">UnidadMedida:</label>
                <input type="text" name="UnidadMedida" placeholder="UnidadMedida" value="<?= $row['UnidadMedida']?>"> </td>

                <td> <label for="CostoPromedioUnidad">CostoPromedioUnidad:</label>
                 <input type="number" name="CostoPromedioUnidad" placeholder="CostoPromedioUnidad" value="<?= $row['CostoPromedioUnidad']?>"></td>
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
