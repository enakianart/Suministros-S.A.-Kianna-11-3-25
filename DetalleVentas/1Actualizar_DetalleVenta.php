
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDdetalleVenta=$_GET['IDdetalleVenta'];

    $sql="SELECT * FROM DetalleVentas WHERE IDdetalleVenta='$IDdetalleVenta'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

    $sql_Ventas = "SELECT * FROM Ventas";
    $query_Ventas = mysqli_query($con, $sql_Ventas);
    
    $sql_Productos = "SELECT * FROM Productos";
    $query_Productos = mysqli_query($con, $sql_Productos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar DetalleVentas</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla Detalle de Ventas ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div style="display: flex; justify-content: center;">

        <center>
            <font size="5" face="Agency FB"><h1>Ventas:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDventa</th>
                    <th>FechaVenta</th>
                </tr>
                <?php while ($row_Ventas = mysqli_fetch_array($query_Ventas)): ?>
                    <tr>
                        <td><?= $row_Ventas['IDventa'] ?></td>
                        <td><?= $row_Ventas['FechaVenta'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>

        <center>
            <font size="5" face="Agency FB"><h1>Productos:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDproducto</th> 
                    <th>Nombre</th>
                    <th>CostoUnitario</th>

                </tr>
                <?php while ($row_Productos = mysqli_fetch_array($query_Productos)): ?>
                    <tr>
                        <td><?= $row_Productos['IDproducto'] ?></td>
                        <td><?= $row_Productos['Nombre'] ?></td>
                        <td><?= $row_Productos['CostoUnitario'] ?></td>

                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>
<br>


        <div class="DetalleVentas-form">
        <form action="2Editar_DetalleVentas.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDdetalleVenta" value="<?= $row['IDdetalleVenta']?>"> </td>

                <td> <label for="IDventa">IDventa:</label>
                <input type="number" name="IDventa" placeholder="IDventa" value="<?= $row['IDventa']?>"> </td>

                <td> <label for="IDproducto">IDproducto:</label>
                 <input type="number" name="IDproducto" placeholder="IDproducto" value="<?= $row['IDproducto']?>"></td>
                </tr>

                <tr> 
                <td> <label for="Cantidad">Cantidad:</label>
                 <input type="number" name="Cantidad" placeholder="Cantidad" value="<?= $row['Cantidad']?>"> </td>

                <td> <label for="CostoUnitario">CostoUnitario:</label>
                 <input type="number" name="CostoUnitario" placeholder="CostoUnitario" value="<?= $row['CostoUnitario']?>"> </td>

                <td> <label for="Subtotal">Subtotal:</label>
                 <input type="number" name="Subtotal" placeholder="Subtotal" value="<?= $row['Subtotal']?>"> </td>
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
