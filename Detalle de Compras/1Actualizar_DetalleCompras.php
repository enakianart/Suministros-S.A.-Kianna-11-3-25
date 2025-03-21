<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDdetalleCompra=$_GET['IDdetalleCompra'];

    $sql="SELECT * FROM detalle_compras WHERE IDdetalleCompra='$IDdetalleCompra'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

    $sql_productos = "SELECT * FROM Productos";
    $query_productos = mysqli_query($con, $sql_productos);
    
    $sql_compras = "SELECT * FROM compras";
    $query_compras = mysqli_query($con, $sql_compras);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Productos</title>
</head>

<body bgcolor="#fcb0a0" style="margin: 30px;">

    <hr size="5" color="white" width= "1350" align="center" >
    <hr size="10" color="white" width= "1350" align="center" >
    <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
        <tr>
            <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla productos ~ <br> Suministros S.A. </font></th>
            <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
        </tr>
    </table>
    <hr size="5" color="white" width= "1350" align="center" >
    <hr size="10" color="white" width= "1350" align="center" >

    <table align="center">
        <tr>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Productos:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDproducto</th>
                            <th>Nombre</th>
                        </tr>
                        <?php while ($row_producto = mysqli_fetch_array($query_productos)): ?>
                            <tr>
                                <td><?= $row_producto['IDproducto'] ?></td>
                                <td><?= $row_producto['Nombre'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Compras:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDcompra</th>
                            <th>NumeroFactura</th>
                            <th>FechaCompra</th>
                        </tr>
                        <?php while ($row_compra = mysqli_fetch_array($query_compras)): ?>
                            <tr>
                                <td><?= $row_compra['IDcompra'] ?></td>
                                <td><?= $row_compra['NumeroFactura'] ?></td>
                                <td><?= $row_compra['FechaCompra'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
        </tr>
    </table>


    <div class="DetalleCompras-form">
        <form action="2Editar_DetalleCompras.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            <tr>
                <td> <input type="hidden" name="IDdetalleCompra" value="<?= $row['IDdetalleCompra']?>"> </td>
                <td> <label for="Cantidad">Cantidad:</label>
                <input type="number" name="Cantidad" placeholder="Cantidad" value="<?= $row['Cantidad']?>"> </td>
                <td> <label for="CostoUnitario">CostoUnitario:</label>
                <input type="number" name="CostoUnitario" placeholder="CostoUnitario" value="<?= $row['CostoUnitario']?>"></td>
            </tr>
            <tr> 
                <td> <label for="IDcompra">IDcompra:</label>
                <input type="number" name="IDcompra" placeholder="IDcompra" value="<?= $row['IDcompra']?>"> </td>
                <td> <label for="IDproducto">IDproducto:</label>
                <input type="number" name="IDproducto" placeholder="IDproducto" value="<?= $row['IDproducto']?>"> </td>
            </tr>
            
        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
