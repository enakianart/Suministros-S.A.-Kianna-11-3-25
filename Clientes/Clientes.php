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

$con = connection();

$sql_clientes = "SELECT * FROM clientes";
$query_clientes = mysqli_query($con, $sql_clientes);

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
    <title> Suministros S.A. Clientes</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Clientes ~ <br> Suministros S.A. </font></th>

                

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
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario clientes: </font>
    </center>

    <form action="Agregar_Clientes.php" method="POST">
                
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="text" name="NombreCliente" placeholder="NombreCliente"> </td>
            <td> <input type="text" name="Telefono" placeholder="Telefono"> </td>
            <td> <input type="email" name="Correo" placeholder="Correo"> </td>
            </tr>

            <tr>
            <td> <input type="text" name="DireccionFactura" placeholder="DireccionFactura"> </td>
            <td> <input type="text" name="DireccionEnvio" placeholder="DireccionEnvio"> </td>
            
            </tr>

            <tr>
            <td> <input type="number" name="IDmetodoPago" placeholder="IDmetodoPago"> </td>
            
            <td> <input type="number" name="IDtipoCliente" placeholder="IDtipoCliente"> </td>


            <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select> </td>
            
            </tr>

        </table>
                <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="clientes-table">
    <center> <font face="Agency FB"> <h1> Clientes Registrados: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            
            
                <tr>
                    <th>IDcliente</th>
                    <th>NombreCliente</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>DireccionFactura</th> 
                    <th>DireccionEnvio</th>
                    <th>IDmetodoPago</th>
                    <th>IDtipoCliente</th>
                    <th>Estado</th>

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query_clientes)): ?>
                    <tr>
                        <td><?= $row['IDcliente'] ?></td>
                        <td><?= $row['NombreCliente'] ?></td>
                        <td><?= $row['Telefono'] ?></td>
                        <td><?= $row['Correo'] ?></td>
                        <td><?= $row['DireccionFactura'] ?></td>
                        <td><?= $row['DireccionEnvio'] ?></td>
                        <td><?= $row['IDmetodoPago'] ?></td>
                        <td><?= $row['IDtipoCliente'] ?></td>
                        <td><?= $row['Estado'] ?></td>

                        <th><a href="1Actualizar_Clientes.php?IDcliente=<?= $row['IDcliente'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Clientes.php?IDcliente=<?= $row['IDcliente'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    
</body>

</html>