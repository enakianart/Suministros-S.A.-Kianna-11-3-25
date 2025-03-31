
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDcliente=$_GET['IDcliente'];

    $sql="SELECT * FROM clientes WHERE IDcliente='$IDcliente'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

    $sql_metodo_pago = "SELECT * FROM MetodoPago";
    $query_metodo_pago = mysqli_query($con, $sql_metodo_pago);

    $sql_tipo_clientes = "SELECT * FROM TipoClientes";
    $query_tipo_clientes = mysqli_query($con, $sql_tipo_clientes);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Clientes</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla clientes ~ <br> Suministros S.A. </font></th>

               

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
            <font size="5" face="Agency FB"><h1>Tipos de Cliente:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDtipoCliente</th>
                    <th>TipoClientes</th>
                </tr>
                <?php while ($row_tipo_clientes = mysqli_fetch_array($query_tipo_clientes)): ?>
                    <tr>
                        <td><?= $row_tipo_clientes['IDtipoCliente'] ?></td>
                        <td><?= $row_tipo_clientes['TipoClientes'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>
<br>


        <div class="clientes-form">
        <form action="2Editar_Clientes.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDcliente" value="<?= $row['IDcliente']?>"> </td>

                <td> <label for="NombreCliente">Nombre del cliente:</label>
                <input type="text" name="NombreCliente" placeholder="NombreCliente" value="<?= $row['NombreCliente']?>"> </td>
                <td> <label for="Telefono">Telefono:</label>
                 <input type="text" name="Telefono" placeholder="Telefono" value="<?= $row['Telefono']?>"></td>
                </tr>

                <tr> 
                <td> <label for="Correo">Correo:</label>
                 <input type="email" name="Correo" placeholder="Correo" value="<?= $row['Correo']?>"> </td>
                <td> <label for="DireccionFactura">Direccion de la Factura:</label>
                 <input type="text" name="DireccionFactura" placeholder="DireccionFactura" value="<?= $row['DireccionFactura']?>"> </td>
                <td> <label for="DireccionEnvio">Direccion del Envio:</label>
                 <input type="text" name="DireccionEnvio" placeholder="DireccionEnvio" value="<?= $row['DireccionEnvio']?>"> </td>
                </tr>
                
                <tr>
                 <td> <label for="IDmetodoPago">IDmetodoPago:</label> 
                 <input type="number" name="IDmetodoPago" placeholder="IDmetodoPago" value="<?= $row['IDmetodoPago']?>"> </td>

                 <td> <label for="IDtipoCliente">IDtipoCliente:</label> 
                 <input type="number" name="IDtipoCliente" placeholder="IDtipoCliente" value="<?= $row['IDtipoCliente']?>"> </td>


                <td> <label for="Estado">Estado:</label> <select name="Estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select> </td>
               
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
