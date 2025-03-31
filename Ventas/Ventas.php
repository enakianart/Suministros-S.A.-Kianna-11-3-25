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

$sql_Ventas = "SELECT * FROM Ventas";
$query_Ventas = mysqli_query($con, $sql_Ventas);

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
    <title> Suministros S.A. Clientes</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Ventas ~ <br> Suministros S.A. </font></th>

                

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
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario Ventas: </font>
    </center>

    <form action="Agregar_Ventas.php" method="POST">
                
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="number" name="IDcliente" placeholder="IDcliente"> </td>
            <td> <label for="FechaVenta"><font size="5" face="Agency FB"> FechaVenta: </font></label>
            <input type="date" name="FechaVenta" placeholder="FechaVenta"> </td>
            </tr>

            <tr>
            <td> <input type="number" name="NumeroFactura" placeholder="NumeroFactura"> </td>
            <td> <input type="text" name="Comentario" placeholder="Comentario"> </td>
            <td> <input type="number" name="IDmetodoPago" placeholder="IDmetodoPago"> </td>
            
            </tr>

            <tr>
            <td> <label for="CondicionPago"><font size="5" face="Agency FB"> CondicionPago: </font></label> <select name="CondicionPago">
                <option value="Contado">Contado</option>
                <option value="Credito">Credito</option>
            </select> </td>
            
            <td> <label for="FechaEstimadaEntrega"><font size="5" face="Agency FB"> FechaEstimadaEntrega: </font></label>
            <input type="date" name="FechaEstimadaEntrega" placeholder="FechaEstimadaEntrega"> </td>

            <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                <option value="Pendiente">Pendiente</option>
                <option value="Pagada">Pagada</option>
                <option value="Proceso">Proceso</option>
                <option value="Entregada">Entregada</option>
                <option value="Cancelada">Cancelada</option>
            </select> </td>

            <td> <input type="number" name="Total" placeholder="Total"> </td>

            
            </tr>

        </table>
                <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="Ventas-table">
    <center> <font face="Agency FB"> <h1> Ventas Registradas: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            
            
                <tr>
                    <th>IDventa</th>
                    <th>IDcliente</th> 
                    <th>FechaVenta</th>
                    <th>NumeroFactura</th>
                    <th>Comentario</th>
                    <th>IDmetodoPago</th> 
                    <th>CondicionPago</th>
                    <th>FechaEstimadaEntrega</th>
                    <th>Estado</th>
                    <th>Total</th>


                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query_Ventas)): ?>
                    <tr>
                        <td><?= $row['IDventa'] ?></td>
                        <td><?= $row['IDcliente'] ?></td>
                        <td><?= $row['FechaVenta'] ?></td>
                        <td><?= $row['NumeroFactura'] ?></td>
                        <td><?= $row['Comentario'] ?></td>
                        <td><?= $row['IDmetodoPago'] ?></td>
                        <td><?= $row['CondicionPago'] ?></td>
                        <td><?= $row['FechaEstimadaEntrega'] ?></td>
                        <td><?= $row['Estado'] ?></td>
                        <td><?= $row['Total'] ?></td>


                        <th><a href="1Actualizar_Ventas.php?IDventa=<?= $row['IDventa'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Ventas.php?IDventa=<?= $row['IDventa'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>


    
</body>

</html>