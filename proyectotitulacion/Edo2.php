<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Sanitización de código

    session_start();

    define('DEBUG', true);
    error_reporting(0);

    $_SESSION['Menu'] = 1;

    // Conexión con la base
    include("conexion.php");
    $conn = OpenCon();

    //=====================================================================
    //Inicialización de variables

    $mensajeS = $_SESSION['mensajeS'];
    $mensajeW = $_SESSION['mensajeW'];

    if($mensajeS != ""){
        $v_Mensaje = "success|$mensajeS|SI|20000";
        $_SESSION['mensajeS'] = "";
    }
    if($mensajeW != ""){
        $v_Mensaje = "warning|$mensajeW|SI|20000";
        $_SESSION['mensajeW'] = "";
    }

    $v_hidClave = "";
    $v_Estado   = "";

    $v_Estado       = $_REQUEST['estado_txt'];
    $v_hidClave     = $_REQUEST['hidClave'];
    $v_hidGuardar   = $_REQUEST['hidGuardar'];
    $v_hidModificar = $_REQUEST['hidModificar'];
    $v_hidEliminar  = $_REQUEST['hidEliminar'];

    // ====================================================================
    // Guardar
    if($v_hidGuardar == "SI"){
        if($v_hidClave == ""){
        // Aumentar numero de ID al insertar
            // Busca mediante la función getCampo el ID máximo dentro de una tabla 
            $v_ExisteMax = getCampo("SELECT MAX(edo_id) AS SALIDA FROM estado2 LIMIT 1");
            // Se exraen los últimos caracteres del ID obtenido previamente, ej. E01 Solo mantiene el 01
            $var = substr($v_ExisteMax, 1, 2);
            // Obtiene valor entero de una variable 
            $var = intval($var);
            // A la variable obtenida se le suma un 1
            $var = ($var+1);
            // Se concatena la letra E para la identificación del ID y se agrega el valor obtenido anteriormente 
            // y si el valor es menor a 10, se agrega un cero a la izquierda
            $var = "E".str_pad($var, 2, "0", STR_PAD_LEFT);

            // Query parametrizado para insertar datos en la base de datos
                // Se escribe utilizando marcadores de posición "?" en lugar de valores literales
                // Se agrega LIMIT 1 para que sólo se haga una inserción a la vez
            $sqlIN = "INSERT INTO estado2 (edo_id, estado) VALUES (?, ?) LIMIT 1";
            $stmt = mysqli_prepare($conn, $sqlIN);
                // bind_param: asigna el valor a el marcador de posición en la consulta $sqlIN
                // htmlspecialchars: Convierte caracteres especiales como <, >, &, ', " en sus entidades HTML correspondientes
            $stmt->bind_param("ss", htmlspecialchars($var,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_Estado,ENT_QUOTES,'UTF-8'));
            $stmt->execute();
            $result = $stmt->get_result(); 
                // Ejemplo de uso de htmlspecialchars()
                // $text = '<script>alert("Ataque XSS");</script>';
                // $safe_text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
                // echo $safe_text; 
                // Resultado: &lt;script&gt;alert(&quot;Ataque XSS!&quot;);&lt;/script&gt;
                //  Las funciones toman tres argumentos:
                // La cadena de texto que deseas convertir '$var'.
                // Un conjunto de banderas opcionales que especifican cómo se deben convertir los caracteres 
                // (por ejemplo, ENT_QUOTES para convertir tanto las comillas simples como las dobles).
                // La codificación de caracteres en UTF-8

            // =================================================================================================
            // Query sin parametrizar
            // $sqlIN = mysqli_query($conn, "insert into estado2(edo_id, estado) values ('$var', '$v_Estado');");

            if($sqlIN != ""){
                $mensaje   = "El registro se guardado correctamente.";
                $v_Mensaje = "success|$mensaje|SI|2000";
            }else{
                $mensaje   = "No se pudo guardar la información.";
                $v_Mensaje = "error|$mensaje|SI|2000";
            }
        }else{
            // Query parametrizado para modificar los datos en la base de datos 
            $sqlUP = "UPDATE estado2 SET estado = ? WHERE edo_id = ? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sqlUP);
            $stmt->bind_param('ss', htmlspecialchars($v_Estado,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8'));
            $stmt->execute();
            $result = $stmt->get_result();

            // $sqlUP = mysqli_query($conn, "update estado2 set estado = '$v_Estado' where edo_id = '$v_hidClave'");

            if($sqlUP != ""){
                $mensaje   = "El registro se ha actualizado correctamente.";
                $v_Mensaje = "success|$mensaje|SI|2000";
            }else{
                $mensaje   = "No se pudo actualizar la información.";
                $v_Mensaje = "error|$mensaje|SI|2000";
            }
        }
    }

    // ====================================================================
    // Modificación de los datos, se recuprean mediante el ID y se muestran en los imput del formulario
    if($v_hidModificar == "SI"){

        // Query parametrizado:

        // prepare: Prepara una sentencia para su ejecución y devuelve un objeto sentencia
        $stmt = $conn->prepare("SELECT * FROM estado2 WHERE edo_id = ? LIMIT 1");
        // bind_param: Vincula un parámetro al nombre de variable especificado
        $stmt->bind_param("s", htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8')); // s significa que el parámetro es una cadena
        // execute: Ejecuta una sentencia preparada
        $stmt->execute();
        // get_result: Obtiene un conjunto de resultados de una sentencia preparada
        $result = $stmt->get_result();
        
        // fetch_assoc: Obtener una fila de resultado como un array asociativo
        while ($rowMD = $result->fetch_assoc()) { 
            $v_Estado = $rowMD['estado'];
        }
    
        $stmt->close();
    }

    // ====================================================================
    // Eliminar
    if($v_hidEliminar == "SI"){

        $sqlD = "DELETE FROM estado2 WHERE edo_id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sqlD);
        $stmt->bind_param("s", htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8'));
        $stmt->execute();
        $result = $stmt->get_result();

        // $sqlD = mysqli_query($conn, "delete from estado2 where edo_id = '$v_hidClave'");

        if($sqlD != ""){
        $mensaje   = "El registro se ha eliminado correctamente.";
        $v_Mensaje = "warning|$mensaje|SI|2000";
        }else{
            $mensaje   = "No se pudo eliminar la información.";
            $v_Mensaje = "error|$mensaje|SI|2000";
        }
        // Se limpian las variables
        $v_hidClave = "";
        $v_Estado   = "";
    }

    //=====================================================================

    function getCampo($sql){
        global $conn;
        $salida = "";

        $stid = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($stid)){
            $salida = $row['SALIDA'];
        } 
        return $salida;
    }
    
    ?>

    <!----------------------------------------------->
    <title>Proyecto de titulación</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gl_alerts.css">
    <script src="assets/js/gl_alerts.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <style>
        .row_top{
            height: 45px;
            font-size: 25px;
            align: center;
            color: #3c9eb5;
            background: #3c9eb52b;
        }
        .info-td{
            font-size: 25px;
            color: #363636;
            padding: 6px 0;
            border-bottom: 1px solid #bbbbbb38;
        }
        .info-td:nth-child(1){
            text-align: center;
        }
        .info-td:nth-child(2){
            text-align: center;
        }
        .btn_modificar{
            font-size: 22px;
            text-align: center;
            color: #646464;
            cursor: pointer;
            transition: .1s all;
        }
        .btn_modificar:hover{
            color: #42acc6;
        }
        .btn_eliminar{
            font-size: 22px;
            text-align: center;
            color: #646464;
            cursor: pointer;
            transition: .1s all;
        }
        .btn_eliminar:hover{
            color: #ff7575;
        }
        .formulario2{
            padding: 10px 90px;
        }
        .title-form{
            color: #417885;
            font-size: 25px;
            font-weight: 600;
        }
        .imput-form{
            font-size: 25px;
            padding: 4px;
            border-color: #52e3eb80;
            border-radius: 5px;
        }
        .select-form{
            font-size: 16px;
            padding: 4px;
            width: 240px;
            border-color: #52e3eb80;
            border-radius: 5px;
        }
        .btn-form{
            font-size: 25px;
            color: #276e7e;
            font-weight: 600;
            padding: 4px;
            border-color: #52e3eb80;
            border-radius: 5px;
            background: #bcf0ff;
            cursor: pointer;
        }
        body{
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
        }
    </style>
</head>

<body>
    <form name="form1" id="form1" method="post" action="Edo2.php" onSubmit="return checaCampos();">        
        <input name="hidClave"     type="hidden"  id="hidClave"     value="<?= $v_hidClave ?>">
        <input name="hidGuardar"   type="hidden"  id="hidGuardar"   value="NO">
        <input name="hidModificar" type="hidden"  id="hidModificar" value="NO">
        <input name="hidEliminar"  type="hidden"  id="hidEliminar"  value="NO">

        <!-- Menú principal -->
        <?php include('Menu_principal.php'); ?>
        
        <div id="gl-alerts"></div>
            <?php
            if($v_Mensaje != ""){
                include('assets/php/gl_alerts.php');
            }  
        ?>
        <section class="body">
            <div class="wrapper-container" style="margin-top: 40px;">
                <div class="placa">
                    <div class="header2">
                        <div class="nombre-sis">
                            ESTADOS (CÓDIGO SANITIZADO)
                        </div>
                    </div>
                </div>

                <section class="formulario2" style="margin-bottom: 40px;">
                    <br>
                    <div class="container-data" style="min-height: 130px;">
                        <div>
                            <div class="texto-datos" id="area">
                                <div style="display: flex;">
                                    <div style="padding: 0 75px 0 0;">
                                        <p data-name="estado_txt" class="title-form">Nombre del Estado:</p>
                                        <input type="text" name="estado_txt" id="estado_txt" value="<?= $v_Estado ?>" maxlength="500" class="imput-form" style="width: 410px;">
                                    </div>
                                </div>
                                <br>
                            </div>                
                        </div>
                       
                        <div style="display: flex; padding: 0 598px;">
                            <div style="padding: 0 25px 0 0;">
                                <a class="btn efecto">
                                    <input type="button" class="btn-form" id="btn_guardar" value="Guardar">
                                </a>
                            </div>
                            <div>
                                <a class="btn efecto" style="margin-left: 15px;">
                                    <input type="button" class="btn-form" id="btn_nuevo" value="Nuevo">
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </section>

                <div style="display: flex; padding: 5px 25px;">
                    <input type="text" id="buscar" placeholder="Buscar..." class="imput-form" style="width: 250px;">
                </div>

                <div class="placa" style="height: 30px;">
                    <div class="header2">
                        <div class="nombre-sis"> 
                        </div>
                    </div>
                </div>
                <table width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th class="row_top" width="10%">ID</th>
                            <th class="row_top" width="70%">Nombre del Estado</th>
                            <th class="row_top" width="10%">Modificar</th>
                            <th class="row_top" width="10%">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM estado2 ORDER BY edo_id");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) { ?>
                                <tr> 
                                    <?php
                                    foreach ($row as $key => $item) { ?>
                                        <td class="info-td">
                                            <?= ($item !== null ? $item : "") ?>
                                        </td>
                                        <?php
                                    } ?> 
                                    <td class="btn_modificar info-td">
                                        <i class='bx bx-refresh' style="font-size: 28px;" onclick="modificar('<?= $row['edo_id'] ?>')"></i>
                                    </td>
                                    <td class="btn_eliminar info-td">
                                        <i class='bx bxs-trash' style="font-size: 28px;" onclick="eliminar('<?= $row['edo_id'] ?>')"></i>
                                    </td>
                                </tr>
                                <?php
                            }
                            $stmt->close();
                        ?>
                    </tbody>
                </table>

            </div>
            <br><br><br>
        </section>
        <?php
        mysqli_close($conn);
        ?>
	</form>
    <script>
        $(document).ready(function () {
            // =========================================
            // Boton de Nuevo
            $('#btn_nuevo').click(function (e) { 
                location.href = "Edo2.php";
            });

            // ============================================================================================
            // Boton de Guardar
            $("#btn_guardar").click(function (e) { 
                var mensaje = "";

                if($('#estado_txt').val() == ""){
                mensaje += "-El Estado debe contener información. <br>"; 
                }

                if(mensaje != ""){
                    Swal.fire({
                        title: 'Alerta',
                        html: mensaje, 
                        icon: 'warning',
                        confirmButtonColor: '#f9a155',
                        confirmButtonText: 'OK',
                        footer: '<p style="color: #999; font-weight: 600; color: #fd7500; text-decoration: underline;">Rellene la información faltante.</p>'
                    });
                }else{
                    $("#hidGuardar").val("SI");
                    document.form1.submit();
                }
            });

            // =========================================
            // Función de buscar 
            $("#buscar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        // ============================================================================================
        // Función de modificar
        function modificar(id){
            $("#hidModificar").val("SI");
            $("#hidClave").val(id);
            document.form1.submit();
        }

        // ============================================================================================
        // Función de eliminar
        function eliminar(id){
            Swal.fire({
                title: 'Alerta',
                text: "¿Estás seguro de eliminar este registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e03131',
                cancelButtonColor: '#9e9e9e',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed){
                    document.form1.hidEliminar.value = "SI";
                    $("#hidClave").val(id);
                    document.form1.submit();
                }
            });
        }

        // ============================================================================================
        // Función para escapar las entradas de texto, y solo permitir algunos tipos de caracteres

        // Se recibe el ID de la o las entradas de texto y el otro parametro (exprecion regular 'ragex')
        function setInputFilter(id, regex) {
            // document.getElementById(id): Devuelve una referencia al elemento por su ID
            var input = document.getElementById(id);
            // input.addEventListener(): El metodo adjunta un controlador de eventos a un elemento 
            // En este caso tenemos un evento input y una función la cual es la exprecion regular 'ragex'
            // para reemplazar los caracteres que no se adjuntan en la expresion regular por una cadena vacía ('')
            input.addEventListener('input', function() {
                this.value = this.value.replace(regex, '');
            });
        }
        // Por ultimo se llama la función setInputFilter() para cada elemento de entrada de texto que se desee controlar, pasando el ID
        // del imput y la expresión regular correspondiente con argumentos 
        // deben estár en orden conforme se crean los inputs
            // Acepta solo letras Minusculas y Mayusculas de la 'a' a la 'z' y Espacios 
        setInputFilter('estado_txt', /[^a-zA-Z ]/g);
            // Acepta sólo Numeros 
        setInputFilter('inputID', /[^0-9]/g);
            // Acepta caracteres para un imput de Correo
        setInputFilter('inputID', /[^a-zA-Z0-9@._-]/g);
            // Hay caracteres especiales los cuales tienen un significado especial dentro de una expresion regular, 
            // estos caracteres deben proceder mediante el caracter de escape '\'
            // son los siguientes: . ^ $ * + ? ( ) [ ] { } | \ 
            // Ejempolo que permite todo tipo de caracteres incluyendo el espacio: 
        setInputFilter('inputID', /[^0-9a-zA-Z@_ -!¡%&¿~=`\[\]:".$;*^|'+<>(){}?,\/]/g);

        // ============================================================================================

    </script>
</body>
</html>