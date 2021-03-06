<?php
session_start();

if (isset($_SESSION['s_usuario'])) {
    $user=$_SESSION['s_usuario'];
    echo "<a href='logOut.php'>CERRAR SESSION</a>";
}
else
    header("location: login.php");
    
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6, user-scalable=no"/>

	<title>Registro|Estudiante</title>

	<link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/formularios.css">
</head>
<body>
<?php 
	include_once('clsEstudiante.php');

    $criterio=$_POST['txtbuscar'];
?>

    <header>
        <div class="contenedor">
            <h1><strong>FINOR</strong> | <i>Registros</i></h1>
            
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu">
                <a href="panel.php" class="icon-inicio">Principal</a>
                <a href="frmRegistrarse.php" >Inscripcion</a>
                <a href="registros.php" >Registros</a>
                <a href="consultas.php" >Consultas</a>
                <a href="logout.php">Cerrar Sesion</a>
            </nav>
        </div>
    </header>

    <main style="margin-top: 50px;">

        <section id="blog">

            <div class="contenedor">
                <article>
                	<form name="estudiante" action="frmEstudiante.php" method="POST">
                		<table  align="center">
                			<tr>
                				<td><label for="regEst">Registro</label></td>
                				<td><input type="text" name="regEst" id="regEst" value="<?php echo $_GET['x_reg'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="nomEst">Nombre</label></td>
                				<td><input type="text" name="nomEst" id="nomEst" value="<?php echo $_GET['x_nombres'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="patEst">Apellido Paterno</label></td>
                				<td><input type="text" name="patEst" id="patEst" value="<?php echo $_GET['x_paterno'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="matEst">Apellido Materno</label></td>
                				<td><input type="text" name="matEst" id="matEst" value="<?php echo $_GET['x_materno'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="mailEst">E-mail</label></td>
                				<td><input type="text" name="mailEst" id="mailEst" value="<?php echo $_GET['x_email'];?>"></td>
                			</tr>


                			<tr>
                				 <td colspan="2">
                                    <input type="submit" name="botones" value="Nuevo">
                				    <input type="submit" name="botones" value="Guardar">
                                    <input type="submit" name="botones" value="Modificar">
                                    <input type="submit" name="botones" value="Eliminar">
                                    <input type="submit" name="botones" value="Buscar">
                			     </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <label>Busqueda por: </label>
                                    <input type="radio" name="grupo" value="1" checked >Registro |
                                    <input type="radio" name="grupo" value="2" <?php if (($_POST['grupo'])=='2') echo "checked";?>>Nombre y Apellido
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="text" name="txtbuscar" size="45" value="<?php  echo $_POST['txtbuscar']?>">                                    
                                </td>
                            </tr>

                		</table>

                	</form>
                 
                </article>
                
            </div>
<?php 

function Guardar()
{
    if ($_POST['regEst']) {
        $new = new Estudiante();
        $new->setRegEstudiante($_POST['regEst']);
        $new->setNombre($_POST['nomEst']);
        $new->setPaterno($_POST['patEst']);
        $new->setMaterno($_POST['matEst']);
        $new->setEmail($_POST['mailEst']);

        if ($new->Guardar()) {
            echo "Se registro exitosamente al nuevo estudiante";
        }
        else
            echo "Error al registrar";
    }
    else
        echo "Es obligatorio el Registro";
}

function Eliminar(){
    if ($_POST['regEst']) {

        $stu=new Estudiante();

        $stu->setRegEstudiante($_POST['regEst']);
        if ($stu->Eliminar())
            echo "¡Se eliminaron los registros correctamente!";
        else
            echo "Error al Eliminar";
    }
    else
        echo "Se Necesita obligatoriamente un numero de Registro";
}

function Modificar(){
    if ($_POST['regEst']) {
        $mod=new Estudiante();

        $mod->setRegEstudiante($_POST['regEst']);
        $mod->setNombre($_POST['nomEst']);
        $mod->setPaterno($_POST['patEst']);
        $mod->setMaterno($_POST['matEst']);
        $mod->setEmail($_POST['mailEst']);

        if ($mod->Modificar()) {
            echo "Se modifico corectamente!";
        }
        else
            echo "Error, no se modificaron los registros";

      /*    echo $mod->getRegEstudiante();
            echo $mod->getNombre();
            echo  $mod->getPaterno();
            echo $mod->getMaterno();
            echo $mod->getEmail();       */
    }
}

function Buscar(){
    $per= new Estudiante();

    switch ($_POST['grupo']) {
        case '1':
            $registros=$per->BuscarPorRegistro($_POST['txtbuscar']);
            mostrarRegistros($registros); 
            break;

        case '2':
            $registros=$per->BuscarPorNombreApellido($_POST['txtbuscar']);
            mostrarRegistros($registros);
            break;
    }

}

function mostrarRegistros($registros){
    echo "<table align='center'>";
    echo "<tr>  
                <td>Nro Registro</td>
                <td>Nombres</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>E-mail</td>
                <td><center>*</center></td>
          </tr>";
    while($fila=mysqli_fetch_object($registros))
    {
        echo "<tr>";

        echo        "<td>$fila->reg_estudiante</td>";
        echo        "<td>$fila->nombres</td>";
        echo        "<td>$fila->paterno</td>";
        echo        "<td>$fila->materno</td>";
        echo        "<td>$fila->email</td>";

        echo        "<td><a href='frmEstudiante.php?x_reg=$fila->reg_estudiante&x_nombres=$fila->nombres&x_paterno=$fila->paterno&x_materno=$fila->materno&x_email=$fila->email'> [Editar] </a></td>";
        echo "</tr>";
    }
    echo "</table>";
}


switch ($_POST['botones']) {
    case 'Guardar':
        Guardar();
       break;

    case 'Modificar':
        Modificar();
       break;

    case 'Nuevo':
       
       break;

    case 'Eliminar':
        Eliminar();
        break;

    case 'Buscar':
         Buscar();
        break;
    
}
?>
        </section>

    </main>

    <footer>
        <div class="contenedor">
            <p class="copy">Facultad Integral del Norte &copy; 2017</p>
            <div class="sociales">
                <a class="icon-telefono" href="ubicacion.html"></a>
                <a class="icon-facebook" href="https://www.facebook.com/rrppfinor.uagrm/#"></a>
                <a class="icon-whatsapp" href="ubicacion.html"></a>
                <a class="icon-mapa" href="https://goo.gl/maps/365BfNbAwAG2"></a>
            </div>
        </div>
    </footer>
</body>
</html>