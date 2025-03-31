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

$sql_unidades = "SELECT * FROM UnidadMedida";
$query_unidades = mysqli_query($con, $sql_unidades);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. UnidadMedida </title>
</head>

<body  bgcolor="#a0aafc" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla UnidadMedida ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >




    <div class="UnidadMedida-form">
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario UnidadMedida: </font>
    </center>

    <form action="Agregar_UnidadMedida.php" method="POST">
            
        <table border="7" bordercolor="white" bgcolor="#a0aafc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="text" name="UnidadMedida" placeholder="UnidadMedida"> </td>
            <td> <input type="number" name="CostoPromedioUnidad" placeholder="CostoPromedioUnidad"> </td>

            </tr>

        </table>
            <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="UnidadMedida-table">
    <center> <font face="Agency FB"> <h1> Unidades de medida registradas: </font> </center>

    <font size="5" face="Agency FB">
    <table border="7" bordercolor="white" bgcolor="#a0aafc" cellpadding="4" width="1000">


                <tr>
                    <th>IDunidadMedida</th>
                    <th>UnidadMedida</th>
                    <th>CostoPromedioUnidad</th>

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query_unidades)): ?>
                    <tr>
                        <td><?= $row['IDunidadMedida'] ?></td>
                        <td><?= $row['UnidadMedida'] ?></td>
                        <td><?= $row['CostoPromedioUnidad'] ?></td>

                        <th><a href="1Actualizar_UnidadMedida.php?IDunidadMedida=<?= $row['IDunidadMedida'] ?>">Editar</a></th>
                        <th><a href="Eliminar_UnidadMedida.php?IDunidadMedida=<?= $row['IDunidadMedida'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>

</body>

</html>