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
$con = connection();

$sql = "SELECT * FROM articulos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Articulos</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Articulos ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


    <div class="articulos-form">
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario articulos: </font>
    </center>

    <form action="Agregar_Articulos.php" method="POST">
            
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="text" name="Articulo" placeholder="Articulo"> </td>
            <td> <input type="number" name="Costo" placeholder="Costo"> </td>
            <td> <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select> </td>

            </tr>

        </table>
            <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="articulo-table">
    <center> <font face="Agency FB"> <h1> Articulos Registrados: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
         
                <tr>
                    <th>IDarticulo</th>
                    <th>Articulo</th>
                    <th>Costo</th>
                    <th>Estado</th>

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['IDarticulo'] ?></td>
                        <td><?= $row['Articulo'] ?></td>
                        <td><?= $row['Costo'] ?></td>
                        <td><?= $row['Estado'] ?></td>

                        <th><a href="1Actualizar_Articulos.php?IDarticulo=<?= $row['IDarticulo'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Articulos.php?IDarticulo=<?= $row['IDarticulo'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

</body>

</html>