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

$sql_comprasRegistradas = "SELECT * FROM compras";
$query_comprasRegistradas = mysqli_query($con, $sql_comprasRegistradas);

$sql_proveedores = "SELECT * FROM Proveedores";
$query_proveedores = mysqli_query($con, $sql_proveedores);

$sql_metodo_pago = "SELECT * FROM MetodoPago";
$query_metodo_pago = mysqli_query($con, $sql_metodo_pago);

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
            <th rowspan="1"><font size="100" face="Agency FB"> ~ Tabla Compras y detalle ~ <br> Suministros S.A. </font></th>
            <th rowspan="1"><img src="../Hiki feli normal tamanio grandote.png" height="225"/></th>
        </tr>
    </table>
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">

    <table align="center">
        <tr>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Proveedores:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDproveedor</th>
                            <th>NombreProveedor</th>
                        </tr>
                        <?php while ($row_proveedor = mysqli_fetch_array($query_proveedores)): ?>
                            <tr>
                                <td><?= $row_proveedor['IDproveedor'] ?></td>
                                <td><?= $row_proveedor['NombreProveedor'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Métodos de Pago:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDmetodoPago</th>
                            <th>MetodoPago</th>
                        </tr>
                        <?php while ($row_metodo = mysqli_fetch_array($query_metodo_pago)): ?>
                            <tr>
                                <td><?= $row_metodo['IDmetodoPago'] ?></td>
                                <td><?= $row_metodo['MetodoPago'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
        </tr>
    </table>

    <br>

    <div class="compras-form">
        <center>
            <font size="6" face="Agency FB"> <h1>Formulario Compras: </h1></font>
        </center>

        <form action="Agregar_Compras.php" method="POST">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
                <tr>
                    <td><label for="FechaCompra">FechaCompra:</label>
                    <input type="date" name="FechaCompra" placeholder="FechaCompra"></td>

                    <td><input type="number" name="NumeroFactura" placeholder="NumeroFactura"></td>

                    <td><label for="FechaEstimadaEntrega">FechaEstimadaEntrega:</label>
                    <input type="date" name="FechaEstimadaEntrega" placeholder="FechaEstimadaEntrega"></td>
                </tr>

                <tr>
                    <td>
                        <label for="EstadoCompra"><font size="5" face="Agency FB"> Estado de Compra: </font></label>
                        <select name="EstadoCompra">
                            <option value="Pendiente">Pendiente</option>
                            <option value="En transito">En transito</option>
                            <option value="Entregada">Entregada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </td>

                    <td>
                        <label for="RecepcionProductos"><font size="5" face="Agency FB"> Recepcion de Productos: </font></label>
                        <select name="RecepcionProductos">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </td>

                    <td><input type="number" name="CostoTotal" placeholder="CostoTotal"></td>
                </tr>

                <tr>
                    <td><input type="number" name="IDproveedor" placeholder="IDproveedor"></td>
                    <td><input type="number" name="IDmetodoPago" placeholder="IDmetodoPago"></td>
                </tr>
            </table>
            <input type="submit" value="Agregar" style="padding: 15px 30px; font-size: 18px;">
        </form>
    </div>

    <div class="compras-table">
    <center><font face="Agency FB"> <h1> Compras Registradas: </h1></font></center>

    <font size="5" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            <tr>
                <th>IDcompra</th>
                <th>FechaCompra</th>
                <th>NumeroFactura</th>
                <th>FechaEstimadaEntrega</th>
                <th>EstadoCompra</th>
                <th>RecepcionProductos</th>
                <th>CostoTotal</th>
                <th>IDproveedor</th>
                <th>IDmetodoPago</th>
                <th></th>
                <th></th>
            </tr>

            <?php while ($row_compras_display = mysqli_fetch_array($query_comprasRegistradas)): ?>
                <tr>
                    <td><?= $row_compras_display['IDcompra'] ?></td>
                    <td><?= $row_compras_display['FechaCompra'] ?></td>
                    <td><?= $row_compras_display['NumeroFactura'] ?></td>
                    <td><?= $row_compras_display['FechaEstimadaEntrega'] ?></td>
                    <td><?= $row_compras_display['EstadoCompra'] ?></td>
                    <td><?= $row_compras_display['RecepcionProductos'] ?></td>
                    <td><?= $row_compras_display['CostoTotal'] ?></td>
                    <td><?= $row_compras_display['IDproveedor'] ?></td>
                    <td><?= $row_compras_display['IDmetodoPago'] ?></td>
                    <th><a href="1Actualizar_Compras.php?IDcompra=<?= $row_compras_display['IDcompra'] ?>">Editar</a></th>
                    <th><a href="Eliminar_Compras.php?IDcompra=<?= $row_compras_display['IDcompra'] ?>">Eliminar</a></th>
                </tr>
            <?php endwhile; ?>
        </table>
    </font>
</div>

<button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>

</body>
</html>