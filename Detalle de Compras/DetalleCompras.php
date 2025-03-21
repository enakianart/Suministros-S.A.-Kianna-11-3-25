<?php

function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect = mysqli_connect($servername, $username, $password, $database);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connect;
}

$con = connection();

$sql_compras = "SELECT * FROM compras";
$query_compras = mysqli_query($con, $sql_compras);

$sql_productos = "SELECT * FROM Productos";
$query_productos = mysqli_query($con, $sql_productos);

$sql_detalle_compras = "SELECT * FROM Detalle_Compras";
$query_detalle_compras = mysqli_query($con, $sql_detalle_compras);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros S.A. Compras</title>
</head>

<body bgcolor="#fcb0a0" style="margin: 30px;">

    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">
    <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
        <tr>
            <th rowspan="1"><font size="100" face="Agency FB"> ~ Tabla Detalle de Compras ~ <br> Suministros S.A. </font></th>
            <th rowspan="1"><img src="../Hiki feli normal tamanio grandote.png" height="225"/></th>
        </tr>
    </table>
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">

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

    <br>


    <div class="detalle_compras-form">
        <center>
            <font size="6" face="Agency FB"> <h1>Formulario Detalle de Compras: </h1></font>
        </center>

        <form action="Agregar_DetalleCompras.php" method="POST">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
                <tr>
                    <td><input type="number" name="Cantidad" placeholder="Cantidad"></td>
                    <td><input type="number" name="CostoUnitario" placeholder="CostoUnitario"></td>
                </tr>

                <tr> 
                    <td><input type="number" name="IDcompra" placeholder="IDcompra"></td>
                    <td><input type="number" name="IDproducto" placeholder="IDproducto"></td>
                </tr>
            </table>
            <input type="submit" value="Agregar" style="padding: 15px 30px; font-size: 18px;">
        </form>
    </div>

    <div class="ComprasDetalle-table">
    <center><font face="Agency FB"> <h1> Detalles de Compras Registradas: </h1></font></center>

    <font size="5" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            <tr>
                <th>IDdetalleCompra</th>
                <th>Cantidad</th>
                <th>CostoUnitario</th>
                <th>IDcompra</th>
                <th>IDproducto</th>
                <th></th>
                <th></th>
            </tr>

            <?php while ($row_detalle = mysqli_fetch_array($query_detalle_compras)): ?>
                <tr>
                    <td><?= $row_detalle['IDdetalleCompra'] ?></td>
                    <td><?= $row_detalle['Cantidad'] ?></td>
                    <td><?= $row_detalle['CostoUnitario'] ?></td>
                    <td><?= $row_detalle['IDcompra'] ?></td>
                    <td><?= $row_detalle['IDproducto'] ?></td>
                    <th><a href="1Actualizar_DetalleCompras.php?IDdetalleCompra=<?= $row_detalle['IDdetalleCompra'] ?>">Editar</a></th>
                    <th><a href="Eliminar_DetalleCompras.php?IDdetalleCompra=<?= $row_detalle['IDdetalleCompra'] ?>">Eliminar</a></th>
                </tr>
            <?php endwhile; ?>
        </table>
    </font>
</div>
</body>
</html>