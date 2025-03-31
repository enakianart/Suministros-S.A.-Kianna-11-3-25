
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDventa=$_GET['IDventa'];

    $sql="SELECT * FROM Ventas WHERE IDventa='$IDventa'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

    $sql_metodo_pago = "SELECT * FROM MetodoPago";
    $query_metodo_pago = mysqli_query($con, $sql_metodo_pago);

    $sql_clientes = "SELECT * FROM Clientes";
    $query_clientes = mysqli_query($con, $sql_clientes);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Ventas</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla ventas ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div style="display: flex; justify-content: center;">

        <center>
            <font size="5" face="Agency FB"><h1>Métodos de Pago:</h1></font>
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

        <br>

        <center>
            <font size="5" face="Agency FB"><h1> Clientes:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDcliente</th>
                    <th>NombreCliente</th>
                </tr>
                <?php while ($row_clientes = mysqli_fetch_array($query_clientes)): ?>
                    <tr>
                        <td><?= $row_clientes['IDcliente'] ?></td>
                        <td><?= $row_clientes['NombreCliente'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>
<br>


        <div class="Ventas-form">
        <form action="2Editar_Ventas.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDventa" value="<?= $row['IDventa']?>"> </td>

                <td> <label for="IDcliente">IDcliente:</label>
                <input type="number" name="IDcliente" placeholder="IDcliente" value="<?= $row['IDcliente']?>"> </td>
                <td> <label for="FechaVenta">FechaVenta:</label>
                 <input type="date" name="FechaVenta" placeholder="FechaVenta" value="<?= $row['FechaVenta']?>"></td>
                </tr>

                <tr> 
                <td> <label for="NumeroFactura">NumeroFactura:</label>
                 <input type="number" name="NumeroFactura" placeholder="NumeroFactura" value="<?= $row['NumeroFactura']?>"> </td>

                <td> <label for="Comentario">Comentario:</label>
                 <input type="text" name="Comentario" placeholder="Comentario" value="<?= $row['Comentario']?>"> </td>

                <td> <label for="IDmetodoPago">IDmetodoPago:</label>
                 <input type="number" name="IDmetodoPago" placeholder="IDmetodoPago" value="<?= $row['IDmetodoPago']?>"> </td>
                </tr>
                
                <tr>
                <td> <label for="CondicionPago">CondicionPago:</label> <select name="CondicionPago">
                    <option value="Contado">Contado</option>
                    <option value="Credito">Credito</option>
                </select> </td> 
                

                <td> <label for="FechaEstimadaEntrega">FechaEstimadaEntrega:</label>
                 <input type="date" name="FechaEstimadaEntrega" placeholder="FechaEstimadaEntrega" value="<?= $row['FechaEstimadaEntrega']?>"> </td>


                 <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                <option value="Pendiente">Pendiente</option>
                <option value="Pagada">Pagada</option>
                <option value="Proceso">Proceso</option>
                <option value="Entregada">Entregada</option>
                <option value="Cancelada">Cancelada</option>
            </select> </td>

            <td> <label for="Total">Total:</label>
            <input type="Total" name="Total" placeholder="Total" value="<?= $row['Total']?>"> </td>
               
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
