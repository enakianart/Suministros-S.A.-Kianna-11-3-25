<?php

function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect=mysqli_connect($servername, $username, $password);

    mysqli_select_db($connect, $database);

    return $connect;

    echo "Estoy conectado";

}

?>
<?php
//require_once("Conexio\ConexionSuminitrosSA.php");
$con = connection();

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Productos</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla productos ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


    <div class="productos-form">
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario productos: </font>
    </center>

    <form action="Agregar_Productos.php" method="POST">
            
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="text" name="Nombre" placeholder="Nombre"> </td>
            <td> <input type="text" name="Descripcion" placeholder="Descripcion"> </td>
            <td> <input type="number" name="CodigoBarras" placeholder="CodigoBarras"> </td>

            </tr>

            <tr>
           <td>  <input type="number" name="CostoUnitario" placeholder="CostoUnitario"> </td>
           <td>  <input type="number" name="PrecioUnitario" placeholder="PrecioUnitario"> </td>
           <td> <input type="number" name="StockActual" placeholder="StockActual"> </td>
           
            </tr>

            <tr>
            <td> <input type="number" name="StockMinimo" placeholder="StockMinimo"> </td>
            <td> <input type="number" name="IDunidadMedida" placeholder="IDunidadMedida"> </td>
            <td>  <input type="number" name="IDcategoria" placeholder="IDcategoria"> </td>
            </tr>

        </table>
            <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="productos-table">
    <center> <font face="Agency FB"> <h1> Productos Registrados: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
         
                <tr>
                    <th>IDproducto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>CodigoBarras</th>
                    <th>CostoUnitario</th>
                    <th>PrecioUnitario</th>
                    <th>StockActual</th> 
                    <th>StockMinimo</th>
                    <th>IDunidadMedida</th>
                    <th>IDcategoria</th>

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['IDproducto'] ?></td>
                        <td><?= $row['Nombre'] ?></td>
                        <td><?= $row['Descripcion'] ?></td>
                        <td><?= $row['CodigoBarras'] ?></td>
                        <td><?= $row['CostoUnitario'] ?></td>
                        <td><?= $row['PrecioUnitario'] ?></td>
                        <td><?= $row['StockActual'] ?></td>
                        <td><?= $row['StockMinimo'] ?></td>
                        <td><?= $row['IDunidadMedida'] ?></td>
                        <td><?= $row['IDcategoria'] ?></td>




                        <th><a href="1Actualizar_Productos.php?IDproducto=<?= $row['IDproducto'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Productos.php?IDproducto=<?= $row['IDproducto'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

</body>

</html>