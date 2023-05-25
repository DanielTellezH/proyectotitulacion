<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Sanitización de código

    session_start();

    define('DEBUG', true);
    error_reporting(0);

    $_SESSION['Menu'] = 4;

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

    $v_hidClave     = "";
    $v_Tipo_usr     = "";
    $v_Usuario      = "";
    $v_Nom_usuario  = "";
    $v_Apellido_pat = "";
    $v_Apellido_mat = "";
    $v_Correo       = "";
    $v_Telefono     = "";
    $v_Edad         = "";
    $v_Direccion    = "";

    $v_Tipo_usr     = $_REQUEST['tipo_usr_lst'];
    $v_Usuario      = $_REQUEST['usuario_txt'];
    $v_Nom_usuario  = $_REQUEST['nom_usuario_txt'];
    $v_Apellido_pat = $_REQUEST['apellido_pat_txt'];
    $v_Apellido_mat = $_REQUEST['apellido_mat_txt'];
    $v_Correo       = $_REQUEST['correo_txt'];
    $v_Telefono     = $_REQUEST['telefono_txt'];
    $v_Edad         = $_REQUEST['edad_txt'];
    $v_Direccion    = $_REQUEST['direccion_lst'];
    
    $v_hidClave     = $_REQUEST['hidClave'];
    $v_hidGuardar   = $_REQUEST['hidGuardar'];
    $v_hidModificar = $_REQUEST['hidModificar'];
    $v_hidEliminar  = $_REQUEST['hidEliminar'];

    // ====================================================================
    // Guardar
    if($v_hidGuardar == "SI"){
        if($v_hidClave == ""){
            // Aumentar numero de ID al insertar
            // $v_ExisteMax = getCampo("select MAX(usuario_id) as SALIDA from usuario");
            // $var = substr($v_ExisteMax, 1, 3);
            // $var = intval($var);
            // $var = ($var+1);
            // $var = "E".str_pad($var, 3, "0", STR_PAD_LEFT);

            // // Insert
            // $sqlIN = mysqli_query($conn, "insert into usuario(`usuario_id`, `tipo_usr_id`, `usuario`, `nombre_usuario`, `apellido_pat`, `apellido_mat`, `correo`, `telefono`, `edad`, `direccion_id`)
            //             values ('$var', '$v_Tipo_usr', '$v_Usuario', '$v_Nom_usuario', '$v_Apellido_pat', '$v_Apellido_mat', '$v_Correo', '$v_Telefono', '$v_Edad', '$v_Direccion')");
            // // echo "<br><br><br><br><br><br><br><br><br><br>"."insert into empleado(clave, NOMBRE, APELLIDO_PAT, APELLIDO_MAT, RFC, NSS, CORREO_E, TELEFONO, ID_CARGO, ID_DIRECCION)
            // // values ('$var', '$v_Nom_usuario', '$v_Apellido_pat', '$v_Apellido_mat', '$v_Usuario', '$v_Edad', '$v_Correo', '$v_Telefono', '$v_Tipo_usr', '$v_Direccion')";
            
            // if($sqlIN != ""){
            //     $mensaje   = "El registro se guardado correctamente.";
            //     $v_Mensaje = "success|$mensaje|SI|2000";
            // }else{
            //     $mensaje   = "No se pudo guardar la información.";
            //     $v_Mensaje = "error|$mensaje|SI|2000";
            // }
        }else{
            // Update
            $sqlUP = "UPDATE usuarios2 SET tipo_usr_id = ?, usuario = ?, nombre_usuario = ?, apellido_pat = ?,
                        apellido_mat = ?, correo = ?, telefono = ?, edad = ?, direccion_id = ?
                        WHERE usuario_id = ? LIMIT 1";
            $stmt = mysqli_prepare($conn, $sqlUP);
            $stmt->bind_param('ssssssssss', htmlspecialchars($v_Tipo_usr,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_Usuario,ENT_QUOTES,'UTF-8'), 
                                htmlspecialchars($v_Nom_usuario,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_Apellido_pat,ENT_QUOTES,'UTF-8'),
                                htmlspecialchars($v_Apellido_mat,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_Correo,ENT_QUOTES,'UTF-8'), 
                                htmlspecialchars($v_Telefono,ENT_QUOTES,'UTF-8'), htmlspecialchars($v_Edad,ENT_QUOTES,'UTF-8'), 
                                htmlspecialchars($v_Direccion,ENT_QUOTES,'UTF-8'),
                                htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8'));
            $stmt->execute();
            $result = $stmt->get_result();
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
    // Modificar
    if($v_hidModificar == "SI"){
        $stmt = $conn->prepare("SELECT * FROM usuarios2 WHERE usuario_id = ? LIMIT 1");
        $stmt->bind_param("s", htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8'));
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($rowMD = $result->fetch_assoc()) { 
            $v_Tipo_usr     = $rowMD['tipo_usr_id'];
            $v_Usuario      = $rowMD['usuario'];
            $v_Nom_usuario  = $rowMD['nombre_usuario'];
            $v_Apellido_pat = $rowMD['apellido_pat'];
            $v_Apellido_mat = $rowMD['apellido_mat'];
            $v_Correo       = $rowMD['correo'];
            $v_Telefono     = $rowMD['telefono'];
            $v_Edad         = $rowMD['edad'];
            $v_Direccion    = $rowMD['direccion_id'];
        }
    
        $stmt->close();
    }

    // ====================================================================
    // Eliminar
    if($v_hidEliminar == "SI"){
        $sqlD = "DELETE FROM usuarios2 WHERE usuario_id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sqlD);
        $stmt->bind_param("s", htmlspecialchars($v_hidClave,ENT_QUOTES,'UTF-8'));
        $stmt->execute();
        $result = $stmt->get_result();

        if($sqlD != ""){
        $mensaje   = "El registro se ha eliminado correctamente.";
        $v_Mensaje = "warning|$mensaje|SI|2000";
        }else{
            $mensaje   = "No se pudo eliminar la información.";
            $v_Mensaje = "error|$mensaje|SI|2000";
        }
        // Se limpian las variables
        $v_hidClave     = "";
        $v_Tipo_usr     = "";
        $v_Usuario      = "";
        $v_Nom_usuario  = "";
        $v_Apellido_pat = "";
        $v_Apellido_mat = "";
        $v_Correo       = "";
        $v_Telefono     = "";
        $v_Edad         = "";
        $v_Direccion    = "";
        
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
            align: center;
            color: #3c9eb5;
            background: #3c9eb52b;
        }
        .info-td{
            font-size: 15px;
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
        .info-td:nth-child(6){
            text-align: center;
        }
        .info-td:nth-child(8){
            text-align: center;
        }
        .info-td:nth-child(9){
            text-align: center;
        }
        .info-td:nth-child(10){
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
            font-size: 16px;
            font-weight: 600;
        }
        .imput-form{
            font-size: 16px;
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
            font-size: 18px;
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
    <form name="form1" id="form1" method="post" action="Usuarios2.php" onSubmit="return checaCampos();">        
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
                            MODIFICACIÓN DE USUARIOS (SANITIZADO)
                        </div>
                    </div>
                </div>

                <?php
                if($v_hidModificar == "SI"){
                ?>
                <section class="formulario2" style="margin-bottom: 40px;">
                    <br>
                    <div class="container-data" style="min-height: 250px;">
                        <div>
                            <div class="texto-datos" id="area">
                                <div style="display: flex;">
                                    <div style="padding: 0 160px 0 0;">
                                        <p data-name="tipo_usr_lst" class="title-form">Tipo de usuario:</p>
                                        <div class="box">
                                            <select name="tipo_usr_lst" id="tipo_usr_lst" class="select-form" onChange="light_Title('tipo_usr_lst');" style="width: 220px;">
                                                <option value="" selected>Seleccione una opción</option>
                                                <?php
                                                $sql = mysqli_query($conn, 'select * from tipo_usuario order by tipo_usr_id');
                                                while ($rowE = mysqli_fetch_assoc($sql)){ ?>
                                                    <option value="<?= $rowE['tipo_usr_id'] ?>" <?php if($v_Tipo_usr == $rowE['tipo_usr_id']){ echo "selected"; } ?>>
                                                        <?= $rowE['tipo_usr'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="usuario_txt" class="title-form">Usuario:</p>
                                        <input type="text" name="usuario_txt" id="usuario_txt" value="<?= $v_Usuario ?>" maxlength="10" class="imput-form" style="width: 150px;">
                                    </div>

                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="nom_usuario_txt" class="title-form">Nombre:</p>
                                        <input type="text" name="nom_usuario_txt" id="nom_usuario_txt" value="<?= $v_Nom_usuario ?>" maxlength="30" class="imput-form" style="width: 300px;">
                                    </div>
                                </div>
                                <br>
                                
                                <div style="display: flex;">
                                    
                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="apellido_pat_txt" class="title-form">Apellido paterno:</p>
                                        <input type="text" name="apellido_pat_txt" id="apellido_pat_txt" value="<?= $v_Apellido_pat ?>" maxlength="25" class="imput-form" style="width: 300px;">
                                    </div>

                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="apellido_mat_txt" class="title-form">Apellido materno:</p>
                                        <input type="text" name="apellido_mat_txt" id="apellido_mat_txt" value="<?= $v_Apellido_mat ?>" maxlength="25" class="imput-form" style="width: 300px;">
                                    </div>
                                </div>

                                <div style="display: flex;">
                                    <div style="padding: 0 70px 0 0;">
                                    <p data-name="correo_txt" class="title-form">Correo del usuario:</p>
                                        <input type="text" name="correo_txt" id="correo_txt" value="<?= $v_Correo ?>" maxlength="100" class="imput-form" style="width: 487px;">
                                    </div>

                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="telefono_txt" class="title-form">Teléfono:</p>
                                        <input type="text" name="telefono_txt" id="telefono_txt" value="<?= $v_Telefono ?>" maxlength="10" class="imput-form" style="width: 120px;" onkeypress="return isNumber(event)">
                                    </div>

                                    <div style="padding: 0 80px 0 0;">
                                        <p data-name="edad_txt" class="title-form">Edad:</p>
                                        <input type="text" name="edad_txt" id="edad_txt" value="<?= $v_Edad ?>" maxlength="11" class="imput-form" style="width: 150px;" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                    
                                <div style="display: flex;">

                                    <div style="padding: 0 70px 0 0;">
                                        <p data-name="direccion_lst" class="title-form">Dirección:</p>
                                        <div class="box">
                                            <select name="direccion_lst" id="direccion_lst" class="select-form" onChange="light_Title('direccion_lst');" style="width: 800px;">
                                                <option value="" selected>Seleccione una opción</option>
                                                <?php
                                                $sql = mysqli_query($conn, 'SELECT direccion.direccion_id, direccion.alcaldia, direccion.colonia, 
                                                                                    direccion.cod_post, direccion.calle, direccion.num_ext,
                                                                                    estado.estado
                                                                            FROM direccion
                                                                            JOIN estado ON direccion.estado_id = estado.edo_id
                                                                            ORDER BY direccion.direccion_id');
                                                while ($rowE = mysqli_fetch_assoc($sql)){ ?>
                                                    <option value="<?= $rowE['direccion_id'] ?>" <?php if($v_Direccion == $rowE['direccion_id']){ echo "selected"; } ?>>
                                                        <?= $rowE['direccion_id'].", ".$rowE['alcaldia'].", ".$rowE['colonia'].", ".$rowE['cod_post'].", ".$rowE['calle'].", ".$rowE['num_ext'].", ".$rowE['estado'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                            </div>                
                        </div>
                       
                        <div style="padding: 0 400px;">
                            <a class="btn efecto" style="margin-left: 15px;">
                                <input type="button" class="btn-form" id="btn_guardar" value="Guardar">
                            </a>
                            <a class="btn efecto" style="margin-left: 15px;">
                                <input type="button" class="btn-form" id="btn_nuevo" value="Nuevo">
                            </a>
                        </div>
                        
                    </div>
                </section>
                
                <?php
                }
                ?>

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
                            <th class="row_top" width="2%">ID</th>
                            <th class="row_top" width="2%">Tipo usuario</th>
                            <th class="row_top" width="5%">Usuario</th>
                            <th class="row_top" width="10%">Nombre</th>
                            <th class="row_top" width="10%">Apellido Paterno</th>
                            <th class="row_top" width="10%">Apellido Materno</th>
                            <th class="row_top" width="10%">Correo</th>
                            <th class="row_top" width="4%">Teléfono</th>
                            <th class="row_top" width="2%">Edad</th>
                            <th class="row_top" width="5%">Dirección</th>
                            <th class="row_top" width="4%">Modificar</th>
                            <th class="row_top" width="4%">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = $conn->prepare("SELECT usuario_id, tipo_usr_id, usuario, nombre_usuario, apellido_pat, 
                                                    apellido_mat, correo, telefono, edad, direccion_id FROM usuarios2 ORDER BY usuario_id");
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
                                    <i class='bx bx-refresh' onclick="modificar('<?= $row['usuario_id'] ?>')"></i>
                                </td>
                                <td class="btn_eliminar info-td">
                                    <i class='bx bxs-trash' onclick="eliminar('<?= $row['usuario_id'] ?>')"></i>
                                </td>
                            </tr>

                            <?php
                        }
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
            // Boton de Nuevo
            $('#btn_nuevo').click(function (e) { 
                location.href = "Usuarios2.php";
            });

            // Boton de Guardar
            $("#btn_guardar").click(function (e) { 
                var mensaje = "";

                if($('#tipo_usr_lst').val() == ""){
                mensaje += "-El tipo de usuario debe estar seleccionado. <br>"; 
                }
                if($('#usuario_txt').val() == ""){
                mensaje += "-El usuario debe contener información. <br>"; 
                }
                if($('#nom_usuario_txt').val() == ""){
                mensaje += "-El nombre del usuario debe contener información. <br>"; 
                }
                if($('#apellido_pat_txt').val() == ""){
                mensaje += "-El apellido paterno del usuario debe contener información. <br>"; 
                }
                if($('#apellido_mat_txt').val() == ""){
                mensaje += "-El apellido materno del usuario debe contener información. <br>"; 
                }
                if($('#correo_txt').val() == ""){
                mensaje += "-El correo debe contener información. <br>"; 
                }
                if($('#telefono_txt').val() == ""){
                mensaje += "-El Telefono debe contener información. <br>"; 
                }
                if($('#edad_txt').val() == ""){
                mensaje += "-La edad debe contener información. <br>"; 
                }
                if($('#direccion_lst').val() == ""){
                mensaje += "-La dirección debe estar seleccionada. <br>"; 
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
            // Buscar 
            $("#buscar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        
        // Modificar
        function modificar(id){
            $("#hidModificar").val("SI");
            $("#hidClave").val(id);
            document.form1.submit();
        }

        // Eliminar
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

        // function setInputFilter(id, regex) {
        //     var input = document.getElementById(id);
        //     input.addEventListener('input', function() {
        //         this.value = this.value.replace(regex, '');
        //     });
        // }
        // setInputFilter('usuario_txt', /[^0-9a-zA-Z ]/g);
        // setInputFilter('nom_usuario_txt', /[^a-zA-Z ]/g);
        // setInputFilter('apellido_pat_txt', /[^a-zA-Z ]/g);
        // setInputFilter('apellido_mat_txt', /[^a-zA-Z ]/g);
        // setInputFilter('correo_txt', /[^a-zA-Z0-9@._-]/g);
        // setInputFilter('telefono_txt', /[^0-9]/g);
        // setInputFilter('edad_txt', /[^0-9]/g);

        // ============================================================================================
    </script>
</body>
</html>