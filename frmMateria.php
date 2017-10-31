<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

	<title>Registro|Materia</title>

	<link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/formularios.css">
</head>
<body>
<?
	include_once('clsMateria.php');
    $criterio=$_POST['txtbuscar'];
?>

    <header>
        <div class="contenedor">
            <h1><strong>FINOR</strong> | <i>Registros</i></h1>
            
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu">
                <a href="index.html" class="icon-inicio">Inicio</a>
                <a href="frmEstudiante.php" >Estudiantes</a>
                <a href="frmDocente.php" >Docentes</a>
                <a href="frmCarrera.php" >Carreras</a>
                <a href="frmMateria.php" >Materias</a>
            </nav>
        </div>
    </header>

    <main>
        <section id="banner">
            <img src="images/infra.jpg">
            <div class="contenedor">
                <h2>FACULTAD INTEGRAL DEL NORTE</h2>
                <p>
                Formando profesionales competentes, emprendedores e idoneos</p>
                <a id="linktohome" href="index.html">Inicio</a>
            </div>
        </section>

        <section id="bienvenidos">
            <div class="contenedor">
                <h2>REGISTRO DE NUEVAS MATERIAS</h2>
            </div>
        </section>

        <section id="blog">

            <div class="contenedor">
                  
                <article>
                	<form name="materia" action="frmMateria.php" method="POST">
                		<table  align="center">
                			<tr>
                				<td><label for="sigla">Sigla</label></td>
                				<td><input type="text" name="sigla" id="sigla" value="<?echo $_GET['x_sigla'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="nomat">Nombre</label></td>
                				<td><input type="text" name="nombre" id="nomat" value="<?echo $_GET['x_nombre'];?>"></td>
                			</tr>
                			<tr>
                				<td><label for="credmat">Creditos</label></td>
                				<td><input type="text" name="creditos" id="credmat" value="<?echo $_GET['x_creditos'];?>"></td>
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
                                    <input type="radio" name="grupo" value="1">Sigla |
                                    <input type="radio" name="grupo" value="2">Nombre 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="text" name="txtbuscar" size="45">                                    
                                </td>
                                </tr>

                		</table>
                	</form>
                 
                </article>
                
            </div>
            <?

function Guardar()
{
    if ($_POST['sigla']) {
        $new = new Materia;
        $new->setSigla($_POST['sigla']);
        $new->setNombre($_POST['nombre']);
        $new->setCreditos($_POST['creditos']);

        if ($new->Guardar()) {
            echo "Se registro exitosamente";
        }
        else
            echo "Error al registrar";
    }
    else
        echo "Es obligatorio la sigla";
}
function Eliminar(){
    if ($_POST['sigla']) {

        $stu=new Materia();

        $stu->setSigla($_POST['sigla']);
        if ($stu->Eliminar())
            echo "¡Se eliminaron los registros correctamente!";
        else
            echo "Error al Eliminar";
    }
    else
        echo "Se Necesita obligatoriamente un numero de sigla";
}

function Modificar(){

        if ($_POST['sigla']) {
        $new = new Materia;
        $new->setSigla($_POST['sigla']);
        $new->setNombre($_POST['nombre']);
        $new->setCreditos($_POST['creditos']);

        

        if ($mod->Modificar()) {
            echo "Se modifico corectamente!";
        }
        else
            echo "Error, no se modificaron los registros";
    }
}

function Buscar(){
    $per= new Materia();

    switch ($_POST['grupo']) {
        case '1':
            $registros=$per->BuscarPorSigla($_POST['txtbuscar']);
            mostrarSiglas($registros); 
            break;

        case '2':
            $registros=$per->BuscarPorNombre($_POST['txtbuscar']);
            mostrarSiglas($registros);
            break;
        
    }

}

function mostrarSiglas($registros){
    echo "<table align='center'>";
    echo "<tr>  
                <td>Nro Sigla</td>
                <td>Nombre</td>
                <td>Creditos</td>
                
          </tr>";
    while($fila=mysqli_fetch_object($registros))
    {
        echo "<tr>";

        echo        "<td>$fila->sigla</td>";
        echo        "<td>$fila->nombre</td>";
        echo        "<td>$fila->creditos</td>";
        

        echo        "<td><a href='frmMateria.php?x_sigla=$fila->sigla&x_nombre=$fila->nombre&x_creditos=$fila->creditos'> [Editar] </a></td>";
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

    case 'Eliminar':
        Eliminar();
       break;

    case 'Buscar':
         Buscar();
        break;



    
}


?>
        </section>

        <section id="info">
            <h3>Informacion que te interesaría</h3>
               <div class="contenedor">
               <div class="info-uni">
                   <a href="historia.html"><img src="images/historia.jpg" alt="">
                    </a>
                    <h4>Historia</h4>
                </div>
                <div class="info-uni">
                    <a href="infraestructura.html"><img src="images/infra5.jpg" alt=""></a>
                    <h4>Infraestructura</h4>
                </div>
                <div class="info-uni">
                    <a href="becas.html"><img src="images/becas.jpg" alt=""></a>
                    <h4>Becas</h4>
                </div>
                <div class="info-uni">
                    <a href="convenios.html"><img src="images/convenios.png" alt="convenios"></a>
                    <h4>Convenios</h4>
                </div>
                </div>
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